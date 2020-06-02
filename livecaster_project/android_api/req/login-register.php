<?php 
include_once 'db.php';
include_once 'controller.php';
session_start();
if(isset($_POST['signin'])){

    $username = $_POST['username'];
    $password = $_POST['password']; 
      
      $sql = "SELECT * FROM authorize_users WHERE username = '$username' and password = '$password'";
      $result = mysqli_query($conn,$sql)or die(mysqli_error());
      $num_row = mysqli_num_rows($result);
      $row=mysqli_fetch_array($result);
      if( $num_row ==1 )
           {
                if($row['validation_status'] == "no" || $row['validation_status'] == "" ){
                    echo "Pending for approvel!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../signin.php"; }, 1500);</script>';
               echo $goback;
                }else{
                    $_SESSION['username']=$row['username'];
                    $_SESSION['username_id']=$row['username_id'];
                    header("Location: ../panel.php");
                }
           
           }else{
               echo "Sorry Go Back!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../signin.php"; }, 1500);</script>';
               echo $goback;

           }

}
/*

 $_SESSION['username']=$row['username'];
            header("Location: panel.php");

*/
if(isset($_POST['register'])){

    $username = $_POST['username'];
    $validation_username = validation_username($username);
    if($validation_username == null){
      echo "UserName Already Registered!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../signin.php"; }, 1500);</script>';
               echo $goback;
    }else{
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
   
    $image = controller::uploadvalidation($_FILES['image']['tmp_name']);
    if(isset($_POST['authentication'])){$approvel = "yes";}else{$approvel = "no";}
    $validation_code =  controller::generateRandomString();

    $stmt = $conn->prepare("INSERT INTO authorize_users (username, password, email, phone_number, address, profile_picture,validation_code,validation_status ) VALUES (?,?,?,?,?,?,?,?)");
    $null = NULL;
    $stmt->bind_param("sssssbss", $username, $password, $email, $phone_number, $address, $null, $validation_code, $approvel );
    //$stmt->send_long_data(5, file_get_contents($image));
    $stmt->send_long_data(5, $image);
    $stmt->execute();
    
    echo "Sign In!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../signin.php"; }, 1500);</script>';
               echo $goback;

  }
}
  

    





?>