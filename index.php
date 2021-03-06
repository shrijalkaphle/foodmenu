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
					
					actionsWhenAProductIsAddedToCart(tableNo,productId);

				},
				error: function(jqXHR, textStatus, errorThrown) {

					console.log(textStatus, errorThrown);

				}
			});
			
		}

		function actionsWhenAProductIsAddedToCart(tableNo,productId){
			loadCart(tableNo);
					
			//toggle tick
			addTick(productId);
			
			//Set bottom Modifier Number to 0
			setBottomQuantityModifierNumberAsOne(productId);
			
			//Activate Buttons
			activateBottomQuantityModifierButtons(productId);
		}

		function modifyQuantity(action,id){

			let qty = getProductQuantity(id);
			
			let datas = {
				"id":id,
			}; 

			let price = document.querySelector(".product-row-"+id).querySelector(".product-price").innerHTML;



			let updatedPrce;

			if(action=="substract"){	

				qty--;

				updatedPrice = price * qty;

				datas.qty = qty;

			}else{

				qty++;

				updatedPrice = parseInt(price) * parseInt(qty);

				datas.qty = qty;

			}

			document.querySelector(".product-row-"+id).querySelector(".product-subtotal-price").innerHTML = "Rs. " + updatedPrice;
			let qtyString = " " + qty + " ";
			getProductQuantityDiv(id).innerHTML = qtyString;
			
			
			datas = JSON.stringify(datas);
			console.log("From modify quantity");
			console.log(datas);

			$.ajax({
					url: "<?php echo ROOT ?>/api/products/modifyQuantityById.php",
					type: "post",
					data: datas,
				success: function (response) {
					console.log(response);
					updateTotalPrice();
					
					//This updates bottom quantity modifier number and buttons
					setInitialBottomModifierQuantityAndEnableButton();
					
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});


		}

		function getProductQuantity(id){
			return parseInt(getProductQuantityDiv(id).innerHTML);
		}

		function getProductQuantityDiv(id){
			return document.querySelector(".product-qty-"+id);
		}

		

		function updateTotalPrice(){

			let tbody = document.querySelector(".cart-body");
			let totalPrice = 0;

			let productRows = tbody.querySelectorAll(".product-row");

			Array.from(productRows).forEach(function(productRow){

				totalPrice += parseInt(productRow.querySelector(".product-subtotal-price").innerHTML.split(" ")[1]);
		
			})

			console.log(totalPrice);

			document.querySelector(".total-cart-price").getElementsByTagName("h4")[0].innerHTML = "Rs. " + totalPrice;



		}

		function loadCart(tableNo){

			let requestData = {
				"tableNo" : tableNo
			};

			requestData = JSON.stringify(requestData);

			$.ajax({
					url: "<?php echo ROOT ?>/api/cart/getCartData.php",
					type: "post",
					data: requestData,
				success: function (response) {
					setDataToCartModal(response,tableNo);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});

		}

		function addTick(id){
			let foodDivSelector = ".single-food-"+id;
			let foodDiv = document.querySelector(foodDivSelector);
			foodDiv.querySelector(".tick-image").style.visibility = "visible";
		}

		function removeTick(id){
			let foodDivSelector = ".single-food-"+id;
			let foodDiv = document.querySelector(foodDivSelector);
			foodDiv.querySelector(".tick-image").style.visibility = "hidden";
		}

		function setInitalTicks(tableNo){

			let requestData = {
				"tableNo" : tableNo
			};

			requestData = JSON.stringify(requestData);

			$.ajax({
					url: "<?php echo ROOT ?>/api/cart/getCartData.php",
					type: "post",
					data: requestData,
				success: function (response) {

					response.forEach(function(dataItem){

						addTick(dataItem.productId);


					})
				
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});

		}

		function setDataToCartModal(data,tableNo){

			let tbody = document.querySelector(".cart-body")

			/* 
				1. Add a TR
				2. Add Price
				3. Add Quantity and + -
 				4. Add Subtotal 
				5. Add delete
				6. End TR

			*/

			let totalPrice = 0;

			while(tbody.hasChildNodes())
			{
				tbody.removeChild(tbody.firstChild);
			}

			if(Object.keys(data).length+1 != tbody.rows.length){

				data.forEach(function(dataItem){

					let newRow = tbody.insertRow(tbody.rows.length);
					newRow.className = "product-row product-row-"+dataItem.cartId;

					let firstCell = newRow.insertCell(0);
					let secondCell = newRow.insertCell(1);
					let thirdCell = newRow.insertCell(2);
					let fourthCell = newRow.insertCell(3);
					let fifthCell = newRow.insertCell(4);

					let nameText = document.createTextNode(dataItem.name);
					let priceText = document.createTextNode(dataItem.price);
					
					
					/*======= Name Cell =======*/
					firstCell.appendChild(nameText);
					firstCell.className = "product-name";

					/*======= Price Cell =======*/
					secondCell.appendChild(priceText);
					secondCell.className = "product-price";
					

					/*======= Quantity Cell =======*/
					//Minus Button
					let minusButton = document.createElement("button");
					minusButton.className = "btn btn-default";
					minusButton.setAttribute("onclick","modifyQuantity('substract',"+dataItem.cartId+")");

					let minusIconSpan = document.createElement("span");
					minusIconSpan.className = "glyphicon glyphicon-minus";
					minusIconSpan.setAttribute("aria-hidden","true");

					minusButton.appendChild(minusIconSpan);

					//Product Price Span
					let productQtySpan = document.createElement("span");
					productQtySpan.className="product-qty-"+dataItem.cartId;
					productQtySpan.innerHTML = " " + dataItem.quantity + " ";

					//Plus Button
					let plusButton = document.createElement("button");
					plusButton.className = "btn btn-default";
					plusButton.setAttribute("onclick","modifyQuantity('add',"+dataItem.cartId+")");

					let plusIconSpan = document.createElement("span");
					plusIconSpan.className = "glyphicon glyphicon-plus";
					plusIconSpan.setAttribute("aria-hidden","true");

					plusButton.appendChild(plusIconSpan);

					let quantityDiv = document.createElement("div");
					quantityDiv.className = "quantity-div";
					quantityDiv.appendChild(minusButton);
					quantityDiv.appendChild(productQtySpan);
					quantityDiv.appendChild(plusButton);

					thirdCell.appendChild(quantityDiv);

					/*======= SubTotal Cell =======*/
					let price = parseInt(dataItem.quantity) * parseInt(dataItem.price);
					let subTotalText = document.createTextNode("Rs. "+price);
					totalPrice += price;

					fourthCell.className = "product-subtotal-price";					
					fourthCell.appendChild(subTotalText);


					/*======= Delete Cell =======*/
					//Delete Link
					let deleteLink = document.createElement("a");
					deleteLink.setAttribute('onclick','deleteCartEntry('+dataItem.cartId+','+tableNo+')');
					
					//Trash Button
					let trashButton = document.createElement("button");
					trashButton.className = "btn btn-default";

					//Span
					let trashIconSpan = document.createElement("span");
					trashIconSpan.className = "glyphicon glyphicon-trash";
					trashIconSpan.setAttribute("aria-hidden","true");

					trashButton.appendChild(trashIconSpan);
					deleteLink.appendChild(trashButton);
					
					fifthCell.appendChild(deleteLink);

				
					
				});


				/*====== Total =====*/

				//First Cell

				let newRow = tbody.insertRow(tbody.rows.length);


				let totalTextTD = document.createElement("td");
				totalTextTD.colSpan = 3;
				
				let h4 = document.createElement("h4");
				h4.setAttribute("style","float: right");
				
				let textNode = document.createTextNode("Total: ");
				h4.appendChild(textNode);

				totalTextTD.appendChild(h4);

				newRow.appendChild(totalTextTD);

				//Second Cell

				let secondCell = newRow.insertCell(1);

				let priceTD = document.createElement("td");
				priceTD.className = "total-cart-price";
				
				let priceh4 = document.createElement("h4");
				
				let priceTextNode = document.createTextNode("Rs. "+totalPrice);
				priceh4.appendChild(priceTextNode);

				priceTD.appendChild(priceh4);

				newRow.appendChild(priceTD);


			}



		}

		function deleteCartEntry(id,tableNo){

			let requestData = {
				"id" : id
			};

			requestData = JSON.stringify(requestData);

			$.ajax({
					url: "<?php echo ROOT ?>/api/cart/removeProductFromCartByProductId.php",
					type: "post",
					data: requestData,
				success: function (response) {
					loadCart(tableNo);
				},
				error: function(jqXHR, textStatus, errorThrown) {
					console.log(textStatus, errorThrown);
				}
			});


		}

		function dynamicSearch(){

			const searchBar = document.querySelector(".search-text-field");

			searchBar.addEventListener('keyup',function(e){

				const term = e.target.value.toLowerCase();

				const foods = document.querySelectorAll(".single-food-div");

				Array.from(foods).forEach(function(food){

					const title = food.querySelector(".food-name").innerHTML;
					if(title.toLowerCase().indexOf(term)!= -1){
						food.style.display = 'block';
					}else{
						food.style.display = 'none';
					}
		
				})

			});


		}

		function funOrder() {
			document.getElementById('menu').scrollIntoView();
		}

		function updateBottomQuantityCounter(productId,qty){
			let selector = ".bottom-quantity-modifier-div-of-"+productId;
			document.querySelector(selector).querySelector(".bottom-quantity-number").innerHTML = qty;
		}

		
	</script>

<?php
	if ($_SESSION['table'] != 0) {
		$tno = $_SESSION['table'];
?>
<body onload="funOrder()">
<div style="background-image: url('images/background-header.jpg'); margin-top: 0px;">
	<br>
	<div class="container">
		<br>
		<h1 class="text-center"><img class="foodmenu-img" src="images/food-menu.png"></h1>
	</div>
</div>
<br><br>

<div class="container">
	<div class="row">
		<div class="col-md-6">
			<div class="row form-group buttons-div"  id="menu">
				<div class="col-md-4">
					<a href="#"><button class="btn btn-primary showcart-button" type="button" onclick="loadCart(<?php echo $tno ?>)" data-toggle="modal" data-target="#ModalCenter" style="background-color: #2A877E;" >
						<span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span>  View Cart
					</button></a>	
				</div>
				<div class="col-md-4">
					<a href="viewOrder.php?tabno=<?php echo($tno) ?>"><button class="btn btn-primary" style="background-color: #2A877E; ">View all Order</button></a>	
				</div>
				<div class="col-md-4">	
					<a href="logout.php"><button class="btn btn-primary" style="background-color: #2A877E;">Back to Table Selection</button></a>
				</div>
			</div>
		</div>

		<div class="col-md-6">
			<div>
				<form class="form-inline" method="post">
					<input type="text" class="form-control search-text-field" placeholder="Search" name="name">
				</form>
			</div>
		</div>
		
	</div>
</div>

<!-- <div>
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
<div> -->
<div class="container">
	<h3>Click to add order</h3>
</div>
	<div class="container">
	<div class="row foods">
	<?php
		while ($row = mysqli_fetch_assoc($result1)):
	?>
			<div class="col-md-4 single-food-div col-sm-6">
				<div class="single-food single-food-<?php echo $row['id']; ?>">
					
					<div class="food-img">
						<img src="images/<?php echo $row['image'];?>" class="img-fluid food-image" alt>
						<img class="tick-image" src="images/tick.png">
					</div>
				
					<div class="food-content">
						<div class="d-flex justify-content-between">
							<h3 class="food-menu">
								<span class="food-name"><?php echo $row['name']; ?></span>
								<span class="style-change">Rs. <?php echo $row['price']; ?></span>
							</h3>
						</div>
					</div>
					<div class="middle">
							<input type="text" name="id" id="fid" value="<?php echo $row['id']; ?>" hidden>
    						<div class="text">
    							<input type="submit" name="add" class="btn btn-default" value="Add Order" onclick="addProductToCart(<?php echo $_SESSION['table'] ?>,<?php echo $row['id']; ?>,1)" data-toggle="modal" data-target="#ModalCenter">
    						</div>
					  </div>
					
				</div>

				<div class="bottom-quantity-modifier-div bottom-quantity-modifier-div-of-<?php echo $row['id']; ?>">
						<button href="#" class="btn btn-danger btn-lg bottom-decrease-product-quantity" disabled onclick="decreaseBottomQuantityModifierNumber(<?php echo $row['id']; ?>)">
							<span class="glyphicon glyphicon-minus"></span>  
						</button>

						<div class="bottom-quantity-number">
							-
						</div>
			
						<button href="#" class="btn btn-info btn-lg bottom-increase-product-quantity"  disabled onclick="increaseBottomQuantityModifierNumber(<?php echo $row['id']; ?>)">
							<span class="glyphicon glyphicon-plus"></span>  
						</button>
						
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
        	<tbody class="cart-body">
				
			</tbody>
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
        	window.location = 'placeOrder.php?tno=<?php echo($tno) ?>';
    	}
	}

	
	window.onload = function(){
			//Set Product Ticks
			setInitalTicks(7);
			dynamicSearch();
			setInitialBottomModifierQuantityAndEnableButton();
		}
</script>

<script>
	// Bottom Quantity Modifier Functions
	function increaseBottomQuantityModifierNumber(id){
		let quantity = getBottomQuantityModifierNumber(id);
		quantity++;
		setBottomQuantityModifierNumber(quantity,id);
		
		//Update quantity in DB
		modifyDbProductQuantity(id,quantity);
	}

	function decreaseBottomQuantityModifierNumber(id){
		let quantity = getBottomQuantityModifierNumber(id);
		if(checkIfBottomQuantityModifierNumberIsOne(id)){
			actionsWhenBottomQuantityModifierNumberIsOne(id)	
		}else{
			quantity--;
			setBottomQuantityModifierNumber(quantity,id);
			
			//Update quantity in DB
			modifyDbProductQuantity(id,quantity);
		}
		
	}

	function actionsWhenBottomQuantityModifierNumberIsOne(id){
		if(getConfirmationForDeletingProductFromCart(id)){
			deactivateBottomQuantityModifierButtons(id);
			setBottomQuantityModifierNumberAsHyphen(id);
			deleteProductFromCartByProductId(id);
			removeTick(id);
		}else{
			setBottomQuantityModifierNumberAsOne(id);
		}
	}

	function deleteProductFromCartByProductId(id){
		modifyDbProductQuantity(id,0);
	}
	
	function getBottomQuantityModifierNumber(id){
		let quantity = parseInt(getBottomQuantityModifierDivDOM(id).querySelector(".bottom-quantity-number").innerHTML);
		return quantity;
	}

	function getConfirmationForDeletingProductFromCart(id){
		return confirm("Do you want to remove this product?");
	}


	function setBottomQuantityModifierNumber(num,id){
		getBottomQuantityModifierDivDOM(id).querySelector(".bottom-quantity-number").innerHTML = num;
	}

	function checkIfBottomQuantityModifierNumberIsOne(id){
		return getBottomQuantityModifierNumber(id)==1 ? true : false;
	}

	function setBottomQuantityModifierNumberAsOne(id){
		setBottomQuantityModifierNumber(1,id);
	}	

	function setBottomQuantityModifierNumberAsHyphen(id){
		setBottomQuantityModifierNumber("-",id);
	}	

	function activateBottomQuantityModifierButtons(id){
		getBottomQuantityModifierDivDOM(id).querySelector(".bottom-increase-product-quantity").disabled = false;
		getBottomQuantityModifierDivDOM(id).querySelector(".bottom-decrease-product-quantity").disabled = false;
	}

	function deactivateBottomQuantityModifierButtons(id){
		getBottomQuantityModifierDivDOM(id).querySelector(".bottom-increase-product-quantity").disabled = true;
		getBottomQuantityModifierDivDOM(id).querySelector(".bottom-decrease-product-quantity").disabled = true;
	}



	function getBottomQuantityModifierDivDOM(id){
		let selector = ".bottom-quantity-modifier-div-of-"+id;
		return document.querySelector(selector);
	}

	function modifyDbProductQuantity(id,quantity){

		let url = "<?php echo ROOT ?>/api/products/modifyQuantityByProductId.php";
		console.log(url);
		let requestData = {
			
			"url":url,
			
			"method":"post",
			
			"data":{
			
				"id":id,
			
				"quantity":quantity
			
			}
		}

		sendAjaxRequest(requestData);
	}


	function setInitialBottomModifierQuantityAndEnableButton(){
		let url = "<?php echo ROOT ?>/api/cart/getCartData.php";
		let requestData = {	
			"url":url,
			"method":"post",
			"data":{
				"tableNo":<?php echo $tno ?>,		
			}
		}
		sendAjaxRequest(requestData,function(data){
			for(let i=0;i<data.length;i++){
				setBottomQuantityModifierNumber(data[i].quantity,data[i].productId);
				activateBottomQuantityModifierButtons(data[i].productId);
			}
		});
	}



</script>
<?php
	include '../include/footer.php';
?>