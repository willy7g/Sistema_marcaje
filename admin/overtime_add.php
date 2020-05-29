<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$empleado = $_POST['empleado'];
		$date = $_POST['date'];
		$horas = $_POST['horas'] + ($_POST['mins']/60);
		$sueldo = $_POST['sueldo'];
		$sql = "SELECT * FROM empleado WHERE empleado = '$empleado'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'empleado  found';
		}
		else{
			$row = $query->fetch_assoc();
			$empleado_id = $row['id'];
			$sql = "INSERT INTO overtime (empleado_id, date_overtime, horas, sueldo) VALUES ('$empleado_id', '$date', '$horas', '$sueldo')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Overtime added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: overtime.php');

?>