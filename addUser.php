<?php
    include 'include/header.php';
?>

<?php
    if (isset($_POST['add'])) {
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $uname = $_POST['username'];
        $pwd = $_POST['pwd'];
        $phone = $_POST['phone'];
        $dob = date('Y-m-d', strtotime($_POST['dob']));
        $role = $_POST['role'];

        $query = "INSERT INTO user(fname,lname,username,password,phone,dob,role) VALUES ('$fname','$lname','$uname','$pwd','$phone','$dob','$role')";
        $result = mysqli_query($conn,$query) or die("db error");
        echo "<script>alert('sucess')</script>";
        echo "<script>window.location = 'admin_index.php'</script>";
    }
?>


<head>
    <title>Food Order System | Add User</title>
</head>
<div class="container inner-wrapper">
  <div class="row">
    <div class="col-sm-4 col-sm-offset-4">
      <form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">First Name</label>
    <input type="text" class="form-control" name="fname" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Last Name</label>
    <input type="text" class="form-control" name="lname" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Username</label>
    <input type="text" class="form-control" name="username" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Password</label>
    <input type="text" class="form-control" name="pwd" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="number" class="form-control" name="phone" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Date Of Birth</label>
    <input type="date" class="form-control" name="dob" id="exampleInputEmail1">
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Role</label>
    <select class="form-control" name="role" id="exampleInputEmail1">
      <option value="admin">Admin</option>
      <option value="staff">Staff</option>
    </select>
  </div>
  <input type="submit" name="add" value="Add" class="btn btn-default">
</form>
    </div>
  </div>
</div>
</div>