<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
		$bankname = $_POST['bankname'];
		$plantype = $_POST['plantype'];
        $rate = $_POST['rate'];
		$sql = "UPDATE bank SET bankname = '$bankname', plantype = '$plantype', rate = '$rate' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Deduction updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:bank.php');

?>