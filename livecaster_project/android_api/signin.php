<?php
session_start();
if(isset($_SESSION['username'])){header("Location: ../panel.php");}else{}
include 'templates/header.php';
?>





<?php
include "templates/signin_form.php";
include 'templates/footer.php';
?>
