<?php
	include 'include/dbconnect.php';
	if($_POST['rowid']) {
    	$tid = $_POST['rowid']; //escape string

?>

<div class="modal-header">
    <h4 class="modal-title" id="exampleModalLongTitle">Details</h4>
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
        </thead>
    <?php
    	$total = null;
        $query = "SELECT * FROM ordered WHERE tableno = '$tid'";
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
        	<td><?php echo $row['qty']; ?></td>
        	<td>Rs.
        		<?php
        			$stotal = $row1['price'] * $row['qty'];
        			$total = $total + $stotal;
        			echo $stotal;
        		?>
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
    <a href="paid.php?tid=<?php echo($tid) ?>"><button type="button" class="btn btn-primary">Paid</button></a>	
</div>

<?php
 	}
?>