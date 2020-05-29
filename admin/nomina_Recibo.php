<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(monto) as total_monto FROM deducciones";
    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();
    $deduction = $drow['total_monto'];

	$from_title = date('M d, Y', strtotime($ex[0]));
	$to_title = date('M d, Y', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payslip: '.$from_title.' - '.$to_title);  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	$sql = "SELECT *, SUM(num_hr) AS total_hr, asistencia.empleado_id AS empid, empleado.empleado_id AS empleado FROM asistencia LEFT JOIN empleado ON empleado.id=asistencia.empleado_id LEFT JOIN posicion ON posicion.id=empleado.posicion_id WHERE date BETWEEN '$from' AND '$to' GROUP BY asistencia.empleado_id ORDER BY empleado.apellido ASC, empleado.nombre ASC";

	$query = $conn->query($sql);
	while($row = $query->fetch_assoc()){
		$empid = $row['empid'];
                      
      	
      	$caquery = $conn->query($casql);
      	$carow = $caquery->fetch_assoc();
      	$adelantoefectivo = $carow['cashmonto'];

		$gross = $row['sueldo'] * $row['total_hr'];
		$total_deduction = $deduction + $adelantoefectivo;
  		$net = $gross - $total_deduction;

		$contents .= '
			<h2 align="center">CasNoWilly</h2>
			<h4 align="center">'.$from_title." - ".$to_title.'</h4>
			<table cellspacing="0" cellpadding="3">  
    	       	<tr>  
            		<td width="25%" align="right">Nombre Empleado: </td>
                 	<td width="25%"><b>'.$row['nombre']." ".$row['apellido'].'</b></td>
				 	<td width="25%" align="right">Pago por Hora: </td>
                 	<td width="25%" align="right">'.number_format($row['sueldo'], 2).'</td>
    	    	</tr>
    	    	<tr>
    	    		<td width="25%" align="right">ID Empleado: </td>
				 	<td width="25%">'.$row['empleado'].'</td>   
				 	<td width="25%" align="right">Total de Horas: </td>
				 	<td width="25%" align="right">'.number_format($row['total_hr'], 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Pago Real: </b></td>
				 	<td width="25%" align="right"><b>'.number_format(($row['sueldo']*$row['total_hr']), 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Deducciones: </td>
				 	<td width="25%" align="right">'.number_format($deduction, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right">Avance de Efectivo: </td>
				 	<td width="25%" align="right">'.number_format($adelantoefectivo, 2).'</td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Total Deduciones:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($total_deduction, 2).'</b></td> 
    	    	</tr>
    	    	<tr> 
    	    		<td></td> 
    	    		<td></td>
				 	<td width="25%" align="right"><b>Salario Neto:</b></td>
				 	<td width="25%" align="right"><b>'.number_format($net, 2).'</b></td> 
    	    	</tr>
    	    </table>
    	    <br><hr>
		';
	}
    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');

?>