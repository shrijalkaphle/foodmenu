<?php
    include 'include/header.php';

    $id = $_GET['id'];

    $query = "SELECT * from category where id = '$id'";
    $result = mysqli_query($conn,$query) or die("db error");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
?>

<?php
	if (isset($_POST['edit'])) {
		$name = $_POST['name'];

		$query2 = "UPDATE category SET name = '$name' WHERE id = '$id'";
		$result2 = mysqli_query($conn,$query2) or die("db error");
		echo "<script>alert('sucess')</script>";
		echo "<script>window.location = 'admin_index.php'</script>";
	}
?>


<head>
    <title>Food Order System | Edit Category</title>
</head>
<div class="container inner-wrapper">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
      <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Category Name</label>
    <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="<?php echo $row['name']; ?>">
  </div>
  <input type="submit" name="edit" value="Edit" class="btn btn-default">
</form>
    </div>
  </div>
</div>
</div>