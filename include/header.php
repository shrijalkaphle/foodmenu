<?php
  error_reporting(0);
  include 'include/dbconnect.php';
  session_start();
?>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/template.css">
</head>


<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>

      <?php
          if ($_SESSION['role']) {
            if($_SESSION['role'] == "staff") {
        ?>
              <a class="navbar-brand" href="staff_index.php">Food Order System</a>
        <?php
            } else {
        ?>
              <a class="navbar-brand" href="admin_index.php">Food Order System</a>
        <?php
            }
          } else {
        ?>
        <a class="navbar-brand" href="index.php">Food Order System</a>
        <?php
          }
        ?>
      
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <?php
          if ($_SESSION['role']) {
            if($_SESSION['role'] == "admin") {
        ?>
        <li><a href="sales.php">View Sales</a></li>
        <?php
            }
        ?>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
        <?php
          } else {
        ?>
        <li><a href="login.php"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></a></li>
        <?php
          }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>