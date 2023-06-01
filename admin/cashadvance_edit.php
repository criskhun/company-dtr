<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['caid'];
		$amount = $_POST['edit_amount'];
		$sss = $_POST['edit_sss'];
		$pagibig = $_POST['edit_pagibig'];
		$philhealth = $_POST['edit_philhealth'];
		
		$sql = "UPDATE cashadvance SET amount = '$amount', sss = '$sss', pagibig = '$pagibig', philhealth = '$philhealth'  WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Mandatory Deductions updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:cashadvance.php');

?>