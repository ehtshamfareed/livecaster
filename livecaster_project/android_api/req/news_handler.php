<?php
require "db.php";
session_start();

/*
///////////////////////////////////////PAGE INFORMATION BLOCK START///////////////////////////////////////////////
//Add Pages's Information Back end
if(isset($_POST['add_page']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $stmt = $conn->prepare("INSERT INTO page_information (title, description) VALUES ('$title', '$description')");
    $stmt->execute();
    

    echo "Record Inserted!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?page_information"; }, 1500);</script>';
               echo $goback;
}

//DELETE Pages's Information Back end
if(isset($_POST['delete_page_information'])){
    $pid = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM page_information WHERE id = '$pid' ");
    $stmt->execute();
    echo "Record Deleted!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?page_information"; }, 1500);</script>';
               echo $goback;

  }


  //UPDATE Pages's Information Back end
  if(isset($_POST['update_page_information'])){

    $pid = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE page_information SET title = '$title',description = '$description'where id ='$pid'");
    $stmt->execute();
    echo "Record Updated!";
    $goback = '<script>setTimeout(function () {
     window.location.href = "../panel.php?page_information"; }, 1500);</script>';
    echo $goback;
  }
///////////////////////////////////////PAGE INFORMATION BLOCK END///////////////////////////////////////////////
*/










///////////////////////////////////////NEWS CATEGORIES BLOCK START///////////////////////////////////////////////
//Add NEWS CATEGORIES Back end
if(isset($_POST['add_news_categories']))

{
	$image = $_FILES['icon']['tmp_name'];
    $title = $_POST['title'];
    $description = $_POST['description'];
	$stmt = $conn->prepare("INSERT INTO news_categories (title, description, icon ) VALUES ('$title','$description',?)");
    $null = NULL;
    $stmt->bind_param("b", $null );
    $stmt->send_long_data(0, file_get_contents($image));
    $stmt->execute();
    

    echo "Record Inserted!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?news_categories"; }, 1500);</script>';
               echo $goback;
}

//DELETE NEWS CATEGORIES Back end
if(isset($_POST['delete_news_categories'])){
    $nid = $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM news_categories WHERE id = '$nid' ");
    $stmt->execute();
    echo "Record Deleted!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?news_categories"; }, 1500);</script>';
               echo $goback;

  }

  //UPDATE  NEWS CATEGORIES Back end
  if(isset($_POST['update_news_categories'])){

    $nid = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];

    $stmt = $conn->prepare("UPDATE news_categories SET title = '$title',description = '$description'where id ='$nid'");
    $stmt->execute();
    echo "Record Updated!";
    $goback = '<script>setTimeout(function () {
     window.location.href = "../panel.php?news_categories"; }, 1500);</script>';
    echo $goback;
  }
  ///////////////////////////////////////NEWS CATEGORIES BLOCK END///////////////////////////////////////////////

    ///////////////////////////////////////ADD NEWS BLOCK START///////////////////////////////////////////////
//Add NEWS CATEGORIES Back end
if(isset($_POST['add_news']))
{
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $description = $_POST['description'];
    $news_category = $_POST['news_category'];
    //$page_information = $_POST['page_information'];
    $authorize_user = $_SESSION['username'];
    //$main_picture = file_get_contents($_FILES['image']['tmp_name']);
    
    $stmt = $conn->prepare("INSERT INTO news (title, sub_title, description, news_categories_id, authorize_users_id) VALUES ('".$title."','".$sub_title."','".$description."','".$news_category."','".$authorize_user."')");
    //$null = NULL;
    //$stmt->bind_param("b", $null );
    //$stmt->send_long_data(0, file_get_contents($_FILES['image']['tmp_name']));
    $stmt->execute();

    $last_id = mysqli_insert_id($conn);
    //MULTIPLE FILE UPLOADING TO RELATIONAL DATABASE
          // Checks if user sent an empty form  
    if(!empty(array_filter($_FILES['files']['name']))) { 
           
      //THESE COMMENTS FOR LATER USE OF ADVANCE VERISION
      //$allowed_types = array('jpg', 'png', 'jpeg', 'gif', 'mp4', 'avi', 'flv', 'wmv', 'mov');  
      //Define maxsize for files i.e 20MB 
     //$maxsize = 20 * 1024 * 1024;  
            // Loop through each file in files[] array 
            foreach ($_FILES['files']['tmp_name'] as $key => $value) { 
                  
                $file_tmpname = $_FILES['files']['tmp_name'][$key]; 
                $file_name = $_FILES['files']['name'][$key]; 
                $file_size = $_FILES['files']['size'][$key]; 
                $file_type = $_FILES['files']['type'][$key]; 
      
                  // now uploading files in relational table
                  $file_data = file_get_contents($file_tmpname);
                  $stmt = $conn->prepare("INSERT INTO media_table (media_data, news_id, media_name, media_type, media_size ) VALUES (?, '$last_id', '$file_name', '$file_type', '$file_size') ");
                  $null = NULL;
                  $stmt->bind_param("b", $null );
                  $stmt->send_long_data(0, $file_data);
                  $stmt->execute();
                  
                }

            }else { 
            // If no files selected 
            echo "No files selected."; 
                  }
                  echo "Record Inserted!";$goback = '<script>setTimeout(function () {window.location.href = "../panel.php?news"; }, 1500);</script>';echo $goback; 
}

   

//FUNCTION OF FIXIES ARRY OF IMAGES OR FILES


    ///////////////////////////////////////ADD NEWS BLOCK END///////////////////////////////////////////////

    ///////////////////////////////////////DELETE NEWS+MEDIA BLOCK START///////////////////////////////////////////////
    if(isset($_POST['delete_news']))
    {
    $nid = $_GET['newsf_id'];
    $stmt = $conn->prepare("DELETE FROM news WHERE id = '$nid' ");
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM media_table WHERE news_id = '$nid' ");
    $stmt->execute();
    echo "Record Deleted!";
               $goback = '<script>setTimeout(function () {
                window.location.href = "../panel.php?news"; }, 1500);</script>';
               echo $goback;

    }
    ///////////////////////////////////////DELETE NEWS+MEDIA BLOCK START///////////////////////////////////////////////
?>