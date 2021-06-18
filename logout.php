<?php
error_reporting(E_ALL ^ E_NOTICE);
	setcookie("username", "", time()-3600 );
	setcookie("password", "", time()-3600 );
	header("Location: login.php");
?>