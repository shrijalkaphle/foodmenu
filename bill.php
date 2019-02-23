<?php
  include 'include/header.php';

  if(!isset($_SESSION['role'])) {
      $msg = "Cannot view This page! Login to Continue!";
      echo "<script>window.location.replace('login.php?msg=$msg');</script>";
  }
?>

<?php
  if (isset($_POST['view'])) {
    $table = $_POST['table'];
    $query = "SELECT * FROM history WHERE tableno = '$table'";
    $result = mysqli_query($conn,$query);
  }
?>


<head>
  <title>Food Order System | Bill</title>
</head>

<div class="container">
  <form method="post">
    <div class="form-group">
    <label for="exampleInputEmail1">Select Table : </label>
    <select name="table">
      <option>...</option>
      <option value="1">1</option>
      <option value="2">2</option>
      <option value="3">3</option>
      <option value="4">4</option>
      <option value="5">5</option>
      <option value="6">6</option>
      <option value="7">7</option>
      <option value="8">8</option>
      <option value="9">9</option>
    </select>
  </div>
  <input type="submit" name="view" value="View" class="btn btn-default">
  </form>

  <table class="table table-striped">
    <thead>
      <td>Name</td>
      <td>Price</td>
      <td>Quantity</td>
      <td>Subtotal</td>
    </thead>
    <?php
      $total = null;
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

  <?php
    if ($table) {
  ?>
    <a href="paid.php?no=<?php echo($table) ?>"><button class="btn btn-default" style="float: right">Paid</button></a>
  <?php
    }
  ?>
</div>

<style type="text/css">
  select {
    width: 30%;
    padding: 16px 20px;
    border: none;
    border-radius: 4px;
    background-color: #f1f1f1;
  }
</style>