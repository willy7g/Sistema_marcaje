<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT *, adelantoefectivo.id AS caid FROM adelantoefectivo LEFT JOIN empleado on empleado.id=adelantoefectivo.empleado_id WHERE adelantoefectivo.id='$id'";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>