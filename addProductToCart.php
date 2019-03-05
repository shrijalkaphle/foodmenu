<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
 

    require('include/dbconnect.php');
   

    /*============ Get Post Data ===========*/
    $json_str = file_get_contents('php://input');

    $json_obj = json_decode($json_str);

    $response = [];

    $id = $json_obj->id;
    $tableNo = $json_obj->tableNo;
    $qty = $json_obj->qty;

    /*============ Send Data ===========*/
    //check if product exist

		$query = "SELECT * FROM cart WHERE productid = '$id'";
		$result = mysqli_query($conn,$query) or die('error');
		$r = mysqli_fetch_assoc($result);
		$num = mysqli_num_rows($result);

		if ($num == 0) {
			$query = "INSERT INTO cart(tableno,productid,qty) VALUES ('$tableNo','$id','1')";
			$result = mysqli_query($conn,$query) or die('error');
		} else {
			$oqty = $r['qty'];
			$id = $r['id'];

			$nqty = 1 + $oqty;

			$query = "UPDATE cart SET qty = '$nqty' WHERE id = '$id'";
			$result = mysqli_query($conn,$query);
        }
        $response = array("statusCode"=>200);

    echo json_encode($response);

    header('Content-Type: application/json');

    //Close Connection
    mysqli_close($conn);


}

?>