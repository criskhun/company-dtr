<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
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
		$filename = $_FILES['photo']['name'];

		if(!empty($filename)){
			move_uploaded_file($_FILES['photo']['tmp_name'], '../images/'.$filename);	
		}
		//creating employeeid
		$letters = '';
		$numbers = '';
		foreach (range('A', 'Z') as $char) {
		    $letters .= $char;
		}
		for($i = 0; $i < 6; $i++){
			$numbers .= $i;
		}
		$employee_id = substr(str_shuffle($letters), 0, 3).substr(str_shuffle($numbers), 0, 5);
		//
		$sql = "INSERT INTO employees (employee_id, firstname, lastname, password, address, birthdate, contact_info, gender, position_id, schedule_id, photo, created_on, sssno, philno, pagibigno, tinno) VALUES ('$employee_id', '$firstname', '$lastname', '$pass', '$address', '$birthdate', '$contact', '$gender', '$position', '$schedule', '$filename', NOW(), '$sssno', '$philno', '$pagibigno', '$tinno')";

		if($conn->query($sql)){
			$_SESSION['success'] = 'Employee added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}

	}
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: employee.php');
?>