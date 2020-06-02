<?php 
require 'db.php';
session_start();

	$sql = "SELECT * FROM web_setup";
	$result = $conn->query($sql);


	if ($result->num_rows > 0) {
		// output data of each row
		while($row = $result->fetch_assoc()) {
			$_SESSION["title"] = $row["title"];
			$_SESSION["icon"] = $row["icon"];
			$_SESSION["logo"] = $row["logo"];
			$_SESSION["header"] = $row["header"];
			$_SESSION["footer"] = $row["footer"];
		}
		
	}

?>