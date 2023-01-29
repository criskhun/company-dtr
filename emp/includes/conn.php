<?php
	$conn = new mysqli('localhost', 'u854000491_dtr', 'pass@word1', 'u854000491_apsystem');
	//$conn = new mysqli('localhost', 'u692837713_apsys', 'letmein123', 'u692837713_apsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>