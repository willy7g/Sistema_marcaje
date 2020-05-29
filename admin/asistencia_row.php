<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, asistencia.id as attid FROM asistencia LEFT JOIN empleado ON empleado.id=asistencia.empleado_id WHERE asistencia.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>