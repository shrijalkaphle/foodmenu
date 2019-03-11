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
                <div>
                    <table class="table table-striped">
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
    labels: [1500,1600,1700,1750,1800,1850,1900,1950,1999,2050],
    datasets: [{ 
        data: [86,114,106,106,107,111,133,221,783,2478],
        label: "Africa",
        borderColor: "#3e95cd",
        fill: false
      }, { 
        data: [282,350,411,502,635,809,947,1402,3700,5267],
        label: "Asia",
        borderColor: "#8e5ea2",
        fill: false
      }, { 
        data: [168,170,178,190,203,276,408,547,675,734],
        label: "Europe",
        borderColor: "#3cba9f",
        fill: false
      }, { 
        data: [40,20,10,16,24,38,74,167,508,784],
        label: "Latin America",
        borderColor: "#e8c3b9",
        fill: false
      }, { 
        data: [6,3,2,2,7,26,82,172,312,433],
        label: "North America",
        borderColor: "#c45850",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'World population per region (in millions)'
    }
  }
});
</script>
