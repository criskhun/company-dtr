<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$empid = $_POST['id'];
		$firstname = $_POST['firstname'];
		$lastname = $_POST['lastname'];
		$password = $_POST['password'];
		$pass = password_hash($password, PASSWORD_DEFAULT);
		$address = $_POST['address'];
		$birthdate = $_POST['birthdate'];
		$contact = $_POST['contact'];
		$gender = $_POST['gender'];
		$position = $_POST['position'];
		$schedule = $_POST['schedule'];
		$sssno = $_POST['sssno'];
		$philno = $_POST['philno'];
		$pagibigno = $_POST['pagibigno'];
		$tinno = $_POST['tinno'];
		
		$sql = "UPDATE employees SET firstname = '$firstname', lastname = '$lastname', password = '$pass', address = '$address', birthdate = '$birthdate', contact_info = '$contact', gender = '$gender', position_id = '$position', schedule_id = '$schedule', sssno = '$sssno', philno = '$philno', pagibigno = '$pagibigno', tinno = '$tinno' WHERE id = '$empid'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Select employee to edit first';
	}

	header('location: employee.php');
?>