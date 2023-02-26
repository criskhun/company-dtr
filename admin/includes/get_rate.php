<?php
include 'conn.php';

if (isset($_GET['empid'])) {
  $empid = $_GET['empid'];

  // Get the employee's rate from the database
  $qrate = "SELECT pos.rate FROM employees emp left join position pos on emp.position_id = pos.id WHERE employee_id = '$empid'";
  $drate = mysqli_query($conn, $qrate);
  $row = mysqli_fetch_array($drate);

  // Return the rate
  echo $row['rate'];
}
?>
