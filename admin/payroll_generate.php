<?php
	include 'includes/session.php';

	function generateRow($from, $to, $conn, $deduction){
		$contents = '';
	 	
		$sql = "SELECT *, sum(num_hr) AS total_hr, SUM(sales.amount) AS totalsales, attendance.employee_id AS empid FROM attendance LEFT JOIN employees ON employees.id=attendance.employee_id LEFT JOIN position ON position.id=employees.position_id LEFT JOIN sales ON sales.employee_id=employees.employee_id WHERE date BETWEEN '$from' AND '$to' AND position.description IN ('ADMIN STAFF', 'UNIT MANAGER') GROUP BY attendance.employee_id ORDER BY employees.lastname ASC, employees.firstname ASC";

		$query = $conn->query($sql);
		$total = 0;
		while($row = $query->fetch_assoc()){
			$empid = $row['empid'];
                      
	      	$casql = "SELECT *,  SUM(amount)+ SUM(sss)+ SUM(pagibig)+ SUM(philhealth) AS cashamount FROM cashadvance WHERE employee_id='$empid' AND date_advance BETWEEN '$from' AND '$to' group by amount, sss, pagibig, philhealth";
			
			$salesdeduct = "SELECT sa.*, SUM(sa.approvededuction) AS aprdeduc, COUNT(status) as cntaprv FROM sales sa LEFT JOIN employees es ON es.employee_id = sa.employee_id WHERE es.id='$empid' and status = 'Approved' AND sa.salesdate BETWEEN '$from' AND '$to' group by approvededuction";
  
	      	$caquery = $conn->query($casql);
	      	$carow = $caquery->fetch_assoc();
			$cashadvance = $carow['cashamount'];
			  
			$saquery = $conn->query($salesdeduct); 
            $sarow = $saquery->fetch_assoc();
			$salesaprdeduc = $sarow['aprdeduc'];
			$salescount = $sarow['cntaprv'];

			$allowance = "SELECT SUM(amount) from allowance";


			$gross = $row['rate'] * $row['total_hr'] + $row['totalsales'] + $allowance;
            $sss = 0.0363 * $gross;
            $pagibig = 0.02 * $gross;
            $philhealth = 100;
            $tax = 0.05 * ($gross - 20000);
            $total_deduction = $deduction + $cashadvance + $salesaprdeduc + $sss + $pagibig + $tax;
      		$net = $gross - $total_deduction;

			$total += $net;
			$contents .= '
			<tr>
				<td>'.$row['lastname'].', '.$row['firstname'].'</td>
				<td align="right">'.number_format($gross, 2).'</td>
				<td align="right">'.number_format($allowance, 2).'</td>
				<td align="right">'.number_format($deduction, 2).'</td>
				<td align="right">'.number_format($total_deduction, 2).'</td>
				<td align="right">'.number_format($net, 2).'</td>
			</tr>
			';
		}

		$contents .= '
			<tr>
				<td colspan="6" align="right"><b>Total</b></td>
				<td align="right"><b>'.number_format($total, 2).'</b></td>
			</tr>
		';
		return $contents;
	}
		
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
    $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle('Payroll: '.$from_title.' - '.$to_title);  
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
      	<h2 align="center">GNET Group of Companies - Admin</h2>
      	<h4 align="center">'.$from_title." - ".$to_title.'</h4>
      	<table border="1" cellspacing="0" cellpadding="3">  
           <tr>  
		   <th width="20%" align="center"><b>Agent Name</b></th>
		   <th width="13%" align="center"><b>Gross</b></th>
		   <th width="13%" align="center"><b>Allowance</b></th>
		   <th width="13%" align="center"><b>Other Deduction</b></th>
		   <th width="13%" align="center"><b>Mandatory Deduction</b></th>
		   <th width="13%" align="center"><b>Net Pay</b></th> 
           </tr>  
      ';  
    $content .= generateRow($from, $to, $conn, $deduction);  
    $content .= '</table>';  
    $pdf->writeHTML($content);  
    $pdf->Output('payroll.pdf', 'I');

?>