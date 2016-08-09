<?php
require '../../app/bootstrap-admin.php';
require './secured.php';

/* Připojení k DB */
$conn = getConnection();

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'admin/editaceDestinaci.php';
$layout['content_menu_box'] = loadTemplate('admin/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'Editace destinace';

$result = '';

$continents = getContinents($conn);

if ($_POST)
{
	$errors = validateForm($_POST);
	
	if (count($errors) == 0)
	{
		$result = processForm($conn, $_POST);		
		if ($result != NULL && $result > 0)
		{
			header("Location:editaceDestinaci.php?result=success");
		}
		else
		{			
			$data['values'] = $_POST;
			$data['errors'] = $errors;
			$data['result'] = 'error';
			$data['continents'] = $continents;
			$layout['content_wrapper'] = loadTemplate('admin/editaceDestinaci/form.php', $data);
		}
	}
	else
	{
		$data['values'] = $_POST;
		$data['errors'] = $errors;
		$data['result'] = '';
		$data['continents'] = $continents;
		$layout['content_wrapper'] = loadTemplate('admin/editaceDestinaci/form.php', $data);
	}
}
else
{
	if (isset($_GET['id']))
	{

		$data['values'] = getDestination($conn, $_GET['id']);

		// naformátování datumů do české podoby
		$data['values']['dtValidFrom'] = formatToDate($data['values']['dtValidFrom']);
		$data['values']['dtValidTo'] = formatToDate($data['values']['dtValidTo']);
		
		$data['errors'] = array();
		$data['result'] = '';
		
		$data['continents'] = $continents;
		
		$layout['content_wrapper'] = loadTemplate('admin/editaceDestinaci/form.php', $data);
	}
	else
	{
		$data['items'] = loadDestinationList($conn);
		$layout['content_wrapper'] = loadTemplate('admin/editaceDestinaci/list.php', $data);
	}
}


echo loadTemplate('admin/@layout.php', $layout);

//vlastni funkce pro vip-servis
function loadDestinationList($conn)
{
	$sql = 'SELECT id,dtCreated,dtValidFrom,dtValidTo,title
			FROM destination';
	return getRowsSql($conn, $sql);
}

function getDestination($conn, $id)
{
	$sql = 'SELECT id,
        dtValidFrom,
        dtValidTo,
        title,
        description,
        briefDescription,
        catering,accommodation,
        returnPrice,
        oneWayPrice,
		continent_id
                FROM destination
                WHERE id= ' . $id;
	$data = getRowsSql($conn, $sql);
	return $data[0];
}

function processForm($conn, array $values)
{
	$dtValidFrom = formatDateToDb($values['dtValidFrom']);
	$dtValidTo = formatDateToDb($values['dtValidTo']);

	$returnPrice = clearPriceValue($values['returnPrice']);
	$oneWayPrice = clearPriceValue($values['oneWayPrice']);
	
	$sql = 'UPDATE destination
			SET
				dtValidFrom = ' . mysqlQuote($conn, $dtValidFrom) . ',
				dtValidTo = ' . mysqlQuote($conn, $dtValidTo) . ',
				title = ' . mysqlQuote($conn, $values['title']) . ',
				description = ' . mysqlQuote($conn, $values['description']) . ',
				briefDescription = ' . mysqlQuote($conn, $values['briefDescription']) . ',
				catering=' . mysqlQuote($conn, $values['catering']) . ',
				accommodation=' . mysqlQuote($conn, $values['accommodation']) . ',
				returnPrice=' . mysqlQuote($conn, $returnPrice) . ',
				oneWayPrice=' . mysqlQuote($conn, $oneWayPrice) . ',
				continent_id = ' . mysqlQuote($conn, $values['continent_id']) . '
			WHERE id = ' . mysqlQuote($conn, $values['id']);
	
	return executeSql($conn, $sql);
}

function validateForm(array $values)
{
	$errors = array();
	if (!validateDate($values['dtValidFrom']))
	{
		$errors['dtValidFrom'] = 'Vyplňte platnost od ve správném formátu';		
	}
	if (!validateDate($values['dtValidTo']))
	{
		$errors['dtValidTo'] = 'Vyplňte platnost do ve správném formátu';
	}
	if (strlen($values['title']) == 0)
	{
		$errors['title'] = 'Název destinace';
	}
	if (strlen($values['description']) == 0)
	{
		$errors['description'] = 'Zadejte popis destinace';
	}
	if (strlen($values['briefDescription']) == 0)
	{
		$errors['briefDescription'] = 'Zadejte krátky popis';
	}
	if (strlen($values['catering']) == 0)
	{
		$errors['catering'] = 'Zadejte popis stavování';
	}
	if (strlen($values['accommodation']) == 0)
	{
		$errors['accommodation'] = 'Zadejte popis ubytovaní';
	}
	
	$returnPrice = clearPriceValue($values['returnPrice']);
	if ($returnPrice < 1)
	{
		$errors['returnPrice'] = 'Zadejte zpatečný cenu';
	}
	
	$oneWayPrice = clearPriceValue($values['oneWayPrice']);
	if ($oneWayPrice < 1)
	{
		$errors['oneWayPrice'] = 'Zadejte jednosmernu cenu';
	}
	
	if((int) $values['continent_id'] < 1)
	{
		$errors['continent_id'] = 'Zvolte kontinent';		
	}
	
	return $errors;
}
