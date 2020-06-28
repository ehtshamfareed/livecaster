<?php
include './req/setting.php';
if(isset($_SESSION['username'])){header("Location: ../admin/");}else{}
/*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*/
if(isset($_POST['signin'])){

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM authorize_users WHERE username = '$username' and password = '$password'";
    $result = mysqli_query($conn,$sql)or die(mysqli_error());
    $num_row = mysqli_num_rows($result);
    $row=mysqli_fetch_array($result);
    if( $num_row ==1 )
    {
        $datetime = Controller::currentdatetime();
        $sql = "UPDATE authorize_users SET  login_date = ? WHERE id = ".$row['id'];
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $datetime);
        $stmt->execute();

        if($row['validation_status'] == "no" || $row['validation_status'] == "" ){
            echo "Pending for approvel!";

            $goback = '<script>setTimeout(function () {
                window.location.href = "../"; }, 2000);</script>';
            echo $goback;
        }else{
            $_SESSION['username']=$row['username'];
            $_SESSION['username_id']=$row['id'];
            $_SESSION['permission']=$row['user_category'];
            header("Location: ../admin/");
        }

    }else{
        $goback = '<script>setTimeout(function () {
                window.location.href = "../login.php"; }, 10);</script>';
        echo $goback;

    }

}
/*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*/

if(isset($_POST['register'])){

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
        if(isset($_POST['validation_status'])){$approvel = "yes";}else{$approvel = "no";}
        $validation_code =  Controller::generateRandomString();

        $stmt = $conn->prepare("INSERT INTO authorize_users (username, password, email, phone_number, address, profile_picture,validation_code,validation_status ) VALUES (?,?,?,?,?,?,?,?)");
        $null = NULL;
        $stmt->bind_param("sssssbss", $username, $password, $email, $phone_number, $address, $null, $validation_code, $approvel );
        //$stmt->send_long_data(5, file_get_contents($image));
        $stmt->send_long_data(5, file_get_contents($_FILES['image']['tmp_name']));
        $stmt->execute();
        echo "Sign In!";
        $goback = '<script>setTimeout(function () {
                window.location.href = "../login.php"; }, 1800);</script>';
            echo $goback;
        }

}
/*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*//*SIGN IN*/
?>
<link href="css/login.css" rel="stylesheet">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title><?php echo $_SESSION['title']; ?></title>

    <!-- Favicon -->

    <link rel="shortcut icon" type="image/x-icon" href="data:image;base64,<?php echo base64_encode( $_SESSION['icon']); ?>" />

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<?php
if(!isset($_GET['register'])) {
    ?>

    <div class="wrapper fadeInDown">
        <div id="formContent">
            <!-- Tabs Titles -->

            <!-- Icon -->
            <div class="fadeIn first">
                <a href="../index.php">
                    <?php echo '<h2 ><img style="margin-right: 20px" width="8%" height="8%" id="icon" src="data:image/ico;base64,' . base64_encode($_SESSION['icon']) . '"/>';
                    echo "<br>" . $_SESSION['header'] . "</h2>"; ?>
                </a>
            </div>

            <!-- Login Form -->
            <form method="post" action="login.php" enctype="multipart/form-data" >
                <input type="text" id="login" class="fadeIn second" name="username" placeholder="username">
                <input type="text" id="password" class="fadeIn third" name="password" placeholder="password">
                <input type="submit" class="fadeIn fourth" name="signin" value="Log In">
            </form>

            <!-- Remind Passowrd -->
            <div id="formFooter">
                <a class="underlineHover" href="../">Go to the Site</a>
            </div>

        </div>
    </div>

    <?php
}else{
?>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->

        <!-- Icon -->
        <div class="fadeIn first">
            <a href="../index.php">
                <?php echo '<h2 ><img style="margin-right: 20px" width="8%" height="8%" id="icon" src="data:image/ico;base64,'.base64_encode( $_SESSION['icon'] ).'"/>'; echo "<br>".$_SESSION['header']."</h2>"; ?>
            </a>
        </div>

        <!-- Login Form -->
        <form method="post" action="login.php" enctype="multipart/form-data" >
            <input type="text" id="register" class="fadeIn second" name="username" placeholder="username">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="password">
            <input type="email" id="email" class="fadeIn third" name="email" placeholder="email">
            <input type="tel" id="phone_no" class="fadeIn fourth" name="phone_number" placeholder="phone no">
            <input type="text" id="address" class="fadeIn third"  rows="3" name="address" required placeholder="Address">
            <input name="image" id="file" type="file"

                   onchange =

                   "var FileSize = this.files[0].size / 1024 / 1024;if (FileSize > 1){alert('too big file!');this.value=null;}"

                   class="fadeIn fourth">
            <input type="submit" class="fadeIn fourth" name="register" value="Register">
        </form>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="../">Go to the Site</a>
        </div>

    </div>
</div>
<?php } ?>