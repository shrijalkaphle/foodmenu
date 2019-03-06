
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
 

  require('include/dbconnect.php');

      /*============ Get Post Data ===========*/
      $json_str = file_get_contents('php://input');

      $json_obj = json_decode($json_str);
  
      $id = $json_obj->id;


    /*============ Delete Data ===========*/
    $deleteRowQuery = "DELETE FROM cart WHERE id = '$id'";

    $q = mysqli_query($conn,$deleteRowQuery);

    $response = array("statusCode"=>200);
    echo json_encode($response);
   
    header('Content-Type: application/json');
   
    //Close Connection
    mysqli_close($conn);


}

?>