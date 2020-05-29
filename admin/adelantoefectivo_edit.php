<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$monto = $_POST['monto'];
		
		$sql = "UPDATE adelantoefectivo SET monto = '$monto' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Cash advance updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:adelantoefectivo.php');

?>