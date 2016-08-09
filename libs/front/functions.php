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
	$items['index.php'] = 'Úvod';
	$items['destinace.php'] = 'Destinace';
	$items['vip-servis.php'] = 'VIP servis';
	$items['reference.php'] = 'Reference';
	$items['kontakt.php'] = 'Kontakt';
    $items['rss.php'] = 'RSS';
    $items['admin/login.php'] = 'Prihlašení';

	return $items;
}

function getRandomDestination($conn)
{
	$sql = 'SELECT id, title, briefDescription, RAND() AS rnd
			FROM destination
			WHERE dtValidFrom <= NOW() AND disabled = 0 AND deleted = 0
			ORDER BY rnd
			LIMIT 1';

	return getRowsSql($conn, $sql);
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

function getBranch($conn)
{
	$sql = 'SELECT address,city,phone,namePersonContact,namePersonChief
			FROM branch
			ORDER BY city';

	return getRowsSql($conn, $sql);
}

function getContinents($conn, $idSelectedContinent)
{
	$sql = "SELECT id, title, CASE WHEN id = " . mysqlQuote($conn, $idSelectedContinent) . " THEN '1' ELSE '0' END  AS selected
			FROM continent";
	
	return getRowsSql($conn, $sql);
}

function getDestinations($conn, $idContinent = '')
{
	$sql = 'SELECT id,title,briefDescription,dtCreated
			FROM destination
			WHERE deleted = 0 AND disabled = 0 AND dtValidTo >= NOW()';
	
	if($idContinent != '')
	{
		$sql .= ' AND continent_id = ' . mysqlQuote($conn, $idContinent);
	}
	
	$sql .=	'ORDER BY dtCreated DESC';
			
	return getRowsSql($conn, $sql);
}

function getRssDestinations($conn)
{
  $sql ='SELECT id,title,briefDescription, dtCreated
                       FROM destination
                       WHERE deleted = 0 AND disabled = 0 AND dtValidTo >= NOW()
                       ORDER BY dtCreated DESC
                       LIMIT 50';  
  return getRowsSql($conn, $sql);
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
	$sql = 'SELECT dtDeparture,dtArrival,numberOfSeats,id
           FROM flight
           WHERE destination_id = ' . $idDestination;
	
	if ($idFlight > 0)
	{
		$sql .= ' AND id = ' . $idFlight;
	}
	
	$sql .= ' ORDER BY dtDeparture';
	
	return getRowsSql($conn, $sql);
}
function getFoto($conn)
{
	$sql = 'SELECT id,folderYear,fileName,title,destination_id
			FROM phpto';
	return getRowsSql($conn, $sql);
}