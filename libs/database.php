<?php
/**
 * @param  string   $servername     název serveru
 * @param  string   $username       jméno uživatele DB připojení
 * @param  string   $password       heslo
 * @param  string   $database       jméno databáze
 * @return string
 */
function getConnection($servername = '', $username = '', $password = '', $database = '')
{
    switch (MODE) {
        case 'DEVELOPMENT':
            $dbServerName = DB_SERVER_NAME_DEVELOPMENT;
            $dbUserName = DB_USER_NAME_DEVELOPMENT;
            $dbPassword = DB_PASSWORD_DEVELOPMENT;
            $dbName = DB_NAME_DEVELOPMENT;
            break;

        case 'PRODUCTION':
            $dbServerName = DB_SERVER_NAME_PRODUCTION;
            $dbUserName = DB_USER_NAME_PRODUCTION;
            $dbPassword = DB_PASSWORD_PRODUCTION;
            $dbName = DB_NAME_PRODUCTION;
            break;
        
        default:
            break;
    }
    
    $servername = $servername == '' ? $dbServerName : $servername; /*ternarni operator*/
    $username = $username == '' ? $dbUserName : $username;
    $password = $password == '' ? $dbPassword : $password;
    $database = $database == '' ? $dbName : $database;
    
    $conn = mysqli_connect($servername, $username, $password, $database); //php funkce//
    
    if (!$conn) {
        return NULL;
    }
    else
    {
        mysqli_set_charset($conn, 'utf8');
        return $conn;
    }
}

/**
 * Získá data z databáze jako asociativní pole
 * @param   mysqli_connect      $connection     databázove připojení (vrací fce getConnection)
 * @param   string              $sql            SQL příkaz pro výběr dat
 * @return  array  asociativní pole řádků získaných dat
 */
function getRowsSql($connection, $sql) //prima conection a pak dotaz//
{	
	$data = array();
	
	$result = mysqli_query($connection, $sql);	
	if($result)
	{		
		while ($row = mysqli_fetch_assoc($result))
		{
			$data[] = $row;
		}
	}
    return $data;
}

/**
 * Vrací počet ovlivněných řádků
 * @param type $connection
 * @param type $sql
 * @return int
 */
function executeSql($connection, $sql)
{
	if (mysqli_real_query($connection, $sql))
	{
		return mysqli_affected_rows($connection);
	}
	else 
	{
		return null;
	}
}

/**
 * Ošetření dat předávaných do databáze
 * @param type $value
 * @return string
 */
function mysqlQuote($conn, $value)
{
	if (is_null($value))
	{
		return "NULL";
	}

	if (is_int($value) || is_float($value))
	{
		return $value;
	}
	
	if (is_bool($value))
	{
		return $value ? 1 : 0;
	}
	
	return "'" . mysqli_real_escape_string($conn, $value) . "'";
}