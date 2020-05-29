<?php
	include 'includes/session.php';

	if(isset($_POST['upload'])){
		$empid = $_POST['id'];
		$filename = $_FILES['foto']['name'];
		if(!empty($filename)){
			move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$filename);	
		}
		
		$sql = "UPDATE empleado SET foto = '$filename' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'empleado foto updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select empleado to update foto first';
	}

	header('location: empleado.php');
?>