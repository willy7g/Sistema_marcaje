<?php
	include 'includes/session.php';

	if(isset($_GET['return'])){
		$return = $_GET['return'];
		
	}
	else{
		$return = 'home.php';
	}

	if(isset($_POST['save'])){
		$curr_password = $_POST['curr_password'];
		$username = $_POST['username'];
		$password = $_POST['password'];
		$nombre = $_POST['nombre'];
		$apellido = $_POST['apellido'];
		$foto = $_FILES['foto']['name'];
		if(password_verify($curr_password, $user['password'])){
			if(!empty($foto)){
				move_uploaded_file($_FILES['foto']['tmp_name'], '../images/'.$foto);
				$filename = $foto;	
			}
			else{
				$filename = $user['foto'];
			}

			if($password == $user['password']){
				$password = $user['password'];
			}
			else{
				$password = password_hash($password, PASSWORD_DEFAULT);
			}

			$sql = "UPDATE admin SET username = '$username', password = '$password', nombre = '$nombre', apellido = '$apellido', foto = '$filename' WHERE id = '".$user['id']."'";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Perfil de administrador actualizado correctamente';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
			
		}
		else{
			$_SESSION['error'] = 'Contraseña Incorrecta';
		}
	}
	else{
		$_SESSION['error'] = 'Rellene los detalles requeridos primero';
	}

	header('location:'.$return);

?>