<?php
	include 'include/header.php';

	$tno = $_GET['tno'];
	//echo $tno;
	$total = null;
	$_SESSION['visit'] = 0;

	$query = "SELECT * FROM cart WHERE tableno='$tno'";
	$result = mysqli_query($conn,$query);

	while ($row = mysqli_fetch_assoc($result)) {
		$pid = $row['productid'];
		$qty = $row['qty'];
		
		$query1 = "INSERT INTO ordered(tableno,productid,qty) VALUES ('$tno','$pid','$qty')";
		$result1 = mysqli_query($conn,$query1);

		$query3 = "SELECT * FROM product where id='$pid'";
		$result3 = mysqli_query($conn,$query3);
		$r = mysqli_fetch_assoc($result3);
		
		$total = $total + $qty * $r['price'];
	}

	$query2 = "DELETE FROM cart WHERE tableno='$tno'";
	$result2 = mysqli_query($conn,$query2);

	$query4 = "INSERT INTO order_details(tableno,price) VALUES ('$tno','$total')";
	$result4 = mysqli_query($conn,$query4);

	// $query4 = "SELECT * FROM order_details WHERE tableno = '$tno'";
	// $result4 = mysqli_query($conn,$query4);
	// $r1 = mysqli_fetch_assoc($result4);
	// $n = mysqli_num_rows($result4);
	// if($n != 0) {
	// 	$price = $r1['price'];
	// 	$total = $price + $total;
	// 	$query5 = "INSERT INTO order_details(tableno,price) VALUES ('$tno','$total')";
	// 	$result5 = mysqli_query($conn,$query5);
	// } else {
	// 	$query5 = "INSERT INTO order_details(tableno,price) VALUES ('$tno','$total')";
	// 	$result5 = mysqli_query($conn,$query5);
	}


	//Notifications Table
	$message = "Table ".$tno." has placed an order";
	$insertIntoNotificationsTableQuery = "INSERT INTO notifications(message) VALUES('$message')";
	$notificationsTableQueryResult = mysqli_query($conn,$insertIntoNotificationsTableQuery);

	echo "<script>alert('Order Successfull')</script>";

	header('Location: index.php');

?>