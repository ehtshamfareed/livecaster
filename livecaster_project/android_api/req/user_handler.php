<?php 
require "db.php";
if(isset($_POST['update'])){

    $uid = $_GET['id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $validation_status = $_POST['validation_status'];

    $stmt = $conn->prepare("UPDATE authorize_users SET username = '$username',password = '$password',email='$email',phone_number='$phone_number',address='$address',validation_status='$validation_status' where id ='$uid'");
    $stmt->execute();

    
    
    echo "Record Updated!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?users"; }, 1500);</script>';
               echo $goback;

  }
  if(isset($_POST['delete'])){
    $uid = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM authorize_users WHERE id = '$uid' ");
    $stmt->execute();
    echo "Record Deleted!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?users"; }, 1500);</script>';
               echo $goback;

  }

?>