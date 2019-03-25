<?php
  include '../include/dbconnect.php';
 ?>

<div class="container order-div">
  <h2>Order</h2>
  <table class="table order-table table-striped">
    <thead>
      <td>Table Number</td>
      <td>Total</td>
      <td></td>
    </thead>
    <tbody class="order-table-body">
    <?php
      $query = "SELECT * FROM order_details";
      $result = mysqli_query($conn,$query);
      $row_cnt = mysqli_num_rows($result);
      while ($row = mysqli_fetch_assoc($result)) :
    ?>
    <tr class="order-row 
    <?php 
      if($row['seen_status']==0){
        echo(" order-unseen");
      }else{
        echo(" order-seen");
      }
    ?>
    ">
      <td><?php echo $row['tableno']; ?></td>
      <td><?php echo $row['price']; ?></td>
      <td>
      	<input type="hidden" name="user_id" value="<?php echo $row['tableno'] ?>" />
      	<button class="btn btn-default" type="button" data-toggle="modal" data-id="<?php echo $row['tableno'] ?>" data-target="#ModalCenter" onclick="orderSeen(<?php echo $row['tableno']; ?>)">
      		View
      	</button>
      </td>
    </tr>
    <?php
      endwhile;
    ?>
    </tbody>
  </table>
  <script>
    function orderSeen(tno){
      setOrderAsSeen(tno);
    }

    function setOrderAsSeen(tno){

      let requestData = {
        "data":{
          "id":tno,
        },
        "url":"../api/orders/setOrderAsSeen.php",
        "method":"post"
      };

      sendAjaxRequest(requestData);

    }


  </script>
</div>

<?php
  // include '../include/footer.php';
 ?>