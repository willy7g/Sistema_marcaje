<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Empleado</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="empleado_add.php" enctype="multipart/form-data">


          		  <div class="form-group">
                  	<label for="nombre" class="col-sm-3 control-label">Nombre</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="nombre" name="nombre" required>
                  	</div>
                </div>



                <div class="form-group">
                  	<label for="apellido" class="col-sm-3 control-label">Apellido</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="apellido" name="apellido" required>
                  	</div>
                </div>



                <div class="form-group">
                  	<label for="direccion" class="col-sm-3 control-label">Dirección</label>

                  	<div class="col-sm-9">
                      <textarea class="form-control" name="direccion" id="direccion"></textarea>
                  	</div>
                </div>



                <div class="form-group">
                  	<label for="datepicker_add" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                  	<div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="fechaNacimiento">
                      </div>
                  	</div>




                </div>
                <div class="form-group">
                    <label for="contacto" class="col-sm-3 control-label">Información de contactoo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="contacto" name="contacto">
                    </div>
                </div>




                <div class="form-group">
                    <label for="genero" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="genero" id="genero" required>
                        <option value="" selected>- Seleccionar -</option>
                        <option value="Male">Hombre</option>
                        <option value="Female">Mujer</option>
                      </select>
                    </div>
                </div>



                <div class="form-group">
                    <label for="posicion" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="posicion" id="posicion" required>
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM posicion";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['descripcion']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>





                <div class="form-group">
                    <label for="horarios" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="horarios" name="horarios" required>
                        <option value="" selected>- Seleccionar -</option>
                        <?php
                          $sql = "SELECT * FROM horarios";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>




                <div class="form-group">
                    <label for="foto" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" name="foto" id="foto">
                    </div>
                </div>
          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Guardar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>








































<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="empleado_id"></span></b></h4>
          	</div>
          	<div class="modal-body">

            	<form class="form-horizontal" method="POST" action="empleado_edit.php">
            		<input type="hidden" class="empid" name="id">


                <div class="form-group">
                    <label for="edit_nombre" class="col-sm-3 control-label">Nombre</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_nombre" name="nombre">
                    </div>
                </div>


                <div class="form-group">
                    <label for="edit_apellido" class="col-sm-3 control-label">Apellido</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_apellido" name="apellido">
                    </div>
                </div>


                <div class="form-group">
                    <label for="edit_direccion" class="col-sm-3 control-label">Dirección</label>

                    <div class="col-sm-9">
                      <textarea class="form-control" name="direccion" id="edit_direccion"></textarea>
                    </div>
                </div>




                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha de Nacimiento</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="fechaNacimiento">
                      </div>
                    </div>
                </div>



                <div class="form-group">
                    <label for="edit_contacto" class="col-sm-3 control-label">Información de contactoo</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="edit_contacto" name="contacto">
                    </div>
                </div>



                <div class="form-group">
                    <label for="edit_genero" class="col-sm-3 control-label">Género</label>

                    <div class="col-sm-9"> 
                      <select class="form-control" name="genero" id="edit_genero">
                        <option selected id="genero_val"></option>
                        <option value="Male">Hombre</option>
                        <option value="Female">Mujer</option>
                      </select>
                    </div>
                </div>



                <div class="form-group">
                    <label for="edit_posicion" class="col-sm-3 control-label">Cargo</label>

                    <div class="col-sm-9">
                      <select class="form-control" name="posicion" id="edit_posicion">
                        <option selected id="posicion_val"></option>
                        <?php
                          $sql = "SELECT * FROM posicion";
                          $query = $conn->query($sql);
                          while($prow = $query->fetch_assoc()){
                            echo "
                              <option value='".$prow['id']."'>".$prow['descripcion']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>




                <div class="form-group">
                    <label for="edit_horarios" class="col-sm-3 control-label">Horario</label>

                    <div class="col-sm-9">
                      <select class="form-control" id="edit_horarios" name="horarios">
                        <option selected id="horarios_val"></option>
                        <?php
                          $sql = "SELECT * FROM horarios";
                          $query = $conn->query($sql);
                          while($srow = $query->fetch_assoc()){
                            echo "
                              <option value='".$srow['id']."'>".$srow['time_in'].' - '.$srow['time_out']."</option>
                            ";
                          }
                        ?>
                      </select>
                    </div>
                </div>



          	</div>
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i> Actualizar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>













<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b><span class="empleado_id"></span></b></h4>
          	</div>
          	<div class="modal-body">

            	<form class="form-horizontal" method="POST" action="empleado_delete.php">
            		<input type="hidden" class="empid" name="id">


            		<div class="text-center">
	                	<p>ELIMINAR EMPLEADO</p>
	                	<h2 class="bold del_empleado_name"></h2>
	            	</div>
          	</div>



            
          	<div class="modal-footer">
            	<button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
            	<button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Eliminar</button>
            	</form>
          	</div>
        </div>
    </div>
</div>

<!-- Update foto -->
<div class="modal fade" id="edit_foto">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b><span class="del_empleado_name"></span></b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="empleado_edit_foto.php" enctype="multipart/form-data">
                <input type="hidden" class="empid" name="id">
                <div class="form-group">
                    <label for="foto" class="col-sm-3 control-label">Foto</label>

                    <div class="col-sm-9">
                      <input type="file" id="foto" name="foto" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
              <button type="submit" class="btn btn-success btn-flat" name="upload"><i class="fa fa-check-square-o"></i> Actualizar</button>
              </form>
            </div>
        </div>
    </div>
</div>    