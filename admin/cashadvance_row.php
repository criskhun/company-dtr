<?php 
	include 'includes/session.php';

	if(isset($_POST['id'])){
		$id = $_POST['id'];
		$sql = "SELECT   ca.*,   ca.id AS caid,   emp.firstname AS firstname,   emp.lastname AS lastname,   emp.employee_id AS empid,   att.total_hr,   s.totalsales,   pos.rate,   (0.0363 * (att.total_hr + s.totalsales + pos.rate)) AS sss,   (0.02 * (att.total_hr + s.totalsales + pos.rate)) AS pagibig,   100 AS philhealth,  1000 AS tax FROM   cashadvance AS ca   LEFT JOIN (     SELECT       employee_id,       SUM(num_hr) AS total_hr     FROM       attendance     GROUP BY       employee_id   ) AS att ON att.employee_id = ca.employee_id   LEFT JOIN (     SELECT       employee_id,       SUM(amount) AS totalsales     FROM       sales     GROUP BY       employee_id   ) AS s ON s.employee_id = ca.employee_id   LEFT JOIN employees AS emp ON emp.id = ca.employee_id   LEFT JOIN (     SELECT       id,       rate     FROM       position     GROUP BY       id   ) AS pos ON pos.id = emp.position_id WHERE   rate IS NOT NULL   AND ca.id = '$id' ORDER BY   ca.date_advance DESC;";
		$query = $conn->query($sql);
		$row = $query->fetch_assoc();

		echo json_encode($row);
	}
?>