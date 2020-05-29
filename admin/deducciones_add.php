<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$descripcion = $_POST['descripcion'];
		$monto = $_POST['monto'];

		$sql = "INSERT INTO deducciones (descripcion, monto) VALUES ('$descripcion', '$monto')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'deducciones added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: deducciones.php');

?>