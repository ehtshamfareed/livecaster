<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Title -->
    <title><?php echo $_SESSION['title']; ?></title>

    <!-- Favicon -->

    <link rel="shortcut icon" type="image/x-icon" href="data:image;base64,<?php echo base64_encode( $_SESSION['icon']); ?>" />

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../">
            <div class="sidebar-brand-icon rotate-n-15">

            </div>
            <div class="sidebar-brand-text mx-3">LIVE CASTER <sup>NEWS</sup></div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item active">
            <a class="nav-link" href="../admin/">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Home</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>News</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">News Management</h6>
                    <a class="collapse-item" href="?news">News</a>
                    <?PHP if(Controller::permissions() > 0){ ?>
                    <a class="collapse-item" href="?news_categories">News Categories</a>
                    <?PHP } ?>
                    <a class="collapse-item" href="?headline">News Headline</a>
                </div>
            </div>
        </li>

        <?PHP
        if(Controller::permissions() > 0){ ?>
        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Utilities</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="?users">Users</a>
                </div>
            </div>
        </li>
        <?PHP } ?>
        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>


                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $userdetail['username']; ?></span>
                          <!--  <img src="../img/login.png" class="rounded-circle" alt="Cinque Terre" width="60" height="60"> -->
                            <img height="60px" width="60px" class="img-profile rounded-circle" src="../img/login.png">
                            <?php //echo $userdetail['profile_picture']; ?>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="?logout" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                <!-- Content Row -->
                <div class="row">

                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-primary shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">News</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo News::get_number_of_news($conn);?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-success shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">News Categories</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo NewsCategories::get_number_of_newscategories($conn);?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- Earnings (Monthly) Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-info shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Users</div>
                                        <div class="row no-gutters align-items-center">
                                            <div class="col-auto">
                                                <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php $no_users = Users::get_number_of_users($conn); echo $no_users; ?></div>
                                            </div>
                                            <div class="col">
                                                <div class="progress progress-sm mr-2">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo Users::get_number_of_users($conn);?>%" aria-valuenow="<?php $no_users = Users::get_number_of_users($conn); echo $no_users; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pending Requests Card Example -->
                    <div class="col-xl-3 col-md-6 mb-4">
                        <div class="card border-left-warning shadow h-100 py-2">
                            <div class="card-body">
                                <div class="row no-gutters align-items-center">
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pending Requests</div>
                                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo Users::get_number_of_users_nonvalidated($conn);?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <!-- Content Row -->
                <div class="row">

                    <!-- Content Column -->
                    <div class="col-lg-6 mb-4">

                        <!-- Project Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary">SYSTEM</h6>
                            </div>
                            <div class="card-body">
                                <h4 class="small font-weight-bold">Pending Request<span class="float-right"><?php echo Users::get_number_of_users_nonvalidated($conn);?></span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-danger" role="progressbar" style="width: <?php echo Users::get_number_of_users_nonvalidated($conn);?>%" aria-valuenow="<?php echo Users::get_number_of_users_nonvalidated($conn);?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">News Categories <span class="float-right"><?php echo NewsCategories::get_number_of_newscategories($conn);?></span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-warning" role="progressbar" style="width: <?php echo NewsCategories::get_number_of_newscategories($conn);?>%" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">Users <span class="float-right"><?php echo Users::get_number_of_users($conn);?></span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo Users::get_number_of_users($conn);?>%" aria-valuenow="<?php echo Users::get_number_of_users($conn);?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">News <span class="float-right"><?php echo News::get_number_of_news($conn);?></span></h4>
                                <div class="progress mb-4">
                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo News::get_number_of_news($conn);?>%" aria-valuenow="<?php echo News::get_number_of_news($conn);?>" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <h4 class="small font-weight-bold">System Setup <span class="float-right">Complete!</span></h4>
                                <div class="progress">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                        </div>




                    </div>

                    <div class="col-lg-6 mb-4">
<?php
if(isset($_GET['news_id'])) {
    $newscategory = News::get_news_by_id($conn, $_GET['news_id']);
    $row = $newscategory->fetch_assoc();
    $id = $row["news_categories_id"];
    $newscategory = NewsCategories::get_news_categories_title_by_id($conn, $id);
}
if(isset($_GET['news'])||isset($_GET['news_id'])) {
?>
                        <!-- Illustrations -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary"><?php if(isset($_GET['news_id'])){echo "Update News";}else{echo "Insert News";} ?> </h6>
                            </div>
                            <div class="card-body">
                                <div class="text-center">
                                </div>
                                <form method="post" action="index.php?news" enctype="multipart/form-data" >
                                    <?php if(isset($_GET['news_id'])){?>
                                        <input style="visibility: hidden" name ="news_id" type="text" class="form-control" id="" aria-describedby=""  value="<?php if(isset($_GET['news_id']))echo $row['id'];?>"required>

                                <?php } ?>
                                    <div class="form-group">
                                        <label for="">Title</label>
                                        <input name ="title" type="text" class="form-control" id="" aria-describedby=""  value="<?php if(isset($_GET['news_id']))echo $row['title'];?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Sub Title</label>
                                        <input name ="sub_title" type="text" class="form-control" id="" aria-describedby="" value="<?php if(isset($_GET['news_id']))echo $row['sub_title'];?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Description</label>
                                        <textarea name ="description" type="text" class="form-control" id="" value="<?php if(isset($_GET['news_id']))echo $row['description'];?>"  required><?php if(isset($_GET['news_id']))echo $row['description'];?> </textarea>
                                    </div>
                                    <?php $news_categories = "SELECT * FROM news_categories";$result = $conn->query($news_categories);if ($result->num_rows > 0) { ?>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">News Category</label>
                                            </div>
                                            <select name = "news_category" class="custom-select" id="inputGroupSelect01">
                                                <option value="no" selected>Choose One</option>
                                                <?php
                                                // output data of each row
                                                while($rowcategories = $result->fetch_assoc()) {
                                                    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
                                                    ?>
                                                    <option value="<?php echo $rowcategories['id']; ?>" <?php if(isset($_GET['news_id']))if($row['news_categories_id'] == $rowcategories['id'] )echo "selected"; ?> ><?php echo $rowcategories['title']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend" id="files">
                                                <label class="input-group-text" for="inputGroupSelect01">Choose your file</label>
                                            </div>
                                            <input name="files[]" id="image" type="file"  multiple="multiple" accept="image/*, video/*" class="custom-select" >
                                            <script>
                                                $("#image").on("change", function() {
                                                    if ($("#image")[0].files.length > 5) {
                                                        alert("You can select only 5 images");
                                                        document.getElementById("image").value = "";
                                                    } else {}});
                                            </script>
                                        </div>
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend">
                                                <label class="input-group-text" for="inputGroupSelect01">Validation Status</label>
                                            </div>
                                            <select name = "validation_status" class="custom-select" id="inputGroupSelect01">
                                                <option value="no" selected>Choose One</option>
                                                <option value="no" <?php if(isset($_GET['news_id']))if($row['validation_status'] == "no")echo "selected"; ?> >No</option>
                                                <option value="yes" <?php if(isset($_GET['news_id']))if($row['validation_status'] == "yes")echo "selected"; ?>>Yes</option>
                                                <?php  ?>
                                            </select>
                                        </div>

                                        <?php if(isset($_GET['news_id'])){?>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small second">
                                                    <input name="update_media" type="checkbox" class="custom-control-input" id="customCheck1">
                                                    <label class="custom-control-label" for="customCheck1">Update Media (Old Media Deleted)</label>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Post On Social Media</label>
                                                </div>
                                            </div>
                                            <button name="update_news" type="submit" class="btn btn-success btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                                                <span class="text">Update News</span>
                                            </button>
                                            <button name="delete_news" type="submit" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                                                <span class="text">Delete News</span>
                                            </button>
                                        <?php }else{?>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck">
                                                    <label class="custom-control-label" for="customCheck">Post On Social Media</label>
                                                </div>
                                            </div>
                                        <button name="post_news" type="submit" class="btn btn-light btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                                            <span class="text">Post News</span>
                                        </button>
                                    <?php  } }?>
                                </form>
                            </div>
                        </div>
                        <?php

}else if(isset($_GET['news_categories'])||isset($_GET['news_categories_id'])) {
    if (isset($_GET['news_categories_id'])) {
        $categorydetail = NewsCategories::get_news_categories_by_id($conn, $_GET['news_categories_id']);
        $rw = $categorydetail->fetch_assoc();
        }
            ?>
            <!-- Illustrations -->
            <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">News Categories</h6>
            </div>
            <div class="card-body">
            <div class="text-center">
            </div>
            <form method="post" action="index.php?news_categories" enctype="multipart/form-data">
            <?php if (isset($_GET['news_categories_id'])) { ?>
                <input style="visibility: hidden" name="news_categories_id" type="text" class="form-control" id=""
                       aria-describedby="" value="<?php if (isset($_GET['news_categories_id'])) echo $rw["id"]; ?>"
                       required>
            <?php } ?>
            <div class="form-group">
                <label for="">Title</label>
                <input name="title" type="text" class="form-control" id="" aria-describedby=""
                       value="<?php if (isset($_GET['news_categories_id'])) echo $rw["title"]; ?>" required>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <input name="description" type="text" class="form-control" id=""
                       value="<?php if (isset($_GET['news_categories_id'])) echo $rw["description"]; ?>" required>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend" id="files">
                    <label class="input-group-text" for="inputGroupSelect01">Choose your file</label>
                </div>
                <input name="icon" id="image" type="file" accept="image/*, video/*" class="custom-select">
                <script>
                    $("#image").on("change", function () {
                        if ($("#image")[0].files.length > 5) {
                            alert("You can select only 5 images");
                            document.getElementById("image").value = "";
                        } else {
                        }
                    });
                </script>
            </div>

            <div class="form-group">
                <div class="custom-control custom-checkbox small second">
                    <input name="update_media" type="checkbox" class="custom-control-input" id="customCheck1">
                    <label class="custom-control-label" for="customCheck1">Update Media (Old Media Deleted)</label>
                </div>
            </div>
            <?php if (isset($_GET['news_categories_id'])) { ?>
                <button name="update_news_categories" type="submit" class="btn btn-success btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                    <span class="text">Update News Categories</span>
                </button>
                <button name="delete_news_categories" type="submit" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                    <span class="text">Delete News Categories</span>
                </button>

            <?php } else { ?>
                <button name="post_news_categories" type="submit" class="btn btn-light btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                    <span class="text">Post News Categories</span>
                </button>
            <?php

        }
        ?>
                </form>
            </div>
        </div>


    <?php
}else if(isset($_GET['users'])||isset($_GET['users_id'])) {
    if(isset($_GET['users_id'])) {
        $userdetail = Users::get_username_by_id($conn, $_GET['users_id']);
// output data of each row
        $rw = $userdetail->fetch_assoc();
    }
    ?>

    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Users</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
            </div>
            <form method="post" action="index.php" enctype="multipart/form-data">
                <?php if (isset($_GET['users_id'])) { ?>
                    <input style="visibility: hidden" name="user_id" type="text" class="form-control" id=""
                           aria-describedby="" value="<?php if (isset($_GET['users_id'])) echo $rw["id"]; ?>"
                           required>
                <?php } ?>
                <div class="form-group">
                    <label for="">User Name</label>
                    <input name="username" type="text" class="form-control" id="" aria-describedby=""
                           value="<?php if (isset($_GET['users_id'])) echo $rw["username"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input name="email" type="text" class="form-control" id=""
                           value="<?php if (isset($_GET['users_id'])) echo $rw["email"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input name="password" type="text" class="form-control" id=""
                           value="<?php if (isset($_GET['users_id'])) echo $rw["password"]; ?>" required>
                </div>
                <div class="form-group">
                    <label for="">Phone Number</label>
                    <input name="phone_number" type="text" class="form-control" id=""
                           value="<?php if (isset($_GET['users_id'])) echo $rw["email"]; ?>" required>
                </div>
                <?php  ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Permission</label>
                    </div>
                    <select name = "permission" class="custom-select" id="inputGroupSelect01">
                        <option value="reporter" selected>Choose One</option>
                        <option value="superadmin" <?php if(isset($_GET['users_id']))if($rw['user_category'] == "superadmin")echo "selected"; ?> >SuperAdmin</option>
                        <option value="admin" <?php if(isset($_GET['users_id']))if($rw['user_category'] == "admin")echo "selected"; ?>>Admin</option>
                        <option value="reporter" <?php if(isset($_GET['users_id']))if($rw['user_category'] == "reporter")echo "selected"; ?>>Reporter</option>
                        <?php  ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <input name="address" type="text" class="form-control" id=""
                           value="<?php if (isset($_GET['users_id'])) echo $rw["address"]; ?>" required>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Validation Status</label>
                    </div>
                <select name = "validation_status" class="custom-select" id="inputGroupSelect01">
                    <option value="no" selected>Choose One</option>
                    <option value="no" <?php if(isset($_GET['users_id']))if($rw['validation_status'] == "no")echo "selected"; ?> >No</option>
                    <option value="yes" <?php if(isset($_GET['users_id']))if($rw['validation_status'] == "yes")echo "selected"; ?>>Yes</option>
                    <?php  ?>
                </select>
                </div>
            <?php if (isset($_GET['users_id'])) { ?>
                <div class="form-group">
                    <label for="">Validation Code</label>
                    <input name="validation_code" type="text" class="form-control" id=""
                           value="<?php if (isset($_GET['users_id'])) echo $rw["validation_code"]; ?>" required>
                </div>
                <?php } ?>

                <div class="input-group mb-3">
                    <div class="input-group-prepend" id="files">
                        <label class="input-group-text" for="inputGroupSelect01">Choose your file</label>
                    </div>
                    <input name="image" id="image" type="file" accept="image/*, video/*" class="custom-select">
                    <script>
                        $("#image").on("change", function () {
                            if ($("#image")[0].files.length > 5) {
                                alert("You can select only 5 images");
                                document.getElementById("image").value = "";
                            } else {
                            }
                        });
                    </script>
                </div>

                <div class="form-group">
                    <div class="custom-control custom-checkbox small second">
                        <input name="update_media" type="checkbox" class="custom-control-input" id="customCheck1">
                        <label class="custom-control-label" for="customCheck1">Update Media (Old Media Deleted)</label>
                    </div>
                </div>
                <?php if (isset($_GET['users_id'])) { ?>
                    <button name="update_user" type="submit" class="btn btn-success btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                        <span class="text">Update User</span>
                    </button>
                    <button name="delete_user" type="submit" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                        <span class="text">Delete User</span>
                    </button>

                <?php } else { ?>
                    <button name="insert_user" type="submit" class="btn btn-light btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                        <span class="text">New User</span>
                    </button>
                    <?php

                }
                ?>
            </form>
        </div>
    </div>



    <?php

}else if(isset($_GET['headline'])||isset($_GET['headline_id'])) {
if(isset($_GET['headline_id'])) {
    $headline_detail = NewsHeadline::get_headline_id($conn, $_GET['headline_id']);
// output data of each row
    $rw = $headline_detail->fetch_assoc();
}
?>



    <!-- Illustrations -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">News Headline</h6>
        </div>
        <div class="card-body">
            <div class="text-center">
            </div>
            <form method="post" action="index.php?headline" enctype="multipart/form-data">
                <?php if (isset($_GET['headline_id'])) { ?>
                    <input style="visibility: hidden" name="headline_id" type="text" class="form-control" id=""
                           aria-describedby="" value="<?php if (isset($_GET['headline_id'])) echo $_GET['headline_id']; ?>"
                           required>
                <?php } ?>

                <div class="form-group">
                    <label for="">Title</label>
                    <textarea name="title" type="text" class="form-control" id="" required><?php if (isset($_GET['headline_id'])) echo $rw["title"]; ?></textarea>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text" for="inputGroupSelect01">Validation Status</label>
                    </div>
                    <select name = "validation_status" class="custom-select" id="inputGroupSelect01">
                        <option value="no" selected>Choose One</option>
                        <option value="no" <?php if(isset($_GET['headline_id']))if($rw['validation_status'] == "no")echo "selected"; ?> >No</option>
                        <option value="yes" <?php if(isset($_GET['headline_id']))if($rw['validation_status'] == "yes")echo "selected"; ?>>Yes</option>
                        <?php  ?>
                    </select>
                </div>
                <?php if (isset($_GET['headline_id'])) { ?>
                    <button name="update_newsheadline" type="submit" class="btn btn-success btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                        <span class="text">Update Headline</span>
                    </button>
                    <button name="delete_newsheadline" type="submit" class="btn btn-danger btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                        <span class="text">Delete Headline</span>
                    </button>

                <?php } else { ?>
                    <button name="insert_newsheadline" type="submit" class="btn btn-light btn-icon-split">
                                            <span class="icon text-gray-600">
                                        <i class="fas fa-arrow-right"></i>
                                        </span>
                        <span class="text">New Headline</span>
                    </button>
                    <?php

                }
                ?>
            </form>
        </div>
    </div>





                        <?php } ?>

                    </div>
                </div>
            </div>


            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">

                <?php
                if(isset($_GET['news'])||isset($_GET['news_id'])) {
                    ?>

                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">Records</h1>


                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">News</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                                            <tfoot>
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
                                            </tfoot>
                                            <tbody>
                                            <?php
                                            $newsresult = News::get_all_news($conn);
                                            if(!is_null($newsresult)) {
                                                // output data of each row
                                                while ($row = $newsresult->fetch_assoc()) {
                                                    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
                                                    ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['sub_title']; ?></td>
                                                        <td><?php echo $row['description']; ?></td>
                                                        <td><?php echo NewsCategories::get_news_categories_title_by_id($conn, $row['news_categories_id']); ?></td>
                                                        <td><?php echo $row['date_time']; ?></td>
                                                        <td><?php $username = Users::get_username_by_id($conn, $row['authorize_users_id'])->fetch_assoc();
                                                            echo $username['username'] ?></td>
                                                        <td><a href="?news_id=<?php echo $row['id']; ?>">X</a></td>
                                                    </tr>
                                                    <?php
                                                }//HERE LOOP END
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->


                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->
                    <?php

                }else if(isset($_GET['news_categories'])||isset($_GET['news_categories_id'])){

                        ?>

                        <!-- Main Content -->
                        <div id="content">

                            <!-- Begin Page Content -->
                            <div class="container-fluid">

                                <!-- Page Heading -->
                                <h1 class="h3 mb-2 text-gray-800">Records</h1>


                                <!-- DataTales Example -->
                                <div class="card shadow mb-4">
                                    <div class="card-header py-3">
                                        <h6 class="m-0 font-weight-bold text-primary">News Categories</h6>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dataTable" width="100%"
                                                   cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Options</th>
                                                </tr>
                                                </thead>
                                                <tfoot>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Title</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Options</th>
                                                </tr>
                                                </tfoot>
                                                <tbody>
                                                <?php
                                                $newsresult = NewsCategories::get_news_categories_title($conn);
                                                if(!is_null($newsresult)) {
                                                    // output data of each row
                                                    while ($row = $newsresult->fetch_assoc()) {
                                                        //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
                                                        ?>
                                                        <tr>
                                                            <td scope="row"><?php echo $row['id']; ?></td>
                                                            <td><?php echo $row['title']; ?></td>
                                                            <td><?php echo $row['description']; ?></td>
                                                            <td>
                                                                <a href="?news_categories_id=<?php echo $row['id']; ?>">X</a>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                    }//HERE LOOP END
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <!-- /.container-fluid -->


                            <!-- /.container-fluid -->

                        </div>
                        <!-- End of Main Content -->


                        <?php
                        }else if(isset($_GET['users'])|| isset($_GET['users_id'])) {
                    ?>
                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">Records</h1>


                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Permission</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Validation Code</th>
                                                <th scope="col">Validation Status</th>
                                                <th scope="col">Registeration Date</th>
                                                <th scope="col">Login Date</th>
                                                <th scope="col">Options</th>

                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Password</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Permission</th>
                                                <th scope="col">Address</th>
                                                <th scope="col">Validation Code</th>
                                                <th scope="col">Validation Status</th>
                                                <th scope="col">Registeration Date</th>
                                                <th scope="col">Login Date</th>
                                                <th scope="col">Options</th>

                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php
                                            $newsresult = Users::get_users($conn);
                                            if(!is_null($newsresult)) {
                                                // output data of each row
                                                while ($row = $newsresult->fetch_assoc()) {
                                                    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
                                                    ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['username']; ?></td>
                                                        <td><?php echo $row['email']; ?></td>
                                                        <td><?php echo $row['password']; ?></td>
                                                        <td><?php echo $row['phone_number']; ?></td>
                                                        <td><?php echo $row['user_category']; ?></td>
                                                        <td><?php echo $row['address']; ?></td>
                                                        <td><?php echo $row['validation_code']; ?></td>
                                                        <td><?php echo $row['validation_status']; ?></td>
                                                        <td><?php echo $row['register_date']; ?></td>
                                                        <td><?php echo $row['login_date']; ?></td>
                                                        <td>
                                                            <a href="?users_id=<?php echo $row['id']; ?>">X</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }//HERE LOOP END
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->


                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->

                    <?php
                }else if(isset($_GET['headline'])||isset($_GET['headline_id'])){
                ?>



                    <!-- Main Content -->
                    <div id="content">

                        <!-- Begin Page Content -->
                        <div class="container-fluid">

                            <!-- Page Heading -->
                            <h1 class="h3 mb-2 text-gray-800">Records</h1>


                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-primary">News Headline</h6>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%"
                                               cellspacing="0">
                                            <thead>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Validation_Status </th>
                                                <th scope="col">Options</th>
                                            </tr>
                                            </thead>
                                            <tfoot>
                                            <tr>
                                                <th scope="col">#</th>
                                                <th scope="col">Title</th>
                                                <th scope="col">Validation_Status</th>
                                                <th scope="col">Options</th>
                                            </tr>
                                            </tfoot>
                                            <tbody>
                                            <?php
                                            $headlineresult = NewsHeadline::get_news_headline($conn);
                                            if(!is_null($headlineresult)) {
                                                // output data of each row
                                                while ($row = $headlineresult->fetch_assoc()) {
                                                    //LOOP FOR SHOWING ALL RECORDS FROM DATABASE
                                                    ?>
                                                    <tr>
                                                        <td scope="row"><?php echo $row['id']; ?></td>
                                                        <td><?php echo $row['title']; ?></td>
                                                        <td><?php echo $row['validation_status']; ?></td>
                                                        <td>
                                                            <a href="?headline_id=<?php echo $row['id']; ?>">X</a>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }//HERE LOOP END
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!-- /.container-fluid -->


                        <!-- /.container-fluid -->

                    </div>
                    <!-- End of Main Content -->


                    <?php
                }
                ?>
                <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span><?php echo $_SESSION['footer']; ?></span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="?logout">Logout</a>
            </div>
        </div>
    </div>
</div>
        <!-- Logout Modal-->

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>

        <!-- Page level plugins -->
        <script src="vendor/datatables/jquery.dataTables.min.js"></script>
        <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

        <!-- Page level custom scripts -->
        <script src="js/demo/datatables-demo.js"></script>

</body>

</html>
