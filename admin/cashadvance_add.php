<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
		$amount = $_POST['amount'];
		$sss = $_POST['sss'];
		$pagibig = $_POST['pagibig'];
		$philhealth = $_POST['philhealth'];
		
		$sql = "SELECT * FROM employees WHERE employee_id = '$employee'";
		$query = $conn->query($sql);
		if($query->num_rows < 1){
			$_SESSION['error'] = 'Employee not found';
		}
		else{
			$row = $query->fetch_assoc();
			$employee_id = $row['id'];
			$sql = "INSERT INTO cashadvance (employee_id, date_advance, amount, sss, pagibig, philhealth) VALUES ('$employee_id', NOW(), '$amount', '$sss', '$pagibig', '$philhealth')";
			if($conn->query($sql)){
				$_SESSION['success'] = 'Other Deductions added successfully';
			}
			else{
				$_SESSION['error'] = $conn->error;
			}
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: cashadvance.php');

?>