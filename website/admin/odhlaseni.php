<?php
require '../../app/bootstrap-admin.php';
require './secured.php';
unset($_SESSION['user']);
 session_destroy();
header("location: ./login.php?result=loggedout");