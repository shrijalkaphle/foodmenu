<?php
	include 'include/header.php';

	$tno = $_GET['tabno'];
	//echo $tno;
	$total = null;

	$query = "SELECT * FROM ordered WHERE tableno='$tno'";
	$result = mysqli_query($conn,$query);
	
?>

<head>
	<title>Food Order System | View Order</title>
</head>

<div class="container">
	<table class="table table-striped">
    <thead>
      <td>Name</td>
      <td>Price</td>
      <td>Quantity</td>
      <td>Subtotal</td>
    </thead>
    <?php
      $stotal = null;
      while ($row = mysqli_fetch_assoc($result)) :
        $id = $row['productid'];
        $q = "SELECT * FROM product where id = '$id'";
        $r = mysqli_query($conn,$q);
        $row1 = mysqli_fetch_assoc($r);
    ?>
    <tr>
      <td>
        <?php echo $row1['name']; ?>
      </td>
      <td>
        <?php echo $row1['price']; ?>
      </td>
      <td><?php echo $row['qty']; ?></td>
      <td>
          <?php
            $stotal = $row['qty'] * $row1['price'];
            echo "Rs. ";
            $total = $total + $stotal;
            echo $stotal;
          ?>
      </td>
    </tr>
    <?php
      endwhile;
    ?>
    <tr>
      <td colspan="3" class="text-right"><b>Total : </b></td>
      <td>Rs. <?php echo $total; ?></td>
    </tr>
  </table>
</div>