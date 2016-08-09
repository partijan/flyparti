<?php
require __DIR__ . '/../app/bootstrap.php';

/* Připojení k DB */
$conn = getConnection();
$layout=array();
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
$data['currentPage'] = 'objednavka-destinace.php';
$layout['content_menu_box'] = loadTemplate('front/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'Objednávka | ' . WEB_TITLE;
$result = '';
$data = array();

/* Obsah */

if($_POST) // testuju, zda byl objednávkový formulář odeslán
{
	/* Formulář byl odeslán */
	
	
	$idDestination = $_POST['idDestination'];
	
	$errors = validateForm($_POST);//funkce kontroluje povinná data a jejich správnost
        	if(count($errors)==0)
	{
                    
		$result = proccessForm ($conn, $_POST);
		
                if ($result !=NULL && $result > 0)
		{
			header("Location:destinace.php?result=success");
		}
		else
		{
			$result='error';
		}
	}
	else
	{
		
            
		$data['values'] = $_POST; // nastavím pole $values (hodnoty políček) na původní odeslané
		$data['errors'] = $errors; // nastavím prázdné pole $errors (hodnoty chyb po odeslání)	   
		$data['destination'] = getDestinationDetail($conn, $idDestination); // nastavím proměnnou $destination (bude to pole hodnot pro danou destinaci)
		$data['flights'] = getFlights($conn, $idDestination); // nastavím proměnnou $flights (bude to pole hodnot z tabulky flight)
		
		$layout['content_wrapper'] = loadTemplate('front/destination/orderForm.php', $data); // pošleme to do šablony a necháme si vrátit celý formulář
	}
} 
else
{
	
	if (isset($_GET['idDestinace'])) // testuju, zda byl předán v URL parametr s ID destinace
	{
		/* mám ID destinace */
		$idDestination = $_GET['idDestinace'];
				
		if(isset($_GET['result'])) // testuju, jestli bylo také předáno ID resultu (výsledku)
		{
			/* mám i ID resultu */
			$result = $_GET['result'];
                        $layout['content_wrapper'] = getForm($_POST, $errors, $result);

		}
                
		else
		{

			$data['values'] = array(); // nastavím prázdné pole $values (hodnoty políček)
			$data['errors'] = array(); // nastavím prázdné pole $errors (hodnoty chyb po odeslání)
			$data['destination'] = getDestinationDetail($conn, $idDestination); // nastavím proměnnou $destination (bude to pole hodnot pro danou destinaci)
			$data['flights'] = getFlights($conn, $idDestination); // nastavím proměnnou $flights (bude to pole hodnot z tabulky flight)
			
			$layout['content_wrapper'] = loadTemplate('front/destination/orderForm.php', $data); // pošleme to do šablony a necháme si vrátit celý formulář
		}
	}
	else
	{
		
		$data['destinations'] = getDestinations($conn); // získám si pole s destinacema
		$layout['content_wrapper'] = loadTemplate('front/destination/list.php', $data); // naplním proměnnou $content_wrapper pro hlavní šablonu
		
	}
	$values = $errors = array();

	if(isset($_GET['result']))
	{
		$result = $_GET['result'];
	}
}

echo loadTemplate('front/@layout.php', $layout); // hotovo, už není co dělat dál, tak to pošlu na výstup přes šablonu @layout.php


function getForm(array $values, array $errors, $result)
{
    	$data = array();
	$data['values'] = $values;
	$data['errors'] = $errors;
	$data['result'] = $result;
	
	return loadTemplate('front/destination/orderForm.php', $data);
}

function proccessForm($conn, array $values)
  {	
	$sql = 'INSERT INTO orderdestination (firstname, 
                                                surname,
                                                email, 
                                                phone,
                                                address,
                                                city, 
                                                state, 
                                                flight_id, 
                                                personCount,
                                                dtCreated) 
        VALUES ('. mysqlQuote($conn, $values['firstname']) .','.
                   mysqlQuote($conn, $values['surname']).',' . 
                   mysqlQuote($conn, $values['email']).',' .
                   mysqlQuote($conn, $values['phone']).',' . 
                   mysqlQuote($conn, $values['address']).',' .
                   mysqlQuote($conn, $values['city']).',' .
                   mysqlQuote($conn, $values['state']).',' .
                   mysqlQuote($conn, $values['idFlight']).',' .
                   mysqlQuote($conn, $values['personCount']).',' .
                 'NOW()'.
                ')';
	
	echo $sql; 
        return executeSql($conn, $sql);
}

function validateForm(array $values)
{
	$errors = array();
        
	if(strlen(getArrayValue($values, 'idFlight')) == 0)
	{
		$errors['idFlight'] = 'Vyplňte prosím cislo letu!';
	}
	if(strlen($values['firstname']) == 0)
	{
		$errors['firstname'] = 'Vyplňte prosím jméno!';
	}
	
	if(strlen($values['surname']) == 0)
	{
		$errors['surname'] = 'Vyplňte prosím příjmnení!';
	}
        if(strlen($values['address']) == 0)
	{
		$errors['address'] = 'Vyplňte prosím svojí adresu!';
	}
        if(strlen($values['city']) == 0)
	{
		$errors['city'] = 'Vyplňte prosím město!';
	}
        
	if(strlen($values['email']) == 0)
	{
		$errors['email'] = 'Vyplňte prosím email!';
	}
	elseif(!isMail($values['email']))
	{
		$errors['email'] = 'Vyplňte zkontrolujte překlepy a zvolte e-mail ve správném formátu!';
	}
	
	if(strlen($values['phone']) == 0)
	{
		$errors['phone'] = 'Vyplňte prosím svoje telefonní číslo!';
	}
        if(strlen($values['personCount']) == 0)	{
		$errors['personCount'] = 'Zadejte prosím počet cestujícich!';
	}
	return $errors;
}
