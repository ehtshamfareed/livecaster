<?php
session_start();
include_once "req/db.php";
//Needs to be defined outside the loop, otherwise you'll keep resetting $output['data']
$output['output'] = array();
$media['media'] = array();


if(isset($_GET['login'])){

    $username = $_GET['username'];$password = $_GET['password'];
    $sql = "SELECT * FROM authorize_users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$sql)or die(mysqli_error());
    $num_row = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if( $num_row ==1 )
    {
        if($row['validation_status'] == "no" || $row['validation_status'] == "" ){
            //$output['data'][] creates a new entry in the array
            $output['output'][] = array("username"=> $username,"password"=>$password,"validation_status"=>"no");

        }else{
            //$output['data'][] creates a new entry in the array
            $output['output'][] = array("username"=> $username,"password"=>$password,"validation_status"=>"yes");

        }

    }else{
        //$output['data'][] creates a new entry in the array
        $output['output'][] = array("username"=> $username,"password"=>$password,"validation_status"=>"failed");

    }

}
if(isset($_GET['checkUser'])){

    $checkUser = trim($_GET['checkUser']);
    $sql = "SELECT * FROM authorize_users WHERE phone_number LIKE '%$checkUser'";
    $result = mysqli_query($conn,$sql)or die(mysqli_error());
    $num_row = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if( $num_row ==1 )
    {
        if($row['validation_status'] == "no" || $row['validation_status'] == "" ){
            //$output['data'][] creates a new entry in the array
            $output['output'][] = array("checkUser"=> $checkUser,"validation_status"=>"no");

        }else{
            //$output['data'][] creates a new entry in the array
            $output['output'][] = array("checkUser"=> $checkUser,"validation_status"=>"yes","authorize_users_id"=>$row['id']);

        }

    }else{
        //$output['data'][] creates a new entry in the array
        $output['output'][] = array("checkUser"=> $checkUser,"validation_status"=>"failed");

    }

}
if(isset($_GET['postingHeadline'])){

    $postingHeadline = $_GET['postingHeadline'];
    $validation_status = "yes";
    $stmt = $conn->prepare("INSERT INTO headline (title, validation_status ) VALUES (?,?)");
    $null = NULL;
    $stmt->bind_param("ss", $postingHeadline,$validation_status );
    $stmt->execute();
    $output['output'][] = array("Status"=> "Posted Successfully!");


}


///////////////////////////////////////////////////////***********************************************************/////////////////////////////////////////////////////////////////
/*
if(isset($_GET['news_categories'])){
	$sql = "SELECT * FROM news_categories";
	$result = $conn->query($sql);
while ( $row = $result->fetch_assoc() ){
	$news_category_id =  $row['id'];
	$news_category_title =  $row['title'];
	$news_category_description = $row['description'];
	$output['output'][] = array("id"=>$news_category_id,"title"=>$news_category_title,"description"=>$news_category_description);

}
}

if(isset($_GET['news'])){

    $news_category = $_GET['news_category'];

	  // NEWS QUERY
$sql = "SELECT * FROM news WHERE news_category='$news_category' ";
$result = $conn->query($sql);

    while ( $row = $result->fetch_assoc() )
	{
		$id =  $row['id'];
		$title =  $row['title'];
		$sub_title = $row['sub_title'];
		$description = $row['description'];
		$news_category = $row['news_category'];
		$page_information = $row['page_information'];
		$date_time = $row['date_time'];
		$authorize_user = $row['authorize_user'];
		$output['output'][] = array("id"=> $id,"title"=> $title,"sub_title"=>$sub_title,"description"=>$description,"news_category"=>$news_category,"page_information"=>$page_information,"date_time"=>$date_time,"authorize_user"=>$authorize_user);
	}
	
	// MEDIA QUERY


}
*/
///////////////////////////////////////////////////////***********************************************************/////////////////////////////////////////////////////////////////



header('Content-type: application/json');
//Should now output the desired json
echo json_encode( $output );

?>  