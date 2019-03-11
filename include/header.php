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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
              <a class="navbar-brand" href="staff_index.php">Staff Page</a>
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
        <li><a href="sales.php">View Stats</a></li>
        <?php
            } else{
        ?>
        <div class="dropdown notifications-dropdown">
          <a id="dLabel" role="button" data-toggle="dropdown" data-target="#" href="/page.html">
            <i class="glyphicon glyphicon-bell"></i>
          </a>
          
          <ul class="dropdown-menu notifications" role="menu" aria-labelledby="dLabel">
            
            <div class="notification-heading"><h4 class="menu-title">Notifications</h4>
            </div>
            <li class="divider"></li>
          <div class="notifications-wrapper">
            <a class="content" href="#">
              
              <div class="notification-item">
                <h4 class="item-title">Table 7 has placed an order</h4>
                <p class="item-info">20/03/2019 2:35P.M</p>
              </div>
              
            </a>
           

          </div>
            <li class="divider"></li>
            <div class="notification-footer" onclick="setAllNotificationsAsSeen()"><h4 class="menu-title">Mark all as read<i class="glyphicon glyphicon-circle-arrow-right"></i></h4></div>
          </ul>      
        </div>
        <script>
          function getNotifications(){
            
            $.ajax({
              url: "api/notifications/getallnotifications.php",
              type: "post",
				    success: function (response) {
              populateNotificationsDiv(response);
            },
            error: function(jqXHR, textStatus, errorThrown) {

              console.log(textStatus, errorThrown);

            }
            });

          }
          // <a class="content" href="#">
              
          //     <div class="notification-item">
          //       <h4 class="item-title">Table 7 has placed an order</h4>
          //       <p class="item-info">20/03/2019 2:35P.M</p>
          //     </div>
              
          //   </a>

          function populateNotificationsDiv(notifications){

            let notificationsDiv = document.querySelector(".notifications-wrapper");

            while (notificationsDiv.firstChild) {
              notificationsDiv.removeChild(notificationsDiv.firstChild);
            }

            notifications.forEach(function(notification){

              

              //Layout

              let notificationItemDiv = document.createElement("div");
              notificationItemDiv.className = "notification-item notification-item-"+notification.id;
              notificationItemDiv.setAttribute("onclick","setNotificationAsSeen("+notification.id+")");

              let itemTitle = document.createElement("h4");
              itemTitle.className = "item-title";

              let itemTitleText = document.createTextNode(notification.message);

              let itemInfo = document.createElement("p");
              itemInfo.className = "item-info";

              let itemDate = document.createTextNode(notification.created_at);

              itemInfo.appendChild(itemDate);
              itemTitle.appendChild(itemTitleText);
              
              notificationItemDiv.appendChild(itemTitle);
              notificationItemDiv.appendChild(itemInfo);

              notificationsDiv.appendChild(notificationItemDiv);



            });

          }

          function setNotificationAsSeen(id){

            let idData = {
              "id":id
            };

            idData = JSON.stringify(idData);
            

            $.ajax({
              url: "api/notifications/setNotificationsAsRead.php",
              type: "post",
              data: idData,
				    success: function (response) {
            },
            error: function(jqXHR, textStatus, errorThrown) {

              console.log(textStatus, errorThrown);

            }
            });

          }

          function setAllNotificationsAsSeen(){

            let notificationItems = document.querySelectorAll(".notification-item");

            Array.from(notificationItems).forEach(function(notificationItem){

              var id = notificationItem.className.split(' ')[1].split('-')[2];

              setNotificationAsSeen(id);

            });

          }


        </script>
        <?php
            }
        ?>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
        <?php
          }
        ?>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>