<?php
require __DIR__ . '/../app/bootstrap.php';

/* Připojení k DB */
$conn = getConnection();

/* CSS a JS link do hlavičky */
$data = array();
$data['links'] = array('css/forms.css');
$css = loadTemplate('front/headCssLinks.php', $data);

$data = array();
$data['links'] = array();
$js = loadTemplate('front/headJsLinks.php', $data);

$layout['head_content'] = $css . $js;

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'vip-servis.php';
$layout['content_menu_box'] = loadTemplate('front/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'VIP servis | ' . WEB_TITLE;

$result = '';

/* Vlastní aplikační logika */
if ($_POST) 
{
	/* Formulář byl odeslán */
	$errors = validateForm($_POST);
	
	if (count($errors) == 0)
	{
		/* Formulář je v pořádku, můžeme zpracovat data */
		$result = proccessForm($conn, $_POST);
		if ($result != NULL && $result > 0)
		{
			/* Zpracování OK, přesměrujeme stránku */
			header("Location: vip-servis.php?result=success");
		}
		else 
		{
			/* Došlo k chybě při zápisu do DB */
			$result = 'error';			
		}		
	}
}
else 
{
	/* Formulář nebyl odeslán, řešíme normální požadavek */
	$values = $errors = array();
	 
	if(isset($_GET['result']))
	{
		$result = $_GET['result'];
	}
}

$layout['content_wrapper'] = getForm($_POST, $errors, $result);

echo loadTemplate('front/@layout.php', $layout);


/**
 * Zobrazuje formulář pro zadání požadavku
 * @param array $values
 * @param array $errors
 * @param type $result
 * @return string HTML
 */
function getForm(array $values, array $errors, $result)
{
	$data = array();
	$data['values'] = $values;
	$data['errors'] = $errors;
	$data['result'] = $result;
		
	return loadTemplate('front/vipServis/form.php', $data);
}

/**
 * Vrací počet ovlivněných záznamů (INSERT nebo UPDATE)
 * @param type $conn
 * @param array $values
 * @return int
 */
function proccessForm($conn, array $values)
{	
	$sql = 'INSERT INTO vipServis (email, dtCreated, text, name) 
			VALUES (' . mysqlQuote($conn, $values['email']) . ', NOW(),' . mysqlQuote($conn, $values['message']) . ',' . mysqlQuote($conn, $values['name']) . ')';
	
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
	
	if(strlen($values['name']) == 0)
	{
		$errors['name'] = 'Vyplňte prosím jméno! ';
	}
	
	if(strlen($values['email']) == 0)
	{
		$errors['email'] = 'Vyplňte prosím email! ';
	}
	elseif(!isMail($values['email']))
	{
		$errors['email'] = 'Vyplňte zkontrolujte překlepy a zvolte e-mail ve správném formátu! ';
	}
	
	if(strlen($values['message']) == 0)
	{
		$errors['message'] = 'Vyplňte prosím text!';
	}
	
	return $errors;
}