<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn){

		$contents = '';
		
		$sql = "SELECT *, employees.employee_id AS empid, attendance.id AS attid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id where attendance.date BETWEEN '$from' AND '$to' and attendance.status = 0 ORDER BY attendance.date DESC, attendance.time_in DESC";;

		$query = $conn->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
			$contents .= "
			<tr>
			<td class='hidden'></td>
			<td>".date('M d, Y', strtotime($row['date']))."</td>
			<td>".$row['empid']."</td>
			<td>".$row['firstname'].' '.$row['lastname']."</td>
			<td>".date('h:i A', strtotime($row['time_in'])).$status."</td>
			<td>".date('h:i A', strtotime($row['time_out']))."</td>
			</tr>
			";
		}

		return $contents;
	}
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	require_once('../tcpdf/tcpdf.php');  
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Employee Late Report');  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  
    $content = '';  
    $content .= '
      	<h2 align="center">GNET Group of Companies</h2>
      	<h4 align="center">Employee Late Report</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
           		<th width="20%" align="center"><b>Date</b></th>
                <th width="20%" align="center"><b>Employee ID</b></th>
				<th width="20%" align="center"><b>Name</b></th>
				<th width="20%" align="center"><b>Time In</b></th> 
				<th width="20%" align="center"><b>Time Out</b></th> 
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn); 
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('late.pdf', 'I');

?>