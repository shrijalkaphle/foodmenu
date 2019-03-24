<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    /*============ Connection ===========*/
    include "../../include/dbconnect.php";

    /*============ Get Post Data ===========*/
    $json_str = file_get_contents('php://input');

    $json_obj = json_decode($json_str);

    $id = $json_obj->id;    
    
    /*============ Send Data ===========*/

    $sql = "UPDATE order_details SET seen_status=1 WHERE tableNo='$id'";
    $result = mysqli_query($conn,$sql);
    $response = array("responseCode"=>200);
    echo json_encode($response);
    header('Content-Type: application/json');
    
    //Close Connection
    mysqli_close($conn);
}
?>