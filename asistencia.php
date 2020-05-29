<?php
	if(isset($_POST['empleado'])){
		$output = array('error'=>false);

		include 'conn.php';
		include 'timezone.php';

		$empleado = $_POST['empleado'];
		$status = $_POST['status'];

		$sql = "SELECT * FROM empleado WHERE empleado_id = '$empleado'";
		$query = $conn->query($sql);

		if($query->num_rows > 0){
			$row = $query->fetch_assoc();
			$id = $row['id'];

			$date_now = date('Y-m-d');

			if($status == 'in'){
				$sql = "SELECT * FROM asistencia WHERE empleado_id = '$id' AND date = '$date_now' AND time_in IS NOT NULL";
				$query = $conn->query($sql);
				if($query->num_rows > 0){
					$output['error'] = true;
					$output['message'] = 'Has registrado tu entrada por hoy';
				}
				else{
					//updates
					$sched = $row['calendario_id'];
					$lognow = date('H:i:s');
					$sql = "SELECT * FROM horarios WHERE id = '$sched'";
					$squery = $conn->query($sql);
					$srow = $squery->fetch_assoc();
					$logstatus = ($lognow > $srow['time_in']) ? 0 : 1;
					//
					$sql = "INSERT INTO asistencia (empleado_id, date, time_in, status) VALUES ('$id', '$date_now', NOW(), '$logstatus')";
					if($conn->query($sql)){
						$output['message'] = 'Llegada: '.$row['nombre'].' '.$row['apellido'];
					}
					else{
						$output['error'] = true;
						$output['message'] = $conn->error;
					}
				}
			}
			else{
				$sql = "SELECT *, asistencia.id AS uid FROM asistencia LEFT JOIN empleado ON empleado.id=asistencia.empleado_id WHERE asistencia.empleado_id = '$id' AND date = '$date_now'";
				$query = $conn->query($sql);
				if($query->num_rows < 1){
					$output['error'] = true;
					$output['message'] = 'No se puede registrar tu salida, sin previamente registrar tu entrada.';
				}
				else{
					$row = $query->fetch_assoc();
					if($row['time_out'] != '00:00:00'){
						$output['error'] = true;
						$output['message'] = 'Has registrado tu salida satisfactoriamente por el día de hoy';
					}
					else{
						
						$sql = "UPDATE asistencia SET time_out = NOW() WHERE id = '".$row['uid']."'";
						if($conn->query($sql)){
							$output['message'] = 'Salida: '.$row['nombre'].' '.$row['apellido'];

							$sql = "SELECT * FROM asistencia WHERE id = '".$row['uid']."'";
							$query = $conn->query($sql);
							$urow = $query->fetch_assoc();

							$time_in = $urow['time_in'];
							$time_out = $urow['time_out'];

							$sql = "SELECT * FROM empleado LEFT JOIN horarios ON horarios.id=empleado.calendario_id WHERE empleado.id = '$id'";
							$query = $conn->query($sql);
							$srow = $query->fetch_assoc();

							if($srow['time_in'] > $urow['time_in']){
								$time_in = $srow['time_in'];
							}

							if($srow['time_out'] < $urow['time_in']){
								$time_out = $srow['time_out'];
							}

							$time_in = new DateTime($time_in);
							$time_out = new DateTime($time_out);
							$interval = $time_in->diff($time_out);
							$hrs = $interval->format('%h');
							$mins = $interval->format('%i');
							$mins = $mins/60;
							$int = $hrs + $mins;
							if($int > 4){
								$int = $int - 1;
							}

							$sql = "UPDATE asistencia SET num_hr = '$int' WHERE id = '".$row['uid']."'";
							$conn->query($sql);
						}
						else{
							$output['error'] = true;
							$output['message'] = $conn->error;
						}
					}
					
				}
			}
		}
		else{
			$output['error'] = true;
			$output['message'] = 'ID de empleado no encontrado';
		}
		
	}
	
	echo json_encode($output);

?>