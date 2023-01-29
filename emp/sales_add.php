<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$empid = $_POST['empid'];
		$client = $_POST['client'];
		$bankname = $_POST['bankname'];
		$plantype = $_POST['plantype'];
		$rate = $_POST['rate'];
		$approval = $_POST['approval'];

		$sql = "INSERT INTO sales (salesdate ,employee_id, clientname, bankname, plantype, amount, status) VALUES (NOW(),'$empid', '$client', '$bankname', '$plantype', '$rate', '$approval')";
        	

		if($conn->query($sql)){
			$_SESSION['success'] = 'Sales added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: sales.php');

?>