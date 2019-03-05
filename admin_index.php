<?php
	include 'include/header.php';

    if(!isset($_SESSION['role'])) {
        $msg = "Cannot view This page! Login to Continue!";
        echo "<script>window.location.replace('login.php?msg=$msg');</script>";
    } 

?>
<head>
	<title>Food Order System | Admin Page</title>
</head>
<div class="container">
    <button class="accordion">Category <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> </button>
    <div class="panel">
        <br>
        <a href="addCategory.php" style="float: right"><button class="btn btn-default">Add Category</button></a>
        <h2>Category List</h2>
        <table class="table table-striped">
            <thead>
                <th>id</th>
                <th>Name</th>
                <th></th>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM category";
                $result = mysqli_query($conn,$query);
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                    <tr>
                        <td><?php echo stripslashes($row["id"]); ?></td>
                        <td><?php echo stripslashes($row["name"]); ?></td>
                        <td>
                            <a href="editCategory.php?id=<?php echo $row["id"]?>">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>	|
                            <a href="deleteCategory.php?id=<?php echo $row["id"]?>">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
            <?php
                endwhile;
            ?>
            </tbody>
        </table>
    </div>

    <br>
    <hr>
    <br>

    <button class="accordion">Product <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> </button>
    <div class="panel">
        <br>
        <a href="addProduct.php" style="float: right"><button class="btn btn-default">Add Product</button></a>
        <h2>Product List</h2>
        <table class="table table-striped">
            <thead>
                <th>Category</th>
                <th>Name</th>
                <th>Price</th>
                <th>Picture</th>
                <th></th>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM product";
                $result = mysqli_query($conn,$query);
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                    <tr>
                        <td><?php echo stripslashes($row["catid"]); ?></td>
                        <td><?php echo stripslashes($row["name"]); ?></td>
                        <td><?php echo stripslashes($row["price"]); ?></td>
                        <td><img src="images/<?php echo stripslashes($row["image"]); ?>" height="150px"></td>
                        <td>
                            <a href="editProduct.php?id=<?php echo $row["id"]?>">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>	|
                            <a href="deleteProduct.php?id=<?php echo $row["id"]?>">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
            <?php
                endwhile;
            ?>
            </tbody>
        </table>
    </div>

    <br>
    <hr>
    <br>

    <button class="accordion">Users <span class="glyphicon glyphicon-chevron-down" aria-hidden="true"></span> </button>
    <div class="panel">
        <br>
        <a href="addUser.php" style="float: right"><button class="btn btn-default">Add User</button></a>
        <h2>User List</h2>
        <table class="table table-striped">
            <thead>
                <th>Full Name</th>
                <th>Username</th>
                <th>Phone</th>
                <th>Date of Birth</th>
                <th>Role</th>
                <th></th>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM user";
                $result = mysqli_query($conn,$query);
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                    <tr>
                        <td><?php echo stripslashes($row["fname"]); ?> <?php echo stripslashes($row["lname"]); ?></td>
                        <td><?php echo stripslashes($row["username"]); ?></td>
                        <td><?php echo stripslashes($row["phone"]); ?></td>
                        <td><?php echo stripslashes($row["dob"]); ?></td>
                        <td><?php echo stripslashes($row["role"]); ?></td>
                        <td>
                            <a href="deleteUser.php?id=<?php echo $row["id"]?>">
                                <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
            <?php
                endwhile;
            ?>
            </tbody>
        </table>
    </div>
</div>

<style type="text/css">
	button.accordion {
        background-color: #eee;
        color: #444;
        cursor: pointer;
        padding: 18px;
        width: 100%;
        border: none;
        text-align: left;
        outline: none;
        font-size: 15px;
        transition: 0.4s;
    }

    button.accordion.active, button.accordion:hover {
        background-color: #ddd;
    }

    div.panel {
        padding: 0 18px;
        display: none;
        background-color: white;
    }

    div.panel.show {
        display: block;
    }
</style>

<script>
    var acc = document.getElementsByClassName("accordion");
    var i;
    for (i = 0; i < acc.length; i++) {
        acc[i].onclick = function(){
            this.classList.toggle("active");
            this.nextElementSibling.classList.toggle("show");
        }
    }
</script>