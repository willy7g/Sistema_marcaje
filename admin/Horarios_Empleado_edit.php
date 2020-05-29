<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$sched_id = $_POST['horarios'];
		
		$sql = "UPDATE empleado SET calendario_id = '$sched' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'horarios updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select horarios to edit first';
	}

	header('location: Horarios_Empleado.php');
?>