<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$descripcion = $_POST['descripcion'];
		$monto = $_POST['monto'];

		$sql = "UPDATE deducciones SET descripcion = '$descripcion', monto = '$monto' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Deducción realizada satisfactoriamente';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Rellene el formulario de edición primero';
	}

	header('location:deducciones.php');

?>