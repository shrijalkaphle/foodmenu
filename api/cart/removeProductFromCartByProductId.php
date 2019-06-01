
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
 

    require('../../include/dbconnect.php');
   

    /*============ Get Post Data ===========*/
    $json_str = file_get_contents('php://input');

    $json_obj = json_decode($json_str);

    $response = [];

    $productId = $json_obj->product_id;

    /*============ Send Data ===========*/
    //check if product exist

    $query = "DELETE FROM cart WHERE productid = '$productId'";
    $result = mysqli_query($conn, $query);

    echo json_encode($query);

    header('Content-Type: application/json');

    //Close Connection
    mysqli_close($conn);


}

?>