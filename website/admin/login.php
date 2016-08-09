<?php
require '../../app/bootstrap-admin.php';

/* Připojení k DB */
$conn = getConnection();


/* Hlavni menu */
// na stránce s přihlašovacím formulářem není žádné menu
$layout['content_menu_box'] = '';
		
/* Meta */
$data = array();
$layout['head_title'] = ' Přihlášení do administrace';

$result = '';


if ($_POST) 
{
	$errors = validateForm($_POST);
	
	if (count($errors) == 0)
	{
		$idUser = verifyFromDb($conn, $_POST['username'], $_POST['password']);
	
		
		if ($idUser == NULL)
		{
			$result = 'notAuthorized';
		}
		else 
		{
			setUserData($conn, $idUser);
			
			header("Location: ./vip-servis.php");
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

$layout['content_wrapper'] = getForm($_POST, $errors, $result);



echo loadTemplate('admin/@layout.php', $layout);


/* Vlastní funkce */
function getForm(array $values, array $errors, $result)
{
	$data = array();
	$data['values'] = $values;
	$data['errors'] = $errors;
	$data['result'] = $result;
		
	return loadTemplate('admin/login/loginForm.php', $data);
}

function validateForm(array $values)
{
	$errors = array();
	
	if(strlen($values['username']) == 0)
	{
		$errors['username'] = 'Vyplňte prosím své uživatelské jméno!';
	}
	
	if(strlen($values['password']) == 0)
	{
		$errors['password'] = 'Zadejte svoje prihlašovací heslo';
	}
	
	return $errors;
}

function verifyFromDb($conn, $username, $password)
{	
	$sql = 'SELECT id, password AS hash FROM user
			WHERE username = ' . mysqlQuote($conn, $username);
	
	$rows = getRowsSql($conn, $sql);
	
	if (count($rows) == 1)
	{	
		if (verify($password, $rows[0]['hash']))
		{
			return $rows[0]['id'];
		}
		else
		{
			return NULL;
		}
	}
	else
	{
		return NULL;
	}	
}

function verify($password, $hash)
{
	return $hash === getHash($password);
}

function getHash($password)
{
	$cost = 10;	
	$salt =  'Pbd7iTf6gr';
	
	$hash = crypt($password, '$2y$' . $cost . '$' . md5($salt));
	return $hash;
}
