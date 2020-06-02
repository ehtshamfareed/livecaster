<?PHP 
include "./req/controller.php";
  

?>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
<title><?php echo $_SESSION['title']; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="data:image;base64,<?php echo base64_encode( $_SESSION['icon']); ?>" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-brand" href="#">Navbar</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../">Home <span class="sr-only">(current)</span></a>
      </li>

      <?php if(controller::checkusername()){ ?>
      <li class="nav-item">
        
      <a class="nav-link" href="../signin.php">Sign In</a>

      </li>
      <li class="nav-item">
        
        <a class="nav-link" href="../signup.php">Sign Up</a>
  
        </li>
      <?php }else{ ?>
        <li class="nav-item">
        
      <a class="nav-link" href="panel.php">Panel</a>

      </li>

        <li class="nav-item">
        
        <a class="nav-link" href="panel.php?news_categories">News Categories</a>
  
        </li>

        <li class="nav-item">
        
        <a class="nav-link" href="panel.php?news">News</a>
  
        </li>

      <li class="nav-item">
        
        <a class="nav-link" href="panel.php?users">Users</a>
  
        </li>

      
      <li class="nav-item">

      
      </li>
    </ul>
    <a href="?logout" class="btn btn-danger">Logout</a>
    <?php } ?>
  </div>
</nav>


