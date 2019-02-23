<?php
	include 'include/dbconnect.php';
	$id = $_GET['id'];
	$query = "INSERT INTO history (SELECT * FROM pending WHERE id='$id')";
	$result = mysqli_query($conn,$query);

	$row

	$query2 = "DELETE FROM pending WHERE id='$id'";
	$result2 = mysqli_query($conn,$query2);

	echo "<script>window.location = 'staff_index.php'</script>";
?>