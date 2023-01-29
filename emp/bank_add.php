<?php
	include 'includes/session.php';

	if(isset($_POST['add'])){
		$bankname = $_POST['bankname'];
		$plantype = $_POST['plantype'];
		$rate = $_POST['rate'];

		$sql = "INSERT INTO bank (bankname, plantype, rate) VALUES ('$bankname', '$plantype','$rate')";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Bank added successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}	
	else{
		$_SESSION['error'] = 'Fill up add form first';
	}

	header('location: bank.php');

?>