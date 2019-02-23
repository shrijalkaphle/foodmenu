<?php
	include ('include/dbconnect.php');
	$id  = $_GET['id'];

	$res=mysqli_query($conn,"SELECT image FROM product WHERE id='$id'");
	$row = mysqli_fetch_array($res);

	mysqli_query($conn,"DELETE FROM product WHERE id='$id'");

	unlink('../images/'.$row['prod_image']);
	header("Location:admin_index.php");
?>