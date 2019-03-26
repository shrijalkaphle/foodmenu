<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST'){
    
 

  require('../../include/dbconnect.php');

      /*============ Get Post Data ===========*/
      $json_str = file_get_contents('php://input');

      $json_obj = json_decode($json_str);
  
      $tableNo = $json_obj->tableNo;


   

    /*============ Send Data ===========*/
    $checkTableQuery = "SELECT * FROM cart WHERE tableno = '$tableNo'";

    $q = mysqli_query($conn,$checkTableQuery);

    $rows = array();
    
    /*
    Format
        {
            "cartId": "21",
            "name": "CocaCola",
            "price": "150",
            "productId": "3",
            "quantity": "1"
        }
    
    
    */

    while ($row=mysqli_fetch_assoc($q)){
        
        $id = $row['productid'];

        $getProductsQuery = "SELECT * FROM product WHERE id = '$id'";

        $productsResult = mysqli_query($conn,$getProductsQuery);

        $productResultRow=mysqli_fetch_assoc($productsResult);

        array_push($rows,

            array(

                'cartId'=>$row['id'],

                'name'=>$productResultRow['name'],

                'price'=>$productResultRow['price'],

                'productId'=>$productResultRow['id'],

                'quantity'=>$row['qty']

            )

        );
        
    }    
    
    echo json_encode($rows);
   
    header('Content-Type: application/json');
   
    //Close Connection
    mysqli_close($conn);


}

?>