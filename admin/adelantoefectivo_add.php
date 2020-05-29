<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$empleado = $_POST['empleado'];
		$monto = $_POST['monto'];
		
		$sql = "SELECT * FROM empleado WHERE empleado_id = '$empleado'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'empleado not found';
		}
		else{
			$row = $query->fetch_assoc();
			$empleado_id = $row['id'];
			$sql = "INSERT INTO adelantoefectivo (empleado_id, fecha, monto) VALUES ('$empleado_id', NOW(), '$monto')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Cash Advance added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: adelantoefectivo.php');

?>