<?php
	error_reporting(0);
	$stat = $_GET[stat];
	session_start();
	session_destroy();
	header("location:index.php");
	exit();
?>