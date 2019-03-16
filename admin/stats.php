<?php
    include '../include/header.php';
    include '../include/dbconnect.php';
?>

<head>
  <title>Food Order System | Stats</title>
</head>
<div class="container">
    <div class="row">
        <h3>Total Sales:</h3>
            <div class="col-md-6">
                <div class="total-sales-table-div">
                    <table class="total-sales-table table table-striped">
                        <thead>
                        <td>Date and Time</td>
                        <td>Name</td>
                        <td>Price</td>
                        <td>Quantity</td>
                        <td>Subtotal</td>
                        </thead>
                        <?php
                            $total = null;	
                            $query = "SELECT * FROM sales";
                            $result = mysqli_query($conn,$query);
                            while ($row = mysqli_fetch_assoc($result)) :
                                $id = $row['productid'];
                                $q = "SELECT * FROM product where id = '$id'";
                                $r = mysqli_query($conn,$q);
                                $row1 = mysqli_fetch_assoc($r);
                        ?>
                        <tr>
                        <td>
                            <?php echo $row['datetime']; ?>
                        </td>
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
                        <td colspan="4" class="text-right"><b>Total : </b></td>
                        <td>Rs. <?php echo $total; ?></td>
                        </tr>
                    </table>
                    <?php mysqli_close($conn); ?>
                </div>
            </div>
            <div class="col-md-6">
                <canvas id="line-chart" width="800" height="450"></canvas>

            </div>
    </div>

    </div>
</div>
<script>
    new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: ["Jan","Feb","Mar","April","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],
    datasets: [{ 
        data: [2500,30000,9860,8000,7654,9850,1234,9764,5600,7893,3500,6500],
        label: "Total Sales(Rs.)",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'Sales(per month)'
    }
  }
});
</script>
