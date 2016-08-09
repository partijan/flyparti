<?php
require '../../app/bootstrap-admin.php';
require './secured.php';

if (getUserRole() != 'master')
{
	exit ('Not Authorized!');
}

$conn = getConnection();

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'admin/pridatRecenzi.php';
$layout['content_menu_box'] = loadTemplate('admin/menuBox.php', $data);
/* Meta */
$data = array();
$layout['head_title'] = 'Přidání reference';

$result = '';

if ($_POST) 
{
	$errors = validateForm($_POST);
	$values = $_POST;
			
	if (count($errors) == 0)
	{
		$result = proccessForm($conn, $_POST);
		if ($result != NULL && $result > 0)
		{
			header("Location: pridatRecenzi.php?result=success");
		}
		else 
		{
			$result = 'errors';			
		}		
	}
}
else 
{
	$values = $errors = array();
	
	if(isset($_GET['result']))
	{
		$result = $_GET['result'];
	}
}
$layout['content_wrapper'] = getForm($conn, $values, $errors, $result);

echo loadTemplate('admin/@layout.php', $layout);


/**
 * Zobrazuje formul�� pro zad�n� po�adavku
 * @param array $values
 * @param array $errors
 * @param type $result
 * @return string HTML
 */
function getForm($conn, array $values, array $errors, $result)
{
	$data = array();
	$data['values'] = $values;
	$data['errors'] = $errors;
	$data['result'] = $result;
	
	$data['destinations'] = getAllDestinations($conn, 'id, title', 'title ASC');
	
	return loadTemplate('admin/pridatRecenzi/form.php', $data);
}

function proccessForm($conn, array $values)
{	
	$sql = 'INSERT INTO reference ( destination_id,dtCreated,text, author) 
			VALUES (' . mysqlQuote($conn, $values['destination_id']) . ',NOW(),' . mysqlQuote($conn, $values['text']) . ',' . mysqlQuote($conn, $values['author']) . ')';
	
	return executeSql($conn, $sql);
}

function validateForm(array $values)
{
	$errors = array();
	
	if(!isIntId($values['destination_id']))
	{
		$errors['destination_id'] = 'Zvolte prosím destinaci!';
	}
	
	if(strlen($values['text']) == 0)
	{
		$errors['text'] = 'Vyplňte prosím text reference!';
	}
	
	if(strlen($values['author']) == 0)
	{
		$errors['author'] = 'Vyplňte prosím kontakt nebo jméno!';
	}
	
	return $errors;
}