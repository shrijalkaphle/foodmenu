<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
    /*============ Connection ===========*/
    include "../../include/dbconnect.php";
    
    /*============ Send Data ===========*/
    $sql = "SELECT * FROM notifications";
    //Check if sucess
    $q = mysqli_query($conn,$sql);
    $rows = array();
    while($r = mysqli_fetch_assoc($q)) {
        $rows[] = $r;
    }
    echo json_encode($rows);
    header('Content-Type: application/json');
    //Close Connection
    mysqli_close($conn);
}
?>