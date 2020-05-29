<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$sueldo = $_POST['sueldo'];

		$sql = "UPDATE posicion SET descripcion = '$title', sueldo = '$sueldo' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Posición Actualizada Satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Rellene el formulario de edición primero';
	}

	header('location:posicion.php');

?>