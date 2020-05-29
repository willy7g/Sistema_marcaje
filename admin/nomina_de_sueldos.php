<?php include 'includes/session.php'; ?>
<?php
  include '../timezone.php';
  $range_to = date('m/d/Y');
  $range_from = date('m/d/Y', strtotime('-30 day', strtotime($range_to)));
?>
<?php include 'includes/header.php'; ?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include 'includes/navbar.php'; ?>
  <?php include 'includes/menubar.php'; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Nómina
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Nómina</li>
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
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header with-border">
              <div class="pull-right">
                <form method="POST" class="form-inline" id="payForm">
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input type="text" class="form-control pull-right col-sm-8" id="reservation" name="date_range" value="<?php echo (isset($_GET['range'])) ? $_GET['range'] : $range_from.' - '.$range_to; ?>">
                  </div>
                  <button type="button" class="btn btn-success btn-sm btn-flat" id="nomina_de_sueldos"><span class="glyphicon glyphicon-print"></span> Nómina de Sueldo</button>
                  <button type="button" class="btn btn-primary btn-sm btn-flat" id="payslip"><span class="glyphicon glyphicon-print"></span> Recibo de Sueldo</button>
                </form>
              </div>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>Nombre Empleado</th>
                  <th>ID Empleado</th>
                  <th>Gross</th>
                  <th>Deducciones</th>
                  <th>Avance de Efectivo</th>
                  <th>Pago Neto</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, SUM(monto) as total_monto FROM deducciones";
                    $query = $conn->query($sql);
                    $drow = $query->fetch_assoc();
                    $deduction = $drow['total_monto'];
  
                    
                    $to = date('Y-m-d');
                    $from = date('Y-m-d', strtotime('-30 day', strtotime($to)));

                    if(isset($_GET['range'])){
                      $range = $_GET['range'];
                      $ex = explode(' - ', $range);
                      $from = date('Y-m-d', strtotime($ex[0]));
                      $to = date('Y-m-d', strtotime($ex[1]));
                    }

                    $sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.empleado_id AS empid FROM asistencia LEFT JOIN empleado ON empleado.id=asistencia.empleado_id LEFT JOIN posicion ON posicion.id=empleado.posicion_id WHERE date BETWEEN '$from' AND '$to' GROUP BY asistencia.empleado_id ORDER BY empleado.nombre ASC, empleado.apellido ASC";

                    $query = $conn->query($sql);
                    $total = 0;
                    while($row = $query->fetch_assoc()){
                      $empid = $row['empid'];
                      
                      $casql = "SELECT *, SUM(monto) AS cashmonto FROM adelantoefectivo WHERE empleado_id='$empid' AND fecha BETWEEN '$from' AND '$to'";
                      
                      $caquery = $conn->query($casql);
                      $carow = $caquery->fetch_assoc();
                      $adelantoefectivo = $carow['cashmonto'];

                      $gross = $row['sueldo'] * $row['total_hr'];
                      $total_deduction = $deduction + $adelantoefectivo;
                      $net = $gross - $total_deduction;

                      echo "
                        <tr>
                          <td>".$row['nombre'].", ".$row['apellido']."</td>
                          <td>".$row['empleado_id']."</td>
                          <td>".number_format($gross, 2)."</td>
                          <td>".number_format($deduction, 2)."</td>
                          <td>".number_format($adelantoefectivo, 2)."</td>
                          <td>".number_format($net, 2)."</td>
                        </tr>
                      ";
                    }

                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </section>   
  </div>
    










  <?php include 'includes/footer.php'; ?>
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

  $('.delete').click(function(e){
    e.preventDefault();
    $('#delete').modal('show');
    var id = $(this).data('id');
    getRow(id);
  });





  $("#reservation").on('change', function(){
    var range = encodeURI($(this).val());
    window.location = 'nomina_de_sueldos.php?range='+range;
  });





  $('#nomina_de_sueldos').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'nomina_Generar.php');
    $('#payForm').submit();
  });







  $('#payslip').click(function(e){
    e.preventDefault();
    $('#payForm').attr('action', 'nomina_Recibo.php');
    $('#payForm').submit();
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'posicion_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('#posid').val(response.id);
      $('#edit_title').val(response.descripcion);
      $('#edit_sueldo').val(response.sueldo);
      $('#del_posid').val(response.id);
      $('#del_posicion').html(response.descripcion);
    }
  });
}


</script>
</body>
</html>
