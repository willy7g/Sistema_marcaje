<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$empleado = $_POST['empleado'];
		$date = $_POST['date'];
		$time_in = $_POST['time'];
		$time_in = date('H:i:s', strtotime($time_in));
		$time_out = $_POST['time_out'];
		$time_out = date('H:i:s', strtotime($time_out));

		$sql = "SELECT * FROM empleado WHERE empleado_id = '$empleado'";
		$query = $conn->query($sql);

		if($query->num_rows < 1){
			$_SESSION['error'] = 'emplead000o not found';
		}
		else{
			$row = $query->fetch_assoc();
			$emp = $row['id'];

			$sql = "SELECT * FROM asistencia WHERE empleado_id = '$emp' AND date = '$date'";
			$query = $conn->query($sql);

			if($query->num_rows > 0){
				$_SESSION['error'] = 'empleado asistencia for the day exist';
			}
			else{
				//updates
				$sched = $row['calendario_id'];
				$sql = "SELECT * FROM horarios WHERE id = '$sched'";
				$squery = $conn->query($sql);
				$scherow = $squery->fetch_assoc();
				$logstatus = ($time_in > $scherow['time_in']) ? 0 : 1;
				//
				$sql = "INSERT INTO asistencia (empleado_id, date, time_in, time_out, status) VALUES ('$emp', '$date', '$time_in', '$time_out', '$logstatus')";
				if($conn->query($sql)){
					$_SESSION['success'] = 'asistencia added successfully';
					$id = $conn->insert_id;

					$sql = "SELECT * FROM empleado LEFT JOIN horarios ON horarios.id=empleado.calendario_id WHERE empleado.id = '$emp'";
					$query = $conn->query($sql);
					$srow = $query->fetch_assoc();

					if($srow['time_in'] > $time_in){
						$time_in = $srow['time_in'];
					}

					if($srow['time_out'] < $time_out){
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

					$sql = "UPDATE asistencia SET num_hr = '$int' WHERE id = '$id'";
					$conn->query($sql);

				}
				else{
					$_SESSION['error'] = $conn->error;
				}
			}
		}
	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}
	
	header('location: asistencia.php');

?>