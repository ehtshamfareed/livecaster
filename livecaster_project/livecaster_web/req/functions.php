<?php
include 'db.php';
class NewsCategories
{
    public static $result;
    function get_news_categories_title($conn)
    {
        $sql = "SELECT * FROM news_categories";
        $result = $conn->query($sql);
        return $result;

    }
    function get_news_categories_title_by_id($conn,$id)
    {
        $sql = "SELECT title,id FROM news_categories Where id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            $row = $result->fetch_assoc();
            return $row["title"];
        }else
        {
            Redirection::redirecterror("There Is No Category Of ID:".$id);
        }
    }
    function get_news_categories_by_id($conn,$id)
    {
        $sql = "SELECT * FROM news_categories Where id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result;
        }else
        {
            Redirection::redirecterror("There Is No Category Of ID:".$id);
        }
    }
    function get_number_of_newscategories($conn)
    {
        $sql = "SELECT id FROM news_categories ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result->num_rows;
        }else
        {
           return 0;
        }
    }
}
class NewsHeadline
{
    public static $result;
    function get_news_headline($conn)
    {
        $sql = "SELECT * FROM headline order by id desc  limit 10";
        $result = $conn->query($sql);
        //if($result = $result -> fetch_assoc())
            return $result;
            // Redirection::redirecterror("Does't Exist Any News Belong to This Cagetories");
            //return $result;
    }
    function get_headline_id($conn,$id)
    {
        $sql = "SELECT * FROM headline where id = '$id'";
        $result = $conn->query($sql);
        return $result;
    }
}

class News
{
    public static $result;
    function get_all_news($conn)
    {
        $sql = "SELECT * FROM news order by id desc";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
    }
    function get_recent_news($conn,$limit)
    {
        $sql = "SELECT * FROM news order by id desc  limit ".$limit;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
    }
    function get_news_by_categories($conn,$condition,$limit)
    {
        $sql = "SELECT * FROM news where news_categories_id = '$condition' order by id DESC limit ".$limit;
        $result = $conn->query($sql);
        return $result;
    }
    //GET NUMBER OF NEWS
    function get_news_by_users_id($conn,$condition)
    {
        $sql = "SELECT * FROM news where authorize_users_id = '$condition'";
        $result = $conn->query($sql);

            return $result->num_rows;

    }
    function get_recent_news_expectfirst($conn,$limit)
    {
        $sql = "SELECT * FROM `news` WHERE id NOT IN (SELECT MAX(id) from news) ORDER BY id DESC limit ".$limit;;
        $result = $conn->query($sql);
        return $result;
    }
    function get_news_by_id($conn,$id)
    {
        $sql = "SELECT * FROM news WHERE id = ".$id;
        $result = $conn->query($sql);
        return $result;
    }
    function get_number_of_news($conn)
    {
        $sql = "SELECT id FROM news ";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result->num_rows;
        }else
        {
            return 0;
        }
    }
    function get_number_of_news_nonvalidated($conn)
    {
        $sql = "SELECT id FROM news Where validation_status = 'no'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result->num_rows;
        }else
        {
            return 0;
        }
    }
    function get_news_by_min($conn,$id)
    {
        $sql = "select id from news  where id < '$id'";
        $result = $conn->query($sql);
        //while($result = $result -> fetch_assoc())
        return $result;
    }
    function get_news_by_max($conn,$id)
    {
        $sql = "select id from news  where id > '$id'";
        $result = $conn->query($sql);
        return $result;
    }
    function search_by_title_description($conn,$condition)
    {
        $sql = "SELECT * FROM news Where title LIKE '%$condition%' OR description LIKE '%$condition%'";
        $result = $conn->query($sql);
        return $result;
    }

}
class Split {
    public static $result;
    function split_datetime($conn,$datetime)
    {
        $result = explode(" ",$datetime);
        return $result;
    }
}

class MediaTable{
    public static $result;
    //GET SINGLE IMAGE FOR THUBNAIL
    function get_recent_thumbnail($conn,$id)
    {

        $sql = "SELECT * FROM media_table WHERE news_id = '$id' order by id ASC limit 1";
        $result = $conn->query($sql);
        return $result;
    }
}
class Users{
    public static $result;
    function get_users($conn)
    {
        $sql = "SELECT * FROM authorize_users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result;
        }else
        {
            Redirection::redirecterror("Does't Exist Any Authorize User");
        }
    }
    function get_username_by_id($conn,$id)
    {
        $sql = "SELECT * FROM authorize_users WHERE id = '$id'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        }
    }
    function get_number_of_users($conn)
    {
        $sql = "SELECT id FROM authorize_users";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result->num_rows;
        }else
        {
            return 0;
        }
    }
    function get_number_of_users_nonvalidated($conn)
    {
        $sql = "SELECT id FROM authorize_users Where validation_status = 'no'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
        {
            return $result->num_rows;
        }else
        {
            return 0;
        }
    }
}
class Query{
    public static $result;
    function query($conn,$sql)
    {
        $result = $conn->query($sql);
        return $result;
    }

}
class Redirection
{
    public static $error;
    function redirecterror($error)
    {
        echo "Sorry Go Back!";
        $goback = '<script>setTimeout(function () {window.location.href = "../views/error404.php?error='.$error.'"; }, 1);</script>';
        echo $goback;
    }
}

class Controller {

    public function checkusername(){

        if(isset($_SESSION['username'])){
            return false;
        }else{
            return true;
        }
    }

    public function uploadvalidation($file)
    {
        if ($file == NULL) {

            echo "Upload Picture!";
            $goback = '<script>setTimeout(function () {window.location.href = "./"; }, 2000);</script>';
            echo $goback;

        }else{
                return file_get_contents($file);
            }
    }

    public function generateRandomString($length = 6) {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }
    function validation_username($conn,$username){

        $query = "SELECT * FROM authorize_users WHERE username='$username'";
        $result = mysqli_query($conn,$query)or die(mysqli_error());
        $num_row = mysqli_num_rows($result);
        $row=mysqli_fetch_array($result);
        if( $num_row > 0 )
            return null;
        else
            return $username;

    }
    function logout()
    {
        session_destroy();
        $goback = '<script>setTimeout(function () {
    window.location.href = "../"; }, 10);</script>';
        echo $goback;
    }
    function currentdatetime()
    {
        date_default_timezone_set('Asia/Karachi');
        $date = date('Y/m/d h:i:s', time());
        return $date;
    }
    function permissions()
    {
        switch ($_SESSION['permission'])
        {
            case "superadmin":
                return 2;
                break;
            case "admin":
                return 1;
                break;
            case "reporter":
                return 0;
                break;

        }
    }

}
/*
$result = NewsCategories::get_news_categories_title($conn);
while ($row = $result->fetch_assoc()) {
    echo $row["title"];
}

$result = NewsHeadline::get_news_headline($conn);
if(is_null($result = $result -> fetch_assoc()))
{
    echo "NULL";
}
else
{
    echo "NOT NULL";
}


$result = News::get_news_by_min($conn,74);
while($row = $result -> fetch_assoc())
    $final_result = $row['id'];

echo $final_result;



$result = News::get_news_by_max($conn,73);
$row = $result -> fetch_assoc();
    echo $final_result = $row['id'];


$result = Query::search_by_title_description($conn,"a");
while($row = $result->fetch_assoc())
    echo $row['title'];
*/


?>