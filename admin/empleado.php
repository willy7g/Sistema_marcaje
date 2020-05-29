<?php include 'includes/session.php'; ?>
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
        Lista de Empleados
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li>Empleados</li>
        <li class="active">Lista de Empleados</li>
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
               <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <div class="box-body">
              <table id="example1" class="table table-bordered">
                <thead>
                  <th>ID Empleado</th>
                  <th>Foto</th>
                  <th>Nombre</th>
                  <th>Posición</th>
                  <th>Horarios</th>
                  <th>Miembro Desde</th>
                  <th>Acción</th>
                </thead>
                <tbody>
                  <?php
                    $sql = "SELECT *, empleado.id AS empid FROM empleado LEFT JOIN posicion ON posicion.id=empleado.posicion_id LEFT JOIN horarios ON horarios.id=empleado.calendario_id";
                    $query = $conn->query($sql);
                    while($row = $query->fetch_assoc()){
                      ?>
                        <tr>
                          <td><?php echo $row['empleado_id']; ?></td>



                          
                          <td><img src="<?php echo (!empty($row['foto']))? '../images/'.$row['foto']:'../images/profile.jpg'; ?>" width="30px" height="30px"> <a href="#edit_foto" data-toggle="modal" class="pull-right foto" data-id="<?php echo $row['empid']; ?>"><span class="fa fa-edit"></span></a></td>



                          <td><?php echo $row['nombre'].' '.$row['apellido']; ?></td>
                          <td><?php echo $row['descripcion']; ?></td>
                          <td><?php echo date('h:i A', strtotime($row['time_in'])).' - '.date('h:i A', strtotime($row['time_out'])); ?></td>
                          <td><?php echo date('M d, Y', strtotime($row['created_on'])) ?></td>
                          <td>
                            <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-edit"></i> Editar</button>
                            <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $row['empid']; ?>"><i class="fa fa-trash"></i> Eliminar</button>
                          </td>
                        </tr>
                      <?php
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
<?php include 'includes/empleado_modal.php'; ?>
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

  $('.foto').click(function(e){
    e.preventDefault();
    var id = $(this).data('id');
    getRow(id);
  });

});

function getRow(id){
  $.ajax({
    type: 'POST',
    url: 'empleado_row.php',
    data: {id:id},
    dataType: 'json',
    success: function(response){
      $('.empid').val(response.empid);
      $('.empleado_id').html(response.empleado_id);
      $('.del_empleado_name').html(response.nombre+' '+response.apellido);
      $('#empleado_name').html(response.nombre+' '+response.apellido);
      $('#edit_nombre').val(response.nombre);
      $('#edit_apellido').val(response.apellido);
      $('#edit_direccion').val(response.direccion);
      $('#datepicker_edit').val(response.fechaNacimiento);
      $('#edit_contacto').val(response.contacto);
      $('#genero_val').val(response.genero).html(response.genero);
      $('#posicion_val').val(response.posicion_id).html(response.descripcion);
      $('#horarios_val').val(response.calendario_id).html(response.time_in+' - '+response.time_out);
    }
  });
}
</script>
</body>
</html>
