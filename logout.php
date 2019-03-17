<?php
	error_reporting(0);
	include 'include/dbconnect.php';
	session_start();
	if ($_SESSION['table']) {
		$tno = $_SESSION['table'];
		$query = "DELETE FROM cart WHERE tableno = '$tno'";
		$result = mysqli_query($conn,$query);
	}
	session_destroy();
	header("location:index.php");
	exit();
?>