<?php
session_start();
if(isset($_SESSION['username'])){header("Location: ../panel.php");}else{}
include 'templates/header.php';


?>
<head>
<script type="text/javascript" src="js/functions.js"></script>
</head>



<?php
include "templates/signup_form.php";
include 'templates/footer.php';
?>
