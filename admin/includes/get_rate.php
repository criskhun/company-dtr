<?php
include 'conn.php';

if (isset($_POST['empid'])) {
  $empid = $_POST['empid'];
  $qrate = "SELECT pos.rate as rate FROM employees emp left join position pos on emp.position_id = pos.id WHERE emp.employee_id = '$empid'";
  $drate = mysqli_query($conn, $qrate);
  $row = mysqli_fetch_assoc($drate);
  $rate = $row['rate'];

  // return rate as JSON object
  echo json_encode(array('rate' => $rate));
}
?>
