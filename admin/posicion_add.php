<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$title = $_POST['title'];
		$sueldo = $_POST['sueldo'];

		$sql = "INSERT INTO posicion (descripcion, sueldo) VALUES ('$title', '$sueldo')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'posicion added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form firs';
	}

	header('location: posicion.php');

?>