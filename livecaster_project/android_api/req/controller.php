<?php 

class controller {

public function checkusername(){

    if(isset($_SESSION['username'])){
        return false;
    }else{
        return true; 
    }
        }

public function uploadvalidation($file){
  if($file == NULL)
    return NULL;
  else
    return file_get_contents($file);
}

public function generateRandomString($length = 6) {
    return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
}




//CLASS END
}
include "db.php";
function validation_username($username){

$query = "SELECT * FROM authorize_users WHERE username='$username'";
  $result = mysqli_query($conn,$query)or die(mysqli_error());
      $num_row = mysqli_num_rows($result);
      $row=mysqli_fetch_array($result);
      if( $num_row > 0 )
      	return null;
      else
      	return $username;

}



?>