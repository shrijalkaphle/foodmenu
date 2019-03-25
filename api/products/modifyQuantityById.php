
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
 

    require('../../include/dbconnect.php');
   

    /*============ Get Post Data ===========*/
    $json_str = file_get_contents('php://input');

    $json_obj = json_decode($json_str);

    $response = [];

    $id = $json_obj->id;
    $qty = $json_obj->qty;

    /*============ Send Data ===========*/
    //check if product exist

    if ($qty == 0) {
        $query = "DELETE FROM cart WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    } else {
        $query = "UPDATE cart SET qty = '$qty' WHERE id = '$id'";
        $result = mysqli_query($conn, $query);
    }

    echo json_encode($query);

    header('Content-Type: application/json');

    //Close Connection
    mysqli_close($conn);


}

?>