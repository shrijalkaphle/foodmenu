<?php
	include 'include/header.php';

	$qty = $_POST['qty'];
	$id = $_POST['id'];

	if ($qty == 0) {
		$query = "DELETE FROM cart WHERE id = '$id'";
		$result = mysqli_query($conn, $query);
	} else {
		$query = "UPDATE cart SET qty = '$qty' WHERE id = '$id'";
		$result = mysqli_query($conn, $query);
	}
?>