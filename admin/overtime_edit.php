<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$date = $_POST['date'];
		$horas = $_POST['horas'] + ($_POST['mins']/60);
		$sueldo = $_POST['sueldo'];

		$sql = "UPDATE overtim SET horas = '$horas', sueldo = '$sueldo', date_overtime = '$date' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Overtime updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:overtime.php');

?>