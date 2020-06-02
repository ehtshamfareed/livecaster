<?php
 $servername = "localhost";
 $username = "root";
 $password = "";
 $db = "livecaster";

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
//echo "Connected successfully";
	

?> 