<?php
	include 'include/header.php';

	$qty = $_POST['qty'];
	$id = $_POST['id'];

	$query = "UPDATE cart SET qty = '$qty' WHERE id = '$id'";
	$result = mysqli_query($conn, $query);
?>