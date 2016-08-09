<?php
require __DIR__ . '/../app/bootstrap.php';
$conn = getConnection();
$data = array();
$data = getRandomDestination($conn);
echo loadTemplate('front/destination/randomDestination.php', $data[0]);