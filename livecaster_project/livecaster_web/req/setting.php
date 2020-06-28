<?php
session_start();
require 'db.php';
require 'functions.php';


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
    $sql1 = "SELECT username,phone_number,email FROM authorize_users where user_category = 'superadmin' LIMIT 1";
    $result1 = $conn->query($sql1);

    if ($result1->num_rows > 0) {
        // output data of each row
    while($row1 = $result1->fetch_assoc()) {
        $_SESSION["superadmin_username"] = $row1["username"];
        $_SESSION["superadmin_phone_number"] = $row1["phone_number"];
        $_SESSION["superadmin_email"] = $row1["email"];
    }

}else{
        $_SESSION["superadmin_username"] = "ehtshamfareed";
        $_SESSION["superadmin_phone_number"] = "+923356187487";
        $_SESSION["superadmin_email"] = "ehtshamfareed@email.com";
    }

?>