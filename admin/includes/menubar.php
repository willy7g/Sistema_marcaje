<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo (!empty($user['foto'])) ? '../images/'.$user['foto'] : '../images/profile.jpg'; ?>" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $user['nombre'].' '.$user['apellido']; ?></p>
          <a><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">REPORTES</li>
        <li class=""><a href="home.php"><i class="fa fa-dashboard"></i> <span>Panel de Control</span></a></li>
        <li class="header">ADMINISTRACIÓN</li>
        
        <li><a href="asistencia.php"><i class="fa fa-calendar"></i> <span>Asistencia</span></a></li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Empleados</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="empleado.php"><i class="fa fa-circle-o"></i> Lista de Empleados</a></li>
            <li><a href="overtime.php"><i class="fa fa-circle-o"></i> Tiempo Extra</a></li>
            <li><a href="adelantoefectivo.php"><i class="fa fa-circle-o"></i> Adelanto en Efectivo</a></li>
            <li><a href="horarios.php"><i class="fa fa-circle-o"></i> Horarios</a></li>
          </ul>
        </li>
        <li><a href="deducciones.php"><i class="fa fa-file-text"></i> Deducciones</a></li>
        <li><a href="posicion.php"><i class="fa fa-suitcase"></i> Cargos</a></li>
        <li class="header">IMPRIMIBLES</li>
        <li><a href="nomina_de_sueldos.php"><i class="fa fa-files-o"></i> <span>Nómina</span></a></li>
        <li><a href="Horarios_Empleado.php"><i class="fa fa-clock-o"></i> <span>Horarios</span></a></li>
          <li><a href="videos.php"><i class="fa fa-clock-o"></i> <span>Covid-19/Manual_Sistema</span></a></li>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>