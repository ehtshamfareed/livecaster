<?php
session_start();
if(isset($_SESSION['username'])){}else{header("Location: ../signin.php");}
include "templates/header.php";
include "req/db.php";

///////////////////////////////////////USERS LOGOUT  BLOCK START///////////////////////////////////////////////

if(isset($_GET['logout']))
{
    session_destroy();
    $goback = '<script>setTimeout(function () {
    window.location.href = "../"; }, 100);</script>';
   echo $goback;
}
///////////////////////////////////////USERS LOGOUT  BLOCK START///////////////////////////////////////////////


///////////////////////////////////////USERS  BLOCK START///////////////////////////////////////////////
if(isset($_GET['adduser']))
    {
        include "templates/signup_form.php";
    }

//addusers FROM GET REQUEST
if(isset($_GET['users']))
{
    // SHOW USERS FROM DATABASE
    ?>
    <!--<a class="btn btn-primary" href="?adduser" role="button">Add User</a>-->
    <a class="btn btn-primary" href="../signup.php" role="button">Add User</a>


    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Username</th>
      <th scope="col">Email</th>
      <th scope="col">Password</th>
      <th scope="col">Phone_number</th>
      <th scope="col">user_category</th>
      <th scope="col">address</th>
      <th scope="col">Profile_picture</th>
      <th scope="col">Validation_code</th>
      <th scope="col">Validation_status</th>
      <th scope="col">Register_date</th>
      <th scope="col">Login_date</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    

<?php 
    $sql = "SELECT * FROM authorize_users";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
      ?>
        
        
        <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['username']; ?></td>
      <td><?php echo $row['email']; ?></td>
      <td><?php echo $row['password']; ?></td>
      <td><?php echo $row['phone_number']; ?></td>
      <td><?php echo $row['user_category']; ?></td>
      <td><?php echo $row['address']; ?></td>
      <td> <a href="data:image/png;base64,<?php echo base64_encode($row['profile_picture']); ?>" download>Download</a></td>
      <td><?php echo $row['validation_code']; ?></td>
      <td><?php echo $row['validation_status']; ?></td>
      <td><?php echo $row['register_date']; ?></td>
      <td><?php echo $row['login_date']; ?></td>
      <td><a href="panel.php?userid=<?php echo $row['id']; ?>" >X</a></td>
        </tr>
<?php
    }//HERE LOOP END

} 

?>

    
  </tbody>
</table>
    
    
    
    <?PHP
}//HERE USERS 

//USERS UPDATE AND DELETE HERE
if(isset($_GET['userid'])){
    $userid = $_GET['userid'];
    $sql = "SELECT * FROM authorize_users WHERE id = '$userid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    ?>
    <form method="post" action="req/user_handler.php?id=<?php echo $row['id']; ?>" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="">Username</label>
    <input name ="username" type="text" class="form-control" value="<?php echo $row['username']; ?>" required>
  </div>

  <div class="form-group">
    <label for="">Password</label>
    <input name ="password" type="password" class="form-control" value="<?php echo $row['password']; ?>" required>
  </div>

  <div class="form-group">
  <label for="exampleInputEmail1">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $row['email']; ?>" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

 <div class="form-group">
    <label for="">Phone Number</label>
    <input name ="phone_number" type="text" class="form-control"   value="<?php echo $row['phone_number']; ?>" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"  required><?php echo $row['address']; ?></textarea >
  </div>

  <div class="form-group">
<img src="data:image/png;base64,<?php echo base64_encode($row['profile_picture']); ?>" height="100px" width="100px" />
  </div>

  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Validation_status</label>
  </div>
  <select name = "validation_status" class="custom-select" id="inputGroupSelect01">
    <option value="no" <?php if($row['validation_status'] == "no" or $row['validation_status'] == "" )echo "selected"; ?>>no</option>
    <option value="yes" <?php if($row['validation_status'] == "yes")echo "selected"; ?>>yes</option>
  </select>
</div>


  </div>

  <button name="update" type="submit" class="btn btn-primary">Update</button><button name="delete" type="submit" class="btn btn-primary">Delete</button><br>
    </form>



    <?php
    
    


}
///////////////////////////////////////USERS  BLOCK END///////////////////////////////////////////////












///////////////////////////////////////NEWS CATEGORIES BLOCK START///////////////////////////////////////////////

//SHOW ALL NEWS CATEGORY

if(isset($_GET['news_categories']))
{
    ?>
    <a class="btn btn-primary" href="?add_news_categories" role="button">Add News Categories</a>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
	  <th scope="col">Icon</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    

<?php 
    $sql = "SELECT * FROM news_categories";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
      ?>
        
        
        <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['description']; ?></td>
	  <td> <a href="data:image/png;base64,<?php echo base64_encode($row['icon']); ?>" download>Download</a></td>
      <td><a href="panel.php?news_categories_id=<?php echo $row['id']; ?>&title=<?php echo $row['title']; ?>&description=<?php echo $row['description']; ?>" >X</a></td>
        </tr>
<?php
    }//HERE LOOP END

} 

?>

    
  </tbody>
</table>
    


<?php

}



//Add Pages's Information Front End

if(isset($_GET['add_news_categories']))
{
    ?>
<form method="post" action="req/news_handler.php" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="">Title</label>
    <input name ="title" type="text" class="form-control" id="" aria-describedby="" required>
    
  </div>
  <div class="form-group">
    <label for="">Description</label>
    <input name ="description" type="text" class="form-control" id="" required>
  </div>
   <div class="form-group">
    <label for="exampleFormControlFile1">Choose your image</label>
    <input name="icon" type="file" class="form-control-file">
  </div>
  <button name="add_news_categories" type="submit" class="btn btn-primary">Add News Categories</button><br>
 
</form>

    <?php

}







//Add News Front end
//UPDATE OR DELETE RECORDS
if(isset($_GET['news_categories_id'])){
    ?>
    <script src="js/functions.js"></script>
    <form method="post" onsubmit="ValidateSize()" action="req/news_handler.php" >
    <div class="form-group">
    <label for="">ID</label>
    <input name ="id" type="text" class="form-control" id="" aria-describedby="" value="<?php echo $_GET['news_categories_id']; ?>" required>
    
  </div>
    <div class="form-group">
    <label for="">Title</label>
    <input name ="title" type="text" class="form-control" id="" aria-describedby="" value="<?php echo $_GET['title']; ?>" required>
    
  </div>
  <div class="form-group">
    <label for="">Description</label>
    <input name ="description" type="text" class="form-control" id="" value="<?php echo $_GET['description']; ?>" required>
  </div>
    <div class="form-group">
    <label for="exampleFormControlFile1">Choose your image</label>
    <input name="icon" type="file" class="form-control-file">
  </div>
  <button name="update_news_categories" type="submit" class="btn btn-primary">Update News Category</button>
  <button name="delete_news_categories" type="submit" class="btn btn-primary">Delete News Category</button><br>
 
</form>

    
    <?php
    }
///////////////////////////////////////NEWS CATEGORIES BLOCK END///////////////////////////////////////////////











///////////////////////////////////////ADD NEWS ENTRY BLOCK START///////////////////////////////////////////////


//SHOW ALL NEWS CATEGORY

if(isset($_GET['news']))
{
    ?>
    <a class="btn btn-primary" href="?add_news" role="button">Add News</a>

    <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Sub Title</th>
      <th scope="col">Description</th>
      <th scope="col">News Category</th>
      <th scope="col">Date and Time</th>
      <th scope="col">Authorize User</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    

<?php 
    $sql = "SELECT * FROM news";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  
    // output data of each row
    while($row = $result->fetch_assoc()) {
        //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
      ?>
        
        
        <tr>
      <th scope="row"><?php echo $row['id']; ?></th>
      <td><?php echo $row['title']; ?></td>
      <td><?php echo $row['sub_title']; ?></td>
      <td><?php echo $row['description']; ?></td>
      <td><?php echo $row['news_categories_id']; ?></td>
            <!--
      <td><?php echo $row['page_information']; ?></td>
      <td> <a href="data:image/png;base64,<?php echo base64_encode($row['image']); ?>" download>Download</a></td>
            -->
      <td><?php echo $row['date_time']; ?></td>
      <td><?php echo $row['authorize_users_id']; ?></td>
      <td><a href="panel.php?news_id=<?php echo $row['id']; ?>" >X</a></td>
        </tr>
<?php
    }//HERE LOOP END

} 

?>
    
  </tbody>
</table>

<?php

}


//Add News Front End

if(isset($_GET['add_news']))
{
    ?>
<form method="post" action="req/news_handler.php" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="">Title</label>
    <input name ="title" type="text" class="form-control" id="" aria-describedby="" required>
    
  </div>

  <div class="form-group">
    <label for="">Sub Title</label>
    <input name ="sub_title" type="text" class="form-control" id="" aria-describedby="" required>
    
  </div>
  
  <div class="form-group">
    <label for="">Description</label>
    <input name ="description" type="text" class="form-control" id="" required>
  </div>

<?php
// GET ALL CATEGORIES FORM DATABASE
  $news_categories = "SELECT * FROM news_categories";
$result = $conn->query($news_categories);

if ($result->num_rows > 0) {
  
    
        ?>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">News Category</label>
  </div>
  <select name = "news_category" class="custom-select" id="inputGroupSelect01">
    <option value="no" selected>Choose One</option>
    <?php 
    // output data of each row
        while($row = $result->fetch_assoc()) {
    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
    ?>
    <option value="<?php echo $row['id']; ?>" ><?php echo $row['title']; ?></option>
        <?php } ?>
  </select>
</div>

<?php  
}
?>

<!--
  #################OLD UL####################
  <div class="form-group">
    <label for="exampleFormControlFile1">Choose your image</label>
    <input name="image" type="file" class="form-control-file">
  </div>
-->
<div class="form-group" id="files">
    <label for="exampleFormControlFile1">Choose your file</label>
    <input name="files[]" id="image" type="file"  multiple="multiple" accept="image/*, video/*" class="form-control-file" >
  </div>
  <script>
  $("#image").on("change", function() {
    if ($("#image")[0].files.length > 5) {
        alert("You can select only 5 images");
        document.getElementById("image").value = "";
    } else {}});


  </script>

  <div class="form-group" style="visibility: hidden;">
    <label for="">Authorize User</label>
    <input name ="user" type="text" class="form-control" id="" value="<?php echo $_SESSION['username_id']; ?>" required disabled>
  </div>

  <button name="add_news" type="submit" class="btn btn-primary">Add News</button><br>

</form>

    <?php

}



//UPDATE OR DELETE News Front End//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End
//UPDATE OR DELETE News Front End


if(isset($_GET['news_id']))
{
  $g_id = $_GET['news_id'];
    $news = "SELECT * FROM news where id='$g_id'";
    $result2 = $conn->query($news);
    
    if ($result2->num_rows > 0) {
        while($row2 = $result2->fetch_assoc()) {
        $n_id = $row2['id'];
        $n_title =  $row2['title'];
        $n_sub_title =  $row2['sub_title'];
        $n_description = $row2['description'];
        $n_new_category = $row2['news_category'];
        $n_page_information = $row2['page_information'];
        $n_image = $row2['image'];
        

    }

}


    ?>
<form method="post" action="req/news_handler.php?newsf_id=<?php echo $n_id; ?>" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="">Title</label>
    <input name ="title" type="text" class="form-control" id="" aria-describedby="" value='<?php echo $n_title; ?>' required>
    
  </div>

  <div class="form-group">
    <label for="">Sub Title</label>
    <input name ="sub_title" type="text" class="form-control" id="" aria-describedby="" value='<?php echo $n_sub_title; ?>' required>
    
  </div>
  
  <div class="form-group">
    <label for="">Description</label>
    <input name ="description" type="text" class="form-control" id="" value='<?php echo $n_description; ?>' required>
  </div>

<?php
// GET ALL CATEGORIES FORM DATABASE
$news_categories = "SELECT title FROM news_categories";
$result = $conn->query($news_categories);

if ($result->num_rows > 0) {
  
    
        ?>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">News Category</label>
  </div>
  <select name = "news_category" class="custom-select" id="inputGroupSelect01">
    <option value="no" selected>Choose One</option>
    <?php 
    // output data of each row
        while($row = $result->fetch_assoc()) {
    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
    ?>
    <option value="<?php echo $row['title']; ?>" <?php if($row['title'] == $n_new_category )echo "selected"; ?>><?php echo $row['title']; ?></option>
        <?php } ?>
  </select>
</div>

<?php  
}
?>


<?php
// GET ALL CATEGORIES FORM DATABASE
  $page_information = "SELECT title FROM page_information";
$result1 = $conn->query($page_information);

if ($result1->num_rows > 0) {
  
    
        ?>
  <div class="input-group mb-3">
  <div class="input-group-prepend">
    <label class="input-group-text" for="inputGroupSelect01">Page Information</label>
  </div>
  <select name = "page_information" class="custom-select" id="inputGroupSelect01">
    <option value="no" selected>Choose One</option>
    <?php 
    // output data of each row
        while($row1 = $result1->fetch_assoc()) {
    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
    ?>
    <option value="<?php echo $row1['title']; ?>" <?php if($row1['title'] == $n_page_information )echo "selected"; ?>><?php echo $row1['title']; ?></option>
        <?php } ?>
  </select>
</div>

<?php  
}
?>
    <div class="form-group">
    <img src="data:image/png;base64,<?php echo base64_encode($n_image); ?>" height="100px" width="100px" />
  </div>

  <div class="form-group">
    <label for="exampleFormControlFile1">Choose your image</label>
    <input name="image" type="file" class="form-control-file">
  </div>


  <div class="form-group" style="visibility: hidden;">
    <label for="">Authorize User</label>
    <input name ="user" type="text" class="form-control" id="" value="<?php echo $_SESSION['username']; ?>" required>
  </div>

  <button name="update_news" type="submit" class="btn btn-primary">Update News</button><button name="delete_news" type="submit" class="btn btn-primary">Delete News</button><br>
 
</form>

    <?php

}



/////////////////////////////////////// NEWS ENTRY BLOCK END///////////////////////////////////////////////











?>