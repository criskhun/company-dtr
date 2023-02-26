<?php
include 'conn.php';

if (isset($_GET['empid'])) {
    $empid = $_GET['empid'];

    // Get the rate for the selected employee
    $query = "SELECT rate FROM employees WHERE employee_id = $empid";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);

    // Return the rate as JSON
    header('Content-Type: application/json');
    echo json_encode($row);
}
?>
