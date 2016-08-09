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
$data['currentPage'] = 'reference.php';
$layout['content_menu_box'] = loadTemplate('front/menuBox.php', $data);

/* Meta */
$data = array();
$layout['head_title'] = 'Reference | ' . WEB_TITLE;

$data = array();
$data['references'] = getReference($conn);
$layout['content_wrapper'] = loadTemplate('front/reference/list.php', $data);

echo loadTemplate('front/@layout.php', $layout);