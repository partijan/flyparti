<?php
require __DIR__ . '/../app/bootstrap.php';

/* Připojení k DB */
$conn = getConnection();

/* CSS a JS link do hlavičky */
$data = array();
$data['links'] = array('css/front/detail.css');
$css = loadTemplate('front/headCssLinks.php', $data);

$data = array('');
$data['links'] = array();
$js = loadTemplate('front/headJsLinks.php', $data);

$layout['head_content'] = $css . $js;

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'destinace.php';
$layout['content_menu_box'] = loadTemplate('front/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'Destinace | ' . WEB_TITLE;

/* Obsah */
if(isset($_GET['idDestinace']))
{	
	/* Obsah - detail */
	$detail = getDestinationDetail($conn, $_GET['idDestinace']);
    $layout['content_wrapper'] = loadTemplate('front/destination/detail.php', $detail);
	
	$layout['head_title'] = $detail['title'] . ' | Destinace |' . WEB_TITLE;
}
else
{
	/* Obsah - výpis */
	$data = array();
	
	if(isset($_GET['kontinent']) && isIntId($_GET['kontinent']))
	{
		$idContinent = $_GET['kontinent'];
	}
	else
	{
		$idContinent = '';
	}
	
	$data['destinations'] = getDestinations($conn, $idContinent);
	$data['continents'] = getContinents($conn, $idContinent);
	
    $layout['content_wrapper'] = loadTemplate('front/destination/list.php', $data);
}

echo loadTemplate('front/@layout.php', $layout);