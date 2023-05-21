<?php
	include 'includes/session.php';

	if(isset($_POST['edit'])){
		$id = $_POST['id'];
        $hol_type = $_POST['holiday-type'];
		$amount = $_POST['amount'];
        $hours = $_POST['hours'];
        $date = $_POST['date'];
		$sql = "UPDATE holiday SET hol_type = '$hol_type', amount = '$amount', hours = '$hours', date = '$date' WHERE id = '$id'";
		if($conn->query($sql)){
			$_SESSION['success'] = 'Holiday updated successfully';
		}
		else{
			$_SESSION['error'] = $conn->error;
		}
	}
	else{
		$_SESSION['error'] = 'Fill up edit form first';
	}

	header('location:holiday.php');

?>