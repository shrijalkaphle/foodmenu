<?php
	error_reporting(0);
	$stat = $_GET[stat];
	session_start();
	session_destroy();

	// if ($stat == 1) {
	// 	header("location:index.php");
	// }
	header("location:index.php");
	exit();
?>