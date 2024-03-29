<?php
	include 'includes/session.php';
	
	$range = $_POST['date_range'];
	$ex = explode(' - ', $range);
	$from = date('Y-m-d', strtotime($ex[0]));
	$to = date('Y-m-d', strtotime($ex[1]));

	$sql = "SELECT *, SUM(amount) as total_amount FROM deductions";
    $query = $conn->query($sql);
   	$drow = $query->fetch_assoc();
    $deduction = $drow['total_amount'];

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
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage(); 
    $contents = '';

	

	$sql = "SELECT *, SUM(num_hr) AS total_hr, SUM(sales.amount) AS totalsales, attendance.employee_id AS empid, employees.employee_id AS employee, COALESCE(overtime.total_hours, 0) AS overtime_hours, COALESCE(overtime.total_hours * overtime.rate, 0) AS overtime_payment FROM attendance LEFT JOIN employees ON employees.id = attendance.employee_id LEFT JOIN position ON position.id = employees.position_id LEFT JOIN sales ON sales.employee_id = employees.employee_id LEFT JOIN ( SELECT employee_id, SUM(hours) AS total_hours, rate FROM overtime WHERE date_overtime BETWEEN '$from' AND '$to' GROUP BY employee_id ) AS overtime ON overtime.employee_id = employees.employee_id WHERE date BETWEEN '$from' AND '$to' AND position.description NOT IN ('UNIT MANAGER', 'ACCOUNT EXECUTIVE') GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";
    $holiday = "SELECT SUM(amount) AS total_pay from holiday";
	$query = $conn->query($sql);
	
	
	while($row = $query->fetch_assoc()){
		$empid = $row['empid'];
                      
      	$casql = "SELECT *, SUM(amount)+ SUM(sss)+ SUM(pagibig)+ SUM(philhealth) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to' group by amount, sss, pagibig, philhealth";
		
		$salesdeduct = "SELECT sa.*, SUM(sa.approvededuction) AS aprdeduc FROM sales sa LEFT JOIN employees es ON es.employee_id = sa.employee_id WHERE es.id='$empid' and status = 'Approved' AND sa.salesdate BETWEEN '$from' AND '$to' group by approvededuction";
		  
      	$caquery = $conn->query($casql);
      	$carow = $caquery->fetch_assoc();
		$cashadvance = $carow['cashamount'];
		  
		  $saquery = $conn->query($salesdeduct); 
		  $sarow = $saquery->fetch_assoc();
		  $salesaprdeduc = $sarow['aprdeduc'];

		  $allowance = "SELECT SUM(amount) from allowance";

		  $gross = $row['rate'] * $row['total_hr'] + $row['totalsales'] + $allowance;
		  $sss = 0.0363 * $gross;
		  $pagibig = 0.02 * $gross;
		  $philhealth = 100;
		  $tax = 0.05 * ($gross - 20000);
		  $total_deduction = $deduction + $cashadvance + $salesaprdeduc + $sss + $pagibig + $tax;
		  $net = $gross - $total_deduction;

		  

		$contents .= '

		
			<h3 align="center">GNET Group of Companies</h3>
			<h5 align="center">'.$from_title." - ".$to_title.'</h5>
			<table cellspacing="0" cellpadding="0">  
			<tr>
				<td width="25%" align="right">Employee Name:</td>
				<td><b>'.$row['firstname']." ".$row['lastname'].'</b></td>
				<td width="25%" align="right">Employee ID: </td>
				<td>'.$row['employee'].'</td> 
			</tr>
			<tr>
				<td width="25%" align="right">Branch/Dept:</td>
				<td>Jollibee - </td>
				<td width="25%" align="right">TAX Status: </td>
				<td>S</td> 
			</tr>
			<tr>
				<td width="25%" align="right">SSS No.:</td>
				<td>'.$row['sssno'].'</td>
				<td width="25%" align="right">PHILHEALTH No.: </td>
				<td>'.$row['pagibigno'].'</td> 
			</tr>
			<tr>
				<td width="25%" align="right">PAG-IBIG No.:</td>
				<td>'.$row['pagibigno'].'</td>
				<td width="25%" align="right">TIN No.: </td>
				<td>'.$row['tinno'].'</td> 
			</tr>
			<h5 align="center">---------------------------------------------------------------------------EARNINGS---------------------------------------------------------------------------</h5>
			
			<tr>
				<td width="25%" align="right">Regular Pay/RPH: </td>
				<td>'.number_format($row['rate'], 2).'</td>
				<td width="25%" align="right">Holiday Pay: </td>
				<td>'.number_format($holiday, 2).'</td>
			</tr>
			<tr>
				<td width="25%" align="right">Total Hours: </td>
				<td>'.number_format($row['total_hr'], 2).'</td>
				<td width="25%" align="right">Overtime: </td>
				<td>'.number_format($row['overtime_payment'], 2).'</td>
			</tr>
			
			<tr>
				<td width="25%" align="right"><b>Gross Pay: </b></td>
				<td></td>
				<td></td>
				<td><b>'.number_format($gross, 2).'</b></td>
			</tr>
			<h5 align="center">-------------------------------------------------------------------------DEDUCTIONS-------------------------------------------------------------------------</h5>
			<h5 align="center">MANDATORY DEDUCTION</h5>
			
			<tr>
				<td width="25%" align="right">SSS: </td>
				<td>'.number_format($sss, 2).'</td>
				<td width="25%" align="right">PHILHEALTH: </td>
				<td>'.number_format($philhealth, 2).'</td>
			</tr>
			<tr>
				<td width="25%" align="right">PAG-IBIG: </td>
				<td>'.number_format($pagibig, 2).'</td>
				<td width="25%" align="right">TAX: </td>
				<td>'.number_format(abs($tax), 2).'</td>
			</tr>
			<tr>
				<td width="25%" align="right"><b>Total Mandatory Deduction: </b></td>
				<td></td>
				<td></td>
				<td><b>'.number_format(abs($deduction), 2).'</b></td>
			</tr>
			<h5 align="center">BASIC</h5>
			<tr>
				<td width="25%" align="right">Leave/Absent: </td>
				<td>'.number_format(0, 2).'</td>
				<td width="25%" align="right">Undertime: </td>
				<td>'.number_format($row['overtime_payment'], 2).'</td>
			</tr>
			<tr>
				<td width="25%" align="right">Cash Advance: </td>
				<td>'.number_format($cashadvance, 2).'</td>
				<td width="25%" align="right">Other Deductions: </td>
				<td>'.number_format($cashadvance, 2).'</td>
			</tr>
			<tr>
				<td width="25%" align="right"><b>Total Deduction: </b></td>
				<td></td>
				<td></td>
				<td><b>'.number_format(abs($total_deduction), 2).'</b></td>
			</tr>
			<h5 align="center">-----------------------------------------------------------------------------NET PAY-----------------------------------------------------------------------------</h5>
			<tr>
				<td width="25%" align="right"><b>Allowance: </b></td>
				<td>'.number_format($allowance, 2).'</td>
				<td width="25%" align="right">NET Pay: </td>
				<td><b>'.number_format(abs($net), 2).'</b></td>
			</tr>
   	    </table>  
		<br>
		<hr>
		$pdf->AddPage(); 
			';
			

	}
    $pdf->writeHTML($contents);  
    $pdf->Output('payslip.pdf', 'I');

?>