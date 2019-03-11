<?php
  include 'include/header.php';
  if(!isset($_SESSION['role'])) {
    $msg = "Cannot view This page! Login to Continue!";
    echo "<script>window.location.replace('login.php?msg=$msg');</script>";
  } 
?>
<!-- <meta http-equiv="refresh" content="1"> -->
<head>
  <title>Food Order System | Staff Page</title>
  <style>
    .loading{
      text-align: center;
      margin-top: 20%;
    }
    .loading-image{
      
      width: 100px;
      height: 100px;
    }

    .notification-div{
      text-align: center;
      background-color: red;
      color: white;
      width: 80%;
      margin: 0 auto;
      padding: 30px;
    }

  </style>
</head>

<div id="show">
  <div class="loading">
    <img class="loading-image" src="images/loading.gif">
  </div>
</div>

<div class="notification-div">
    <h1 class="notification-text"> A new order has been placed! </h1>
    <button type="button" onclick="hideNotification()" class="btn btn-primary notification-button">Okay</button>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    setInterval(function() {
      $('#show').load("data.php")
      getNotifications();
    }, 3000);
  })

  $(document).ready(function(){
    $('#ModalCenter').on('show.bs.modal', function (e) {
        var rowid = $(e.relatedTarget).data('id');
        $.ajax({
            type : 'post',
            url : 'fetch_record.php', //Here you will fetch records 
            data :  'rowid='+ rowid, //Pass $id
            success : function(data){
              $('.fetched-data').html(data);//Show fetched data from database
            }
        });
     });
  });

  function hideNotification(){
    document.querySelector(".notification-div").style.display = "none";
  }
</script>

<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="fetched-data">
      </div>
    </div>
  </div>
</div>