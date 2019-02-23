<?php
    include 'include/header.php';
?>

<?php
    if (isset($_POST['add'])) {
        $name = $_POST['name'];

        $query = "INSERT INTO category(name) VALUES ('$name')";
        $result = mysqli_query($conn,$query) or die("db error");
        echo "<script>alert('sucess')</script>";
        echo "<script>window.location = 'admin_index.php'</script>";
    }
?>


<head>
    <title>Food Order System | Add Category</title>
</head>
<div class="container inner-wrapper">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
      <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1">
  </div>
  <input type="submit" name="add" value="Add" class="btn btn-default">
</form>
    </div>
  </div>
</div>
</div>