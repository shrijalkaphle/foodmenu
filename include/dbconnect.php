<?php
	$host = "localhost";
	$pwd = "";
	$user = "root";
	$db = "foodmenu";

	$conn = mysqli_connect($host,$user,$pwd,$db);

	if (!$conn) {
		die("error");
	}
?>