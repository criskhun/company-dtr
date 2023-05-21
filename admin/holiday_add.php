<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$employee = $_POST['employee'];
        $hol_type = $_POST['holiday-type'];
		$amount = $_POST['amount'];
        $hours = $_POST['hours'];
        $per_hr_rate = $_POST['rate'];
        $date = $_POST['date'];

		$sql = "INSERT INTO holiday (employee_id, hol_type, hours, per_hr_rate, amount, date) VALUES ('$employee','$hol_type','$hours','$amount','$per_hr_rate','$date')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Holiday added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: holiday.php');

?>