<?php
require __DIR__ . '/../app/bootstrap.php';
$conn = getConnection();
$data = array();
$data['destinations'] = getRssDestinations($conn);

header('Content-Type: application/rss+xml; charset=UTF-8');
echo loadTemplate('front/destination/rss.php', $data);
