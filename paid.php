<?php
	include 'include/header.php';
	$table = $_GET['tid'];

	//echo $table;
	
	$query = "SELECT * FROM ordered WHERE tableno='$table'";
	$result = mysqli_query($conn,$query);

	while ($row = mysqli_fetch_assoc($result)) {
		$pid = $row['productid'];
		$qty = $row['qty'];

		//date_default_timezone_set('Asia/Kathmandu');
		$date = date('Y-m-d H:i:s');

		$query1 = "INSERT INTO sales(productid,qty,datetime) VALUES ('$pid','$qty','$date')";
		$result1 = mysqli_query($conn,$query1) or die('error');
	}

	$query2 = "DELETE FROM ordered WHERE tableno='$table'";
	$result2 = mysqli_query($conn,$query2);

	$query3 = "DELETE FROM order_details WHERE tableno='$table'";
	$result3 = mysqli_query($conn,$query3);

	$updatedOrderDetails = "SELECT * FROM order_details";
    $updatedOrderDetailsResult = mysqli_query($conn,$updatedOrderDetails);
	$row_cnt = mysqli_num_rows($updatedOrderDetailsResult);
	
?>
<script>
	localStorage.setItem('row-count',<?php echo $row_cnt ?>);
	window.location = 'staff_index.php'

</script>