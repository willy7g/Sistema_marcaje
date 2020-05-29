<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$direccion = $_POST['direccion'];
		$fechaNacimiento = $_POST['fechaNacimiento'];
		$contacto = $_POST['contacto'];
		$genero = $_POST['genero'];
		$posicion = $_POST['posicion'];
		$horarios = $_POST['horarios'];
		$filename = $_FILES['foto']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$filename);	
		}
		//creating empleadoid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 10; $i++){
			$numbers .= $i;
		}
		$empleado_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 9);
		//
		$sql = "INSERT INTO empleado (empleado_id, nombre, apellido, direccion, fechaNacimiento, contacto, genero, posicion_id, calendario_id, foto, created_on) VALUES ('$empleado_id', '$nombre', '$apellido', '$direccion', '$fechaNacimiento', '$contacto', '$genero', '$posicion', '$horarios', '$filename', NOW())";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Empleado añadido satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: empleado.php');
?>