<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, empleado.id AS empid FROM empleado LEFT JOIN horarios ON horarios.id=empleado.calendario_id WHERE empleado.id = '$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>