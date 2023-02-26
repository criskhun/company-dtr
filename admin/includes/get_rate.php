<?php
include 'conn.php';

if(isset($_GET['empid'])){
  $empid = $_GET['empid'];
  $qrate = "SELECT pos.rate as rate FROM employees emp left join position pos on emp.position_id = pos.id WHERE emp.employee_id = '$empid'";
  $drate = mysqli_query($conn, $qrate);
  $rate = mysqli_fetch_assoc($drate)['rate'];
  echo $rate;
}
?>
