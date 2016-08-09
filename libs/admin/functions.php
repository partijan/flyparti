<?php
function getTopDestinations($conn, $number)
{
	$sql = 'SELECT id,title
			FROM destination
                        WHERE deleted = 0 AND disabled = 0 AND dtValidTo >= NOW()
                        ORDER BY dtCreated DESC
			LIMIT ' . $number;

	return getRowsSql($conn, $sql);
}

function getMenu()
{
	$items = array();
	
	$items['odhlaseni.php'] = 'Odhlašení';
	$items['vip-servis.php'] = 'VIP servis';
	
	
	if (getUserRole() == 'master')
	{
		$items['pridatRecenzi.php'] = 'Reference - přidat';
		$items['pridatDestinaci.php'] = 'Destinace - přidat';
		
	}
    
	$items['editaceDestinaci.php'] = 'Destinace - editovat';
	
	return $items;
}

function isUserLogged()
{
	return getUserData('logged');
}

function getUserRole()
{
	return getUserData('idRole');
}

function setUserData($conn, $idUser)
{
	$sql = 'SELECT firstname, surname, email, idRole FROM user
			WHERE id = ' . mysqlQuote($conn, $idUser);
	
	$rows = getRowsSql($conn, $sql);
	
	$_SESSION['user']['logged'] = TRUE;
	
	$_SESSION['user']['id'] = $idUser;
	$_SESSION['user']['idRole'] = $rows[0]['idRole'];
	
	$_SESSION['user']['firstname'] = $rows[0]['firstname'];
	$_SESSION['user']['surname'] = $rows[0]['surname'];
	$_SESSION['user']['email'] = $rows[0]['email'];
	
}

function getUserData($value)
{
    if (is_array($_SESSION['user']))
    {
        return getArrayValue($_SESSION['user'], $value);
    }
    else
    {
        return'';
    }
}

function getTopDestinationsByMonth($conn, $number)
{
	$html = '<h3>Top 3 pro tenhle mnesic </h3>';

	$SQL = 'SELECT id,title,briefDescription
               FROM destination
               ORDER BY title
               LIMIT ' . $number;
	$data = getRowsSql($conn, $SQL);

	foreach ($data as $row)
	{
		'<h3>' . $row['title'] . '</h3>';
		$html .= '<h3>Vietnam a Kambodža</h3>';
		$html .= '<img src="Obrazky/sydny.jpg" width="150" height="100" alt="obrazek" />
                        <p>' . $row['briefDescription'] . '</p>';
	}

	return $html;
}

function getReference($conn)
{
	$sql = 'SELECT r.dtCreated, r.text, r.author, d.id, d.title
			FROM reference AS r 
			INNER JOIN destination AS d
				ON r.destination_id = d.id
			ORDER BY r.dtCreated DESC';
	return getRowsSql($conn, $sql);
}

function getDestinationDetail($conn, $idDestination)
{
	$sql = 'SELECT d.id, d.title, d.description, d.catering, d.accommodation, d.briefDescription, d.oneWayPrice, d.returnPrice, d.discountPrice, d.discountDescription
           FROM destination AS d
           WHERE d.deleted = 0 AND d.id = ' . $idDestination;
	$data = getRowsSql($conn, $sql);
		
	return $data[0];
}

function getFlights($conn, $idDestination, $idFlight = 0)
{
	$sql = 'SELECT dtDeparture,	dtArrival, numberOfSeats
           FROM flight
           WHERE destination_id = ' . $idDestination;
	
	if ($idFlight > 0)
	{
		$sql .= ' AND id = ' . $idFlight;
	}
	
	$sql .= ' ORDER BY dtDeparture';
	
	return getRowsSql($conn, $sql);
}

function getAllDestinations($conn, $select, $order)
{
	$sql = 'SELECT ' . $select . '
			FROM destination';
	
	if ($order != '')
	{
		$sql .= ' ORDER BY ' . $order;
		
	}
	
	return getRowsSql($conn, $sql);
}

function getContinents($conn)
{
	$sql = 'SELECT id, title
           FROM continent
		   ORDER BY title';
		
	return getRowsSql($conn, $sql);
}