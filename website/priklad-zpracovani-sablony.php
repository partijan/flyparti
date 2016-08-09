<?php
$items = array();
	
$items['odhlaseni.php'] = 'Odhlašení';
$items['vip-servis.php'] = 'VIP servis';
$items['pridatRecenzi.php'] = 'Reference - přidat';
$items['pridatDestinaci.php'] = 'Destinace - přidat';
$items['editaceDestinaci.php'] = 'Destinace - editovat';

foreach ($items as $key => $value)
{
    //echo '<h2>' . $value . '</h2>';
}


$values = array();

$values['moje'] = 'Jakous';
$values['tvoje'] = 'Parti';


extract($values);


echo $tvoje;


