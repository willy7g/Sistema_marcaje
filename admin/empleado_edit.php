<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$direccion = $_POST['direccion'];
		$fechaNacimiento = $_POST['fechaNacimiento'];
		$contacto = $_POST['contacto'];
		$genero = $_POST['genero'];
		$posicion = $_POST['posicion'];
		$horarios = $_POST['horarios'];
		
		$sql = "UPDATE empleado SET nombre = '$nombr', apellido = '$apellido', direccion = '$direccion', fechaNacimiento = '$fechaNacimiento', contacto = '$contacto', genero = '$genero', posicion_id = '$posicion', calendario_id = '$horarios' WHERE id = '$empid'";
		if($conn->query($sql){
			$_SESSION['success'] = 'Empleado actualizado con éxito';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Seleccionar empleado para editar primero';
	}

	header('location: empleado.php');
?>