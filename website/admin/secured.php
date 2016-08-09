<?php
if (!isUserLogged())
{
	header("Location: ./login.php");
}