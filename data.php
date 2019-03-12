<?php
  include 'include/dbconnect.php';
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
    <tr>
      <td><?php echo $row['tableno']; ?></td>
      <td><?php echo $row['price']; ?></td>
      <td>
      	<input type="hidden" name="user_id" value="<?php echo $row['tableno'] ?>" />
      	<button class="btn btn-default" type="button" data-toggle="modal" data-id="<?php echo $row['tableno'] ?>" data-target="#ModalCenter">
      		View
      	</button>
      </td>
    </tr>
    <?php
      endwhile;
    ?>
    </tbody>
  </table>
</div>
