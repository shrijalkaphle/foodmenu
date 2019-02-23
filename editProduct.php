<?php
    include 'include/header.php';

    $id = $_GET['id'];

    $query = "SELECT * from product where id = '$id'";
    $result = mysqli_query($conn,$query) or die("db error");
    $row = mysqli_fetch_assoc($result);
    $name = $row['name'];
?>

<?php
    if (isset($_POST['edit'])) {

        $target = "images/".basename($_FILES['image']['name']);

        $name = $_POST['name'];
        $cat = $_POST['cat'];
        $price = $_POST['price'];
        $image = $_FILES['image']['name'];

        if ($cat != 0) {
            if ($image == null) {
                $query2 = "UPDATE product SET name = '$name', catid = '$cat', price = '$price' WHERE id = '$id'";
                $result2 = mysqli_query($conn,$query2) or die("db error");
                echo "<script>alert('sucess')</script>";
                echo "<script>window.location = 'admin_index.php'</script>";
            } else {
                $query2 = "UPDATE product SET name = '$name', catid = '$cat', price = '$price', image = '$image' WHERE id = '$id'";
                $result2 = mysqli_query($conn,$query2) or die("db error");
                if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
                    echo "<script>alert('sucess')</script>";
                    echo "<script>window.location = 'admin_index.php'</script>";
                } else {
                    echo "<script>alert('There is an error')</script>";
                }
            }
        } else {
            echo "<script>alert('Select category');</script>";
        }
    }
?>


<head>
    <title>Food Order System | Edit Product</title>
</head>
<div class="container inner-wrapper">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="exampleInputEmail1">Product Name</label>
                <input type="text" class="form-control" name="name" id="exampleInputEmail1" value="<?php echo $row['name']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Category</label>
                <select name="cat" class="form-control">
                    <option value="0">Select One...</option>
                    <?php
                        $q = "SELECT * from category";
                        $r = mysqli_query($conn,$q) or die("db error");
                        while ($d = mysqli_fetch_assoc($r)) :
                    ?>
                            <option value="<?php echo $d['id']; ?>"><?php echo $d['name']; ?></option>
                    <?php
                        endwhile;
                    ?>
                    
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Price</label>
                <input type="text" class="form-control" name="price" id="exampleInputEmail1" value="<?php echo $row['price']; ?>">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Image</label>
                <input type="file" class="form-control" name="image" id="exampleInputEmail1">
            </div>
            <input type="submit" name="edit" value="Edit" class="btn btn-default">
        </form>
    </div>
  </div>
</div>
</div>