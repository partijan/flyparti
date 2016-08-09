<?php

require '../../app/bootstrap-admin.php';
require './secured.php';

if (getUserRole() != 'master')
{
	exit ('Not Authorized!');
}

/* Připojení k DB */
$conn = getConnection();

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'admin/pridatDestinaci.php';
$layout['content_menu_box'] = loadTemplate('admin/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'Přidání destinace';

$result = '';

/* Vlastní aplikační logika */
if ($_POST)
{
    /* Formulář byl odeslán */
	$values = $_POST;
    $errors = validateForm($values);

    if (count($errors) == 0)
    {
        /* Formulář je v pořádku, můžeme zpracovat data */
        $result = proccessForm($conn, $values);
        if ($result != NULL && $result > 0)
        {
            /* Zpracování OK, přesměrujeme stránku */
            header("Location: pridatDestinaci.php?result=success");
        }
        else
        {
            /* Došlo k chybě při zápisu do DB */            
			$result = 'error';
        }
    }
	else
	{
		$result = 'error';
	}
}
else
{
    /* Formulář nebyl odeslán, řešíme normální požadavek */
    $values = $errors = array();

    if (isset($_GET['result']))
    {
        $result = $_GET['result'];
    }
}

$continents = getContinents($conn);

$values['continents'] = $continents;
$layout['content_wrapper'] = getForm($values, $errors, $result);

echo loadTemplate('admin/@layout.php', $layout);

function getForm(array $values, array $errors, $result)
{
    $data = array();
    $data['values'] = $values;
    $data['errors'] = $errors;
    $data['result'] = $result;
    return loadTemplate('admin/pridatDestinaci/form.php', $data);
}

function proccessForm($conn, array $values)
{
	$dtValidFrom = formatDateToDb($values['dtValidFrom']);
	$dtValidTo = formatDateToDb($values['dtValidTo']);
	
	$returnPrice = clearPriceValue($values['returnPrice']);
	$oneWayPrice = clearPriceValue($values['oneWayPrice']);
	
    $sql = 'INSERT INTO destination (
        dtCreated, 
        dtValidFrom,
        continent_id, 
        dtValidTo,
        title, 
        description,
        briefDescription,
        catering,
        accommodation,
        returnPrice,
        oneWayPrice
       ) 
			VALUES 
            ( NOW()'
            . ',' . mysqlQuote($conn, $dtValidFrom)
            . ',' . mysqlQuote($conn, $values['continent_id'])
            . ',' . mysqlQuote($conn, $dtValidTo)
            . ',' . mysqlQuote($conn, $values['title'])
            . ',' . mysqlQuote($conn, $values['description'])
            . ',' . mysqlQuote($conn, $values['briefDescription'])
            . ',' . mysqlQuote($conn, $values['catering'])
            . ',' . mysqlQuote($conn, $values['accommodation'])
            . ',' . mysqlQuote($conn, $returnPrice)
            . ',' . mysqlQuote($conn, $oneWayPrice)
            . ')';
                 echo $sql;
    return executeSql($conn, $sql);
}

/**
 * Validuje odeslaná formulářová data
 * @param array $values
 * @return array
 */
function validateForm(array $values)
{
    $errors = array();
	if((int) $values['continent_id'] < 1)
	{
		$errors['continent_id'] = 'Zvolte kontinent';		
	}
	
    if (!validateDate($values['dtValidFrom']))
	{
		$errors['dtValidFrom'] = 'Vyplňte platnost od ve správném formátu';		
	}
	if (!validateDate($values['dtValidTo']))
	{
		$errors['dtValidTo'] = 'Vyplňte platnost do ve správném formátu';
	}
    if (strlen($values['dtValidTo']) == 0)
    {
        $errors['dtValidTo'] = 'Vyplntě platnost do';
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
    if (strlen($values['returnPrice']) == 0)
    {
        $errors['returnPrice'] = 'Zadejte zpatečný cenu';
    }
    if (strlen($values['oneWayPrice']) == 0)
    {
        $errors['oneWayPrice'] = 'Zadejte jednosmernu cenu';
    }
    return $errors;
}
