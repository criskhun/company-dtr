<?php
	include 'includes/session.php';

	if(isset($_POST['delete'])){
		$id = $_POST['del_holid'];
		$sql = "DELETE FROM holiday WHERE id ='$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Holiday deleted successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Select item to delete first';
	}

	header('location: holiday.php');
	
?>