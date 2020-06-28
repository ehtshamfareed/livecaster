<?php
include_once '../req/setting.php';
if(isset($_SESSION['username']))
{
    $userlogin = Users::get_username_by_id($conn,$_SESSION['username_id']);
    $userdetail = $userlogin -> fetch_assoc();
}else{header("Location: ../login.php");}

if(isset($_GET['logout']))
{
    Controller::logout();
}
if(isset($_POST['delete_news']))
{
    $nid =  $_POST['news_id'];
    $stmt = $conn->prepare("DELETE FROM news WHERE id = '$nid' ");
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM media_table WHERE news_id = '$nid' ");
    $stmt->execute();


    $stmt = $conn->prepare("DELETE FROM news WHERE id = '$nid' ");
    if($stmt->execute())
    {
        $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
        echo $goback;

    }else
    {
        $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
        echo $goback;
    }

    $stmt = $conn->prepare("DELETE FROM media_table WHERE news_id = '$nid' ");
    if($stmt->execute())
    {
        $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
        echo $goback;
    }else
    {
        $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
        echo $goback;
    }

    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
    echo $goback;

}

if(isset($_POST['update_news']))
{
    $nid =  $_POST['news_id'];
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $description = $_POST['description'];
    $news_category = $_POST['news_category'];
    $authorize_user = $_SESSION['username_id'];
    $approvel = $_POST['validation_status'];
    $stmt = $conn->prepare("UPDATE news SET title = ?, sub_title =? , description = ?, news_categories_id = ?, authorize_users_id = ?, validation_status = ?, date_time = ? WHERE id = '$nid'");
    $datetime = Controller::currentdatetime();
    $stmt->bind_param("sssssss", $title,$sub_title, $description, $news_category, $authorize_user, $approvel, $datetime);
    $stmt->execute();

    if(isset($_POST['update_media'])){
        $stmt = $conn->prepare("DELETE FROM media_table WHERE news_id = '$nid' ");
        $stmt->execute();


    $last_id = $nid;
    if(!empty(array_filter($_FILES['files']['name']))) {
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

    }
    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
    echo $goback;

}

if(isset($_POST['post_news']))
{
    $title = $_POST['title'];
    $sub_title = $_POST['sub_title'];
    $description = $_POST['description'];
    $news_category = $_POST['news_category'];
    //$page_information = $_POST['page_information'];
    $authorize_user = $_SESSION['username_id'];
    //$main_picture = file_get_contents($_FILES['image']['tmp_name']);
    $approvel = $_POST['validation_status'];
    $stmt = $conn->prepare("INSERT INTO news (title, sub_title, description, news_categories_id, authorize_users_id,validation_status) VALUES (?,?,?,'".$news_category."','".$authorize_user."','".$approvel."')");
    //$null = NULL;
    $stmt->bind_param("sss", $title,$sub_title,$description );
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
    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news"; }, 1);</script>';
    echo $goback;
}

if(isset($_POST['post_news_categories']))
{
    $title = $_POST['title'];
    $description = $_POST['description'];
    $image = Controller::uploadvalidation($_FILES['icon']['tmp_name']);
    $stmt = $conn->prepare("INSERT INTO news_categories (title, description, icon) VALUES (?,?,?)");
    $null = NULL;
    $stmt->bind_param("ssb", $title,$description, $null );
    $stmt->send_long_data(2, file_get_contents($_FILES['icon']['tmp_name']));
    $stmt->execute();
    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news_categories"; }, 1);</script>';
    echo $goback;

}
if(isset($_POST['delete_news_categories']))
{
    $nid =  $_POST['news_categories_id'];
    $sql = "DELETE FROM media_table WHERE news_id IN (SELECT id FROM news WHERE news_categories_id = '$nid');";
    $sql .= "DELETE FROM news WHERE news_categories_id IN (SELECT id FROM news_categories WHERE news_categories_id = '$nid');";
    $sql .= "DELETE FROM news_categories WHERE id = '$nid';";
    $stmt = $conn->multi_query($sql);
    if ($conn->multi_query($sql)) {
        echo "Multi query failed: (" . $conn->errno . ") " . $conn->error;
    }
    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news_categories"; }, 1);</script>';
    echo $goback;

}
if(isset($_POST['update_news_categories']))
{
    $nid =  $_POST['news_categories_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $file_tmpname = $_FILES['icon']['tmp_name'];
    if(isset($_POST['update_media']))
    {
        $stmt = $conn->prepare("UPDATE news_categories SET title = ?, description = ?, icon = ? where id = '$nid'");
        $stmt->bind_param("ssb", $title,$description, $null );
        $stmt->send_long_data(2, file_get_contents($file_tmpname));
        $stmt->execute();
    }else
    {
        $stmt = $conn->prepare("UPDATE news_categories SET title = ?, description = ? where id = '$nid'");
        $stmt->bind_param("ss", $title,$description);
        $stmt->execute();
    }
    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?news_categories"; }, 1);</script>';
    echo $goback;

}
if(isset($_POST['insert_user']))
{
    $username = $_POST['username'];
    $validation_username = Controller::validation_username($conn,$username);
    if($validation_username == null){
        echo "UserName Already Registered!";
        $goback = '<script>setTimeout(function () {
                window.location.href = "../login.php?register"; }, 1500);</script>';
        echo $goback;
    }else{
        $password = $_POST['password'];
        $email = $_POST['email'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];

        $image = Controller::uploadvalidation($_FILES['image']['tmp_name']);
        $validation_code =  Controller::generateRandomString();
        $permission = $_POST['permission'];
        $approvel = $_POST['validation_status'];
        $stmt = $conn->prepare("INSERT INTO authorize_users (username, password, email, phone_number, address, profile_picture, validation_code, validation_status, user_category) VALUES (?,?,?,?,?,?,'$validation_code','$approvel','$permission')");
        $null = NULL;
        $stmt->bind_param("sssssb", $username, $password, $email, $phone_number, $address, $null);
        //$stmt->send_long_data(5, file_get_contents($image));
        $stmt->send_long_data(5, file_get_contents($_FILES['image']['tmp_name']));
        $stmt->execute();
        echo "Sign In!";
        $goback = '<script>setTimeout(function () {
                window.location.href = "../admin/?users"; }, 10);</script>';
        echo $goback;
    }


}
if(isset($_POST['update_user']))
{
    $nid =  $_POST['user_id'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $phone_number = $_POST['phone_number'];
    $permission = $_POST['permission'];
    $approvel = $_POST['validation_status'];
    $authorize_user = $_SESSION['username_id'];
    $validation_code =  Controller::generateRandomString();

    $stmt = $conn->prepare("UPDATE authorize_users SET `username` = ?, `email` = ?, `password` = ?, `phone_number` = ?, `user_category` = ?, `address` = ?, `validation_code` = ?, `validation_status` = ? WHERE id = '$nid'");
    $stmt->bind_param("ssssssss", $username,$email, $password, $phone_number, $permission, $address,  $validation_code, $approvel );
    $stmt->execute();

    if(isset($_POST['update_media'])){

        $last_id = $nid;
        if(!empty($_FILES['image']['name'])) {
                // now uploading files in relational table
                $file_data = file_get_contents($_FILES['image']['tmp_name']);
                $stmt = $conn->prepare("UPDATE authorize_users  SET profile_picture = ? where id = '$last_id'");
                $null = NULL;
                $stmt->bind_param("b", $null );
                $stmt->send_long_data(0, $file_data);
                $stmt->execute();
        }else {
            // If no files selected
            echo "No files selected.";
        }

    }
    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?users"; }, 1);</script>';
    echo $goback;

}


if(isset($_POST['delete_user']))
{
    $nid =  $_POST['user_id'];
    if(News::get_news_by_users_id($conn,$nid) > 0)
    {
        $sql0 = "DELETE FROM media_table WHERE news_id IN (SELECT id FROM news WHERE authorize_users_id = '$nid');";
        $sql1 = "DELETE FROM news WHERE authorize_users_id = '$nid';";
        $stmt = $conn->query($sql0);
        $stmt = $conn->query($sql1);
    }
    $sql = "DELETE FROM authorize_users WHERE id = '$nid';";
    $stmt = $conn->query($sql);

    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?users"; }, 100);</script>';
    echo $goback;

}
if(isset($_POST['insert_newsheadline']))
{
    $sql = "INSERT  INTO headline (title,validation_status) VALUES (?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['title'],$_POST['validation_status'] );
    $stmt->execute();

    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?headline"; }, 100);</script>';
    echo $goback;

}
if(isset($_POST['update_newsheadline']))
{
    $nid = $_POST['headline_id'];
    $sql = "UPDATE headline SET  title = ?,validation_status = ? WHERE id = '$nid'";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $_POST['title'],$_POST['validation_status'] );
    $stmt->execute();

    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?headline"; }, 100);</script>';
    echo $goback;

}
if(isset($_POST['delete_newsheadline']))
{
    $nid = $_POST['headline_id'];
    $sql = "DELETE FROM headline  WHERE id = '$nid' ";
    $stmt = $conn->query($sql);

    $goback = '<script>setTimeout(function () {window.location.href = "../admin/?headline"; }, 100);</script>';
    echo $goback;

}

include "views/main.php";

?>