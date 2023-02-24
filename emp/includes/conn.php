<?php
	$conn = new mysqli('localhost', 'u854000491_newdtr', 'Letmein#123', 'u854000491_newdtr');
	//$conn = new mysqli('localhost', 'u692837713_apsys', 'letmein123', 'u692837713_apsystem');

	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
	
?>