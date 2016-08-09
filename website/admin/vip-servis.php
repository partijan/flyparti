<?php
require '../../app/bootstrap-admin.php';
require './secured.php';

/* Připojení k DB */
$conn = getConnection();


/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'admin/vip-servis.php';
$layout['content_menu_box'] = loadTemplate('admin/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'VIP servis';

$result = '';
if ($_POST)
{
	$errors = validateForm($_POST);

	if (count($errors) == 0)
	{

		$result = processForm($conn, $_POST);

		if ($result != NULL && $result > 0)
		{
			header("Location:vip-servis.php?result=success");
		}
		else
		{
			$result = 'errors';
			$data['values'] = $_POST;
			$data['errors'] = $errors;
			$data['result'] = $result;
			$layout['content_wrapper'] = loadTemplate('admin/vip-servis/form.php', $data);
		}
	}
	else
	{
		$data['values'] = $_POST;
		$data['errors'] = $errors;
		$data['result'] = '';
		$layout['content_wrapper'] = loadTemplate('admin/vip-servis/form.php', $data);
	}
}
else
{
	$values = $errors = array();
	if (isset($_GET['id']))
	{

		$data['values'] = getVipServis($conn, $_GET['id']);
		$data['errors'] = array();
		$data['result'] = '';
		$layout['content_wrapper'] = loadTemplate('admin/vip-servis/form.php', $data);
	}
	else
	{
		$data['items'] = loadVipServisList($conn);
		$layout['content_wrapper'] = loadTemplate('admin/vip-servis/list.php', $data);
	}
}
echo loadTemplate('admin/@layout.php', $layout);

function getForm(array $values, array $errors, $result)
{
	$data = array();
	$data['values'] = $values;
	$data['errors'] = $errors;
	$data['result'] = $result;

	return loadTemplate('admin/vip-servis/form.php', $data);
}

//vlastni funkce pro vip-servis
function loadVipServisList($conn)
{
	$sql = 'SELECT email,dtCreated,name,id
                FROM vipServis
                WHERE dtAnswered IS NULL';

	return getRowsSql($conn, $sql);
}

function getVipServis($conn, $id)
{
	$sql = 'SELECT email,name,text,id
                FROM vipServis
                WHERE id = ' . mysqlQuote($conn, $id);
	$data = getRowsSql($conn, $sql);
	return $data[0];
}

function processForm($conn, array $values)
{
	$sql = 'UPDATE vipServis
			SET dtAnswered = NOW()
			WHERE id = ' . mysqlQuote($conn, $values['id']);
	return executeSql($conn, $sql);
}

function validateForm(array $values)
{
	$errors = array();

	if (strlen($values['name']) == 0)
	{
		$errors['name'] = 'Vyplňte prosím jméno!';
	}

	if (!isMail($values['email']))
	{
		$errors['email'] = 'Vyplňte prosím email!';
	}
	elseif (!isMail($values['email']))
	{
		$errors['email'] = 'Vyplňte zkontrolujte překlepy a zvolte e-mail ve správném formátu!';
	}

	if (strlen($values['text']) == 0)
	{
		$errors['text'] = 'Vyplňte prosím text!';
	}

	return $errors;
}
