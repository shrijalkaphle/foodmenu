<?php
	include 'include/header.php';

	if (isset($_POST['id'])) {
		$id = $_POST['id'];
		$table = $_SESSION['table'];

		$query = "SELECT * FROM cart WHERE productid = '$id'";
		$result = mysqli_query($conn,$query) or die('error');
		$r = mysqli_fetch_assoc($result);
		$num = mysqli_num_rows($result);

		if ($num == 0) {
			$query = "INSERT INTO cart(tableno,productid,qty) VALUES ('$table','$id','1')";
			$result = mysqli_query($conn,$query) or die('error');
		} else {
			$oqty = $r['qty'];
			$id = $r['id'];

			$nqty = 1 + $oqty;

			$query = "UPDATE cart SET qty = '$nqty' WHERE id = '$id'";
			$result = mysqli_query($conn,$query);
		}
	}
?>