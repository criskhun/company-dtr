<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$empid = $_POST['empid'];
		$bankname = $_POST['bankname'];
		$plantype = $_POST['plantype'];
		$rate = $_POST['rate'];
		$approval = $_POST['approval'];

		$sql = "UPDATE sales SET  employee_id = '$empid', clientname = '$client', bankname = '$bankname', plantype = '$plantype', amount = '$rate', status = '$approval' WHERE id = '$id'";
					

		if($conn->query($sql)){
			$_SESSION['success'] = 'Sales updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:sales.php');

?>