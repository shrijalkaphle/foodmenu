<?php
	include 'include/header.php';
	//$tno = null;
?>

<?php
	if (isset($_POST['tableno'])) {
		$tab = $_POST['table'];
		$_SESSION['table'] = $tab;
	}
?>

<?php
	if (isset($_POST['catview'])) {
		$catname = $_POST['category'];

		//echo $catname;

		if ($catname == "all") {
			$query1 = "SELECT * FROM product";
			$result1 = mysqli_query($conn,$query1) or die("error");
		 } else {
			$q = "SELECT * FROM category WHERE name = '$catname'";
			$r = mysqli_query($conn,$q);
			$ro = mysqli_fetch_assoc($r);
			$id = $ro['id'];
			$query1 = "SELECT * FROM product where catid = '$id'";
			$result1 = mysqli_query($conn,$query1) or die("error");
		}

	} elseif (isset($_POST['search'])) {
		
		$name = $_POST['name'];
		$query1 = "SELECT * FROM product WHERE name REGEXP '$name'";
		$result1 = mysqli_query($conn,$query1) or die("error");


	} else {
		$query1 = "SELECT * FROM product";
		$result1 = mysqli_query($conn,$query1) or die("error");
	}
?>



<head>
	<title>Food Order System</title>
	<script type="text/javascript">
		function addProductToCart(tableNo,productId,qty){

			let datas = {
				"id":productId,
				"tableNo":tableNo,
				"qty":qty
			};
			datas= JSON.stringify(datas);
			$.ajax({
					url: "addProductToCart.php",
					type: "post",
					data: datas,
				success: function (response) {
					console.log(response);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});

		}

		function modifyQuantity(action,id){
			console.log("Button Clicked");
			let selector = ".product-qty-"+id;
			let qty = parseInt(document.querySelector(selector).innerHTML);
			
			let datas = {
				"action":action,
				"id":id,
			}
			if(action=="substract"){	

				qty--;

				datas.qty = qty;

			}else{

				qty++;

				datas.qty = qty;

			}

			document.querySelector(selector).innerHTML = qty;

			datas = JSON.stringify(datas);

			console.log(datas);

			$.ajax({
					url: "modifyQty.php",
					type: "post",
					data: datas,
				success: function (response) {
					console.log(response);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});


		}

		function funOrder() {
			document.getElementById('menu').scrollIntoView();
		}
	</script>
</head>

<?php
	if ($_SESSION['table'] != 0) {
		$tno = $_SESSION['table'];
?>
<body onload="funOrder()">
<div style="background-image: url('images/background-header.jpg'); margin-top: 0px;">
	<br>
	<div class="container">
		<br>
		<h1 class="text-center"><img src="images/food-menu.png"></h1>
	</div>
</div>
<br><br>
<div class="form-group" style="float: right" id="menu">
	<a href="#"><button class="btn btn-primary" type="button" data-toggle="modal" data-target="#ModalCenter" style="background-color: #2A877E; width: 200px;" >
		<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span> | View Cart
	</button></a>	|
	<a href="view.php?tabno=<?php echo($tno) ?>"><button class="btn btn-primary" style="background-color: #2A877E; width: 200px;">View all Order</button></a>	|
	<a href="session_table.php"><button class="btn btn-primary" style="background-color: #2A877E; width: 200px;">Back to Table Selection</button></a>
</div>

<div class="container">
	<form class="form-inline" method="post">
		<input type="text" class="form-control" placeholder="Search" style="width: 200px" name="name">&nbsp;
		<input type="submit" name="search" class="btn btn-primary" style="background-color: #2A877E" value="Search">
	</form>
</div>

<div>
	<br><br>
	<div class="container">
		<div class="nav nav-tabs">
		<b>Select Category : </b>
		<form method="post" style="display: inline-block;">
			<input type="text" name="category" value="all" hidden>
			<input type="submit" name="catview" value="All" class="btn btn-primary" style="border:none; background-color:transparent; color:black;">
		</form>
		<?php
			$_SESSION['visit'] = 0;
			$query = "SELECT * FROM category";
			$result = mysqli_query($conn,$query) or die("error");
			while ($row = mysqli_fetch_assoc($result)):
		?>
				<form method="post" style="display: inline-block;">
					<input type="text" name="category" value="<?php echo $row['name']; ?>" hidden>
					<input type="submit" name="catview" value="<?php echo $row['name']; ?>" class="btn btn-primary" style="border:none; background-color:transparent; color:black;">
				</form>
		<?php
			endwhile;
		?>
	</div>
	</div>
</div>
<br><br>
<div>
	<div class="container">
	<div class="row">
	<?php
		while ($row = mysqli_fetch_assoc($result1)):
	?>
			<div class="col-md-4 col-sm-6">
				<div class="single-food">
					<div class="food-img">
						<img src="images/<?php echo $row['image'];?>" class="img-fluid" alt>
					</div>
					<div class="food-content">
						<div class="d-flex justify-content-between">
							<h3>
								<?php echo $row['name']; ?>
								<span class="style-change">Rs. <?php echo $row['price']; ?></span>
							</h3>
						</div>
					</div>
					<div class="middle">
							<input type="text" name="id" id="fid" value="<?php echo $row['id']; ?>" hidden>
    						<div class="text">
    							<input type="submit" name="add" class="btn btn-default" value="Add Order" onclick="addProductToCart(<?php echo $_SESSION['table'] ?>,<?php echo $row['id']; ?>,1)" >
    						</div>
  					</div>
				</div>
			</div>
	<?php
		endwhile;
	?>
	</div>
</div>
</div>
<br>
<hr>
</body>
<?php
	$_SESSION['visit'] = 1;
	} else {
?>
<br><br>
<div class="container">
	<div class="well">
		<form method="post">
			<div class="form-group">
				<label>Table Number : </label>
				<select class="form-control" name="table">
					<option value="0">Select table number</option>
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
			<input type="submit" name="tableno" style="float: right; background-color: #2A877E;" value="Continue" class="btn btn-primary">
			<br>
		</form>
	</div>
</div>
<?php
	}
?>

<style type="text/css">
	.navbar {
		 margin-bottom: 0;
	}
</style>

<!-- Modal -->
<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Your Order</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped">
        	<thead>
        		<td>Name</td>
        		<td>Price</td>
        		<td>Quantity</td>
        		<td>Subtotal</td>
        		<td></td>
        	</thead>
        	<?php
        		$total = null;
        		$query = "SELECT * FROM cart WHERE tableno = '$tno'";
        		$result = mysqli_query($conn,$query);
        		while ($row=mysqli_fetch_assoc($result)) :
        			$id = $row['productid'];
        			$query1 = "SELECT * FROM product WHERE id = '$id'";
        			$result1 = mysqli_query($conn,$query1);
        			$row1=mysqli_fetch_assoc($result1);
        	?>
        	<tr>
        				<td><?php echo $row1['name']; ?></td>
        				<td><?php echo $row1['price']; ?></td>
        				<td>
        					<?php $qty =  $row['qty']; ?>
        					<button class="btn btn-default" onclick="modifyQuantity('substract',<?php echo $row['id'] ?>)">
								<span class="glyphicon glyphicon-minus"  aria-hidden="true"></span>
							</button>
							<span class="product-qty-<?php echo $row['id'] ?>"><?php echo $qty ?></span>
							<button class="btn btn-default" onclick="modifyQuantity('add',<?php echo $row['id'] ?>)">
								<span class="glyphicon glyphicon-plus"  aria-hidden="true"></span>
							</button>
        					</td>
        				<td>Rs.
        					<?php
        						$stotal = $row1['price'] * $row['qty'];
        						$total = $total + $stotal;
        						echo $stotal;
        					?>
        				</td>
        				<td>
        					<a href="delete.php?id=<?php echo $row['id']?>">
        						<button class="btn btn-default">
									<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
								</button>
							</a>
        				</td>
        	</tr>
        	<?php
        		endwhile; 
        	?>
        	<tr>
        		<td colspan="3"><h4 style="float: right">Total : </h4></td>
        		<td><h4>Rs. <?php echo $total; ?></h4></td>
        	</tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Add More Order</button>
        <button type="button" onclick="ask()" class="btn" style="background-color: red; color: white">Confirm Order</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
	function ask() {
		var ask = window.confirm("Confirm Order?");
    	if (ask) {
        	window.location = 'order.php?tno=<?php echo($tno) ?>';
    	}
	}
</script>