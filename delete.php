<?php
	include 'include/dbconnect.php';
	$id = $_GET['id'];

	$query = "DELETE FROM cart WHERE id = '$id'";
	$result = mysqli_query($conn,$query);

	echo "<script>window.location = 'index.php'</script>";
?>