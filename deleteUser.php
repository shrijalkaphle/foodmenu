<?php
	include 'include/dbconnect.php';
	$id =  $_GET['id'];

	$query = "DELETE FROM user WHERE id='$id'";
	$result = mysqli_query($conn,$query);

	echo "<script>window.location = 'admin_index.php'</script>";

?>