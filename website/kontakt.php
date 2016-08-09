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
$js = loadTemplate('front/headJsLinks.php', $data);

$layout['head_content'] = $css . $js;

/* Hlavni menu */
$data = array();
$data['menuItems'] = getMenu();
$data['currentPage'] = 'kontakt.php';
$layout['content_menu_box'] = loadTemplate('front/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'Kontakt | ' . WEB_TITLE;

$data = array();
$data['branches'] = getBranch($conn);
$layout['content_wrapper'] = loadTemplate('front/branch/list.php', $data);

echo loadTemplate('front/@layout.php', $layout);