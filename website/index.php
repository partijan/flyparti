<?php
require __DIR__ . '/../app/bootstrap.php';

/* Připojení k DB */
$conn = getConnection();

/* CSS a JS link do hlavičky */
$data = array();
$data['links'] = array();
$css = loadTemplate('front/headCssLinks.php', $data);

$data = array();
$data['links'] = array();
$data['links'] = array('js/funkce.js');
$js = loadTemplate('front/headJsLinks.php', $data);

$layout['head_content'] = $css . $js;

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'index.php';

$layout['content_menu_box'] = loadTemplate('front/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = WEB_TITLE;

/* Obsah - Nejoblibenejsi destinace */
$data = array();
$data['destinations'] = getTopDestinations($conn, 4);
$layout['content_wrapper'] = loadTemplate('front/destination/topDestinationsBox.php', $data);

/* Pravý sloupec */
$data = array();
$layout['content_side_wrapper'] = loadTemplate('front/sideWrapper.php', $data);

echo loadTemplate('front/@layout.php', $layout);