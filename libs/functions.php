<?php
function loadTemplate($template, array $data)
{
	extract($data);
	ob_start();	//nastartuje OB
	include TEMPLATES_DIR . '/' . $template;	
	return ob_get_clean();  //vsetko vrati do returnu 
}

/**
 * Vrací hodnotu pole zvoleného podle indexu pokud existuje, 
 * jinak prázdný řetězec
 * @param array $array Pole hodnot
 * @param int|string $index
 * @return array value | empty string
 */
function getArrayValue(array $array, $index)
{
	return isset($array[$index]) ? $array[$index] : '';	
}

function isMail($email)
{
	$atom = '[-a-z0-9!#$%&\'*+/=?^_`{|}~]';
	$host = '[a-z0-9]([-a-z0-9]{0,61}[a-z0-9])';
	return eregI("^$atom+(\\.$atom+)*@($host?\\.)+$host\$", $email);
}

/**
 * Ověřuje platnost datum pro formát j.n.Y H:i
 * @param type $datetime
 * @return boolean
 */
function isDateTime($datetime)
{
	if(date_create_from_format('j. n. Y H:i', $datetime))
	{
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}

function validateDate($date, $format = 'j. n. Y')
{
	$d = DateTime::createFromFormat($format, $date);
	return $d && $d->format($format) == $date;
}

/**
 * Ověří, zda se jedná o celé číslo (volitelně nenulové | nulové)
 * @param void $id Testovaný parametr
 * @param boolean $notZero Zda musí být zároveň větší než nula
 * @return boolean
 */
function isIntId($id, $notZero = TRUE)
{	
	if(!ctype_digit($id))
	{
		return FALSE;
	}
	elseif((int) $id < 1 && $notZero)
	{
		return FALSE;
	}
	
	return TRUE;
}


/**
 * Formátuje datum z DB do formátu j. n. Y H:i
 * @param string $datetime
 * @return string
 */
function formatToDateTime($datetime, $format = 'j. n. Y H:i')
{
	$dt = date_create($datetime);
	
	return date_format($dt, $format);
}

/**
 * Formátuje datum z DB do formátu j. n. Y
 * @param string $datetime
 * @return string
 */
function formatToDate($datetime, $format = 'j. n. Y')
{
	$dt = date_create($datetime);
	
	if ($dt === FALSE)
	{
		return '';
	}
	else
	{
		return date_format($dt, $format);
	}
}

/**
 * Formátuje datum z formátu j. n. Y do DB
 * @param string $datetime
 * @return string
 */
function formatDateToDb($datetime, $format = 'j. n. Y')
{
	$dt = date_create_from_format($format, $datetime);
	
	return date_format($dt, 'Y-m-d');
}

function clearPriceValue($value)
{
	return intval(preg_replace("/[^0-9]/","",$value), 10);
}