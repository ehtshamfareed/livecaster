
<script type="text/javascript" src="./js/functions.js">
</script>
<form method="post" action="req/login-register.php" enctype="multipart/form-data" >
  <div class="form-group">
    <label for="">Username</label>
    <input name ="username" type="text" class="form-control" id="username" required>
    <label id="usernamestatus"></label>
  </div>

  <div class="form-group">
    <label for="">Password</label>
    <input name ="password" type="password" class="form-control" id="" required>
  </div>

  <div class="form-group">
  <label for="exampleInputEmail1">Email address</label>
    <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" required>
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

 <div class="form-group">
    <label for="">Phone Number</label>
    <input name ="phone_number" type="text" class="form-control" id="" aria-describedby="" required>
  </div>
  <div class="form-group">
    <label for="exampleFormControlTextarea1">Address</label>
    <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3" required></textarea >
  </div>

<script type="text/javascript" src="../js/functions.js">
 
</script>

  <div class="form-group">
    <label for="exampleFormControlFile1">Choose your image</label>

    <input name="image" id="file" type="file" 

    onchange = 

    "var FileSize = this.files[0].size / 1024 / 1024;if (FileSize > 1){alert('too big file!');this.value=null;}" 

    class="form-control-file">

  </div>
<?php if(isset($_SESSION['username'])){ 
  //FOR USER APPOR0VEL 
  ?>
  <div class="form-group form-check">
    <input name="authentication" type="checkbox" class="form-check-input" id="exampleCheck1" value="authentication" >
    <label class="form-check-label" for="exampleCheck1" >Approvel</label>
  </div>
<?php } ?>
  <button name="register" type="submit" class="btn btn-primary">Register</button><br>
  <?php if(!isset($_SESSION['username'])){ ?> 
 <span> Don’t have a BBC account?
<a href="signup.php" >Register now</a></span>
<?php } ?>
</form>

