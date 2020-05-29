<?php include 'includes/session.php'; ?>
<?php include 'includes/header.php'; ?>
<link rel="stylesheet" type="text/css" href="style.css">
<body class="hold-transition skin-blue sidebar-mini">

<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Prevenciones sobre el COVID-19
      </h1>

<section >
    <video id="slider" autoplay muted loop>
      <source src="videos/video1.mp4" type="video/mp4">   

    </video>


<ul class="navegacion">
    <li onclick="cargarVideo('VIDEOS/video1.mp4');">
      <img src="img/1.jpg">
    </li>
<li onclick="cargarVideo('VIDEOS/video6.mp4');">
      <img src="img/6.jpg">
    </li>



    <li onclick="cargarVideo('videos/video2.mp4');">
      <img src="IMG/2.jpg">
    </li>
    <li onclick="cargarVideo('videos/video3.mp4');">
      <img src="img/3.jpg">
    </li>
    <li onclick="cargarVideo('videos/video4.mp4');">
      <img src="img/4.png">
    </li>
      <li onclick="cargarVideo('videos/video5.mp4');">
      <img src="img/5.png">
    </li>
  </ul>

  </section>




<script type="text/javascript">
  function cargarVideo(url){
    document.getElementById('slider').src=url;
  } 
</script>







      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Guias</a></li>
        <li>Casno</li>
        <li class="active">Tutoriales</li>
      </ol>
    </section>


    <!-- Main content -->
    <section class="content">
      <?php
        if(isset($_SESSION['error'])){
          echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              ".$_SESSION['error']."
            </div>
          ";
          unset($_SESSION['error']);
        }
        if(isset($_SESSION['success'])){
          echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i>¡Proceso Exitoso!</h4>
              ".$_SESSION['success']."
            </div>
          ";
          unset($_SESSION['success']);
        }
      ?>






    
 
  <?php include 'includes/Horarios_Empleado_modal.php'; ?>





</div>



<?php include 'includes/scripts.php'; ?>
<script>
$(function(){
  $('.edit').click(function(e){
    e.preventDefault();
    $('#edit').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });
});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'Horarios_Empleado_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.employee_name').html(response.nombre+' '+response.apellido);
      $('#horarios_val').val(response.calendario_id);
      $('#horarios_val').html(response.time_in+' '+response.time_out);
      $('#empid').val(response.empid);
    }
  });
}
</script>
 <script src="https://account.snatchbot.me/script.js"></script><script>window.sntchChat.Init(111745)</script> 

</body>
</html>
