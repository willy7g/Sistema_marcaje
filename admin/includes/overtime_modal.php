<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
          	<div class="modal-header">
            	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
              		<span aria-hidden="true">&times;</span></button>
            	<h4 class="modal-title"><b>Agregar Tiempo Extra</b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="overtime_add.php">
          		  <div class="form-group">
                  	<label for="empleado" class="col-sm-3 control-label">ID Empleado</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="empleado" name="empleado" required>
                  	</div>
                </div>
                <div class="form-group">
                    <label for="datepicker_add" class="col-sm-3 control-label">Fecha</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_add" name="date" required>
                      </div>
                    </div>
                </div>
                <div class="form-group">
                  	<label for="horas" class="col-sm-3 control-label">No. de Horas</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="horas" name="horas">
                  	</div>
                </div>
                <div class="form-group">
                  	<label for="mins" class="col-sm-3 control-label">No. de Minutos</label>

                  	<div class="col-sm-9">
                    	<input type="text" class="form-control" id="mins" name="mins">
                  	</div>
                </div>
                 <div class="form-group">
                    <label for="sueldo" class="col-sm-3 control-label">Promedio</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="sueldo" name="sueldo" required>
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
            	<h4 class="modal-title"><b><span class="empleado_name"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="overtime_edit.php">
            		<input type="hidden" class="otid" name="id">



                <div class="form-group">
                    <label for="datepicker_edit" class="col-sm-3 control-label">Fecha</label>

                    <div class="col-sm-9"> 
                      <div class="date">
                        <input type="text" class="form-control" id="datepicker_edit" name="date" required>
                      </div>
                    </div>
                </div>




                <div class="form-group">
                    <label for="horas_edit" class="col-sm-3 control-label">No. de Horas</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="horas_edit" name="horas">
                    </div>
                </div>



                <div class="form-group">
                    <label for="mins_edit" class="col-sm-3 control-label">No. de Mins</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="mins_edit" name="mins">
                    </div>
                </div>



                 <div class="form-group">
                    <label for="sueldo_edit" class="col-sm-3 control-label">Promedio</label>

                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="sueldo_edit" name="sueldo" required>
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
            	<h4 class="modal-title"><b><span id="overtime_date"></span></b></h4>
          	</div>
          	<div class="modal-body">
            	<form class="form-horizontal" method="POST" action="overtime_delete.php">
            		<input type="hidden" class="otid" name="id">
            		<div class="text-center">
	                	<p>ELIMINAR TIEMPO EXTRA</p>
	                	<h2 class="empleado_name bold"></h2>
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


     