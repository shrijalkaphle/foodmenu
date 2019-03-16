<?php
	include 'include/header.php';
	$msg = $_GET['msg'];
	if (isset($_POST['login'])) {
		$username = $_POST['username'];
		$pwd = $_POST['pwd'];

		//check user

		$query = "SELECT * FROM user WHERE username = '$username' AND password = '$pwd'";
		$result = mysqli_query($conn,$query);

		$row = mysqli_fetch_assoc($result);
		$num = mysqli_num_rows($result);

		if ($num == 0) {
			$msg = "Username not Registered!!";
		} else {
			$_SESSION['role'] = $row['role'];
			if ($_SESSION['role'] == "admin") {
				echo "<script>window.location = 'admin/admin_index.php'</script>";
			} elseif ($_SESSION['role'] == "staff") {
				echo "<script>window.location = 'staff/staff_index.php'</script>";
			}
		}
	}

?>

<head>
	<title>Food Order System | Login Page</title>
	<style type="text/css">
		.center_div{
    		margin: 0 auto;
    		width:80% /* value of your choice which suits your alignment */
		}
	</style>
</head>

<?php 
	if ($msg != null) {
?>
		<div class="alert alert-danger" role="alert">
			<?php echo $msg; ?>
		</div>
<?php
	}
?>

<div class="container center_div">
	<div class="well">
		<form method="post">
  			<div class="form-group">
    			<label for="email">Username:</label>
    			<input type="text" class="form-control" name="username">
  			</div>
  			<div class="form-group">
    			<label for="pwd">Password:</label>
    			<input type="password" class="form-control" name="pwd">
  			</div>
  			<input type="submit" name="login" value="Login" class="btn btn-default">
		</form>
	</div>
</div>