<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['id'];
		$sql = "DELETE FROM sales WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Sales information deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select info to delete first';
	}

	header('location: sales.php');
	
?>