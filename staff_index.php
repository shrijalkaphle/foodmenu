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
</head>

<div id="show"></div>

<script type="text/javascript">
  $(document).ready(function() {
    setInterval(function() {
      $('#show').load("data.php")
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
</script>

<div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="fetched-data"></div>
    </div>
  </div>
</div>