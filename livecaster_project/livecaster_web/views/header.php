<!DOCTYPE html>
<?php
include './req/setting.php';
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Title -->
    <title><?php echo $_SESSION['title']; ?></title>

    <!-- Favicon -->

    <link rel="shortcut icon" type="image/x-icon" href="data:image;base64,<?php echo base64_encode( $_SESSION['icon']); ?>" />

    <!-- Core Stylesheet -->
    <link rel="stylesheet" href="style.css">

</head>

<body>
<!-- ##### Header Area Start ##### -->
<header class="header-area">

    <!-- Top Header Area -->
    <div class="top-header-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="top-header-content d-flex align-items-center justify-content-between">
                        <!-- Logo -->
                        <div class="logo">
                            <a href="../index.php">
                                <?php echo '<h2 ><img style="margin-right: 20px" width="8%" height="8%" src="data:image/ico;base64,'.base64_encode( $_SESSION['icon'] ).'"/>'; echo "".$_SESSION['header']."</h2>"; ?>
                            </a>
                        </div>

                        <!-- Login Search Area -->
                        <div class="login-search-area d-flex align-items-center">
                            <!-- Login -->
                            <div class="login d-flex">
                                <a href="../login.php">Login</a>
                                <a href="../login.php?register">Register</a>
                            </div>
                            <!-- Search Form -->
                            <div class="search-form">
                                <form action="search.php" method="post">
                                    <input type="search" name="search" class="form-control" placeholder="Search" >
                                   <!-- <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button> -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Navbar Area -->
    <div class="newspaper-main-menu" id="stickyMenu">
        <div class="classy-nav-container breakpoint-off">
            <div class="container">
                <!-- Menu -->
                <nav class="classy-navbar justify-content-between" id="newspaperNav">

                    <!-- Logo -->
                    <div class="logo">
                        <?php echo '<p sytle="color:white"><img style="margin-right: 20px" width="8%" height="8%" src="data:image/ico;base64,'.base64_encode( $_SESSION['icon'] ).'"/>'; echo "".$_SESSION['header']."</p>"; ?>
                    </div>

                    <!-- Navbar Toggler -->
                    <div class="classy-navbar-toggler">
                        <span class="navbarToggler"><span></span><span></span><span></span></span>
                    </div>

                    <!-- Menu -->
                    <div class="classy-menu">

                        <!-- close btn -->
                        <div class="classycloseIcon">
                            <div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
                        </div>

                        <!-- Nav Start -->
                        <div class="classynav">
                            <ul>
                                <li><a href="../index.php">Home</a></li>
                                <?php
                                $result = NewsCategories::get_news_categories_title($conn);
                                while ($row = $result->fetch_assoc()) {
                                    $news_by_categories = News::get_news_by_categories($conn, $row['id'], 1);
                                    if (is_null($news_by_categories->fetch_assoc())) {
                                    } else {
                                        ?>
                                        <li>
                                            <a href="categories.php?categories=<?php echo $row['id'] ?>"><?php echo $row["title"]; ?></a>
                                        </li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </div>
                        <!-- Nav End -->
                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
<!-- ##### Header Area End ##### -->
<!-- ##### Hero Area Start ##### -->
<div class="hero-area">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-8">
                <!-- Breaking News Widget -->
                <div class="breaking-news-area d-flex align-items-center">
                    <div class="news-title">
                        <p>Breaking News</p>
                    </div>
                    <div id="breakingNewsTicker" class="ticker">
                        <ul>
                            <?php
                            $result = NewsHeadline::get_news_headline($conn);
                            if(is_null($result -> fetch_assoc()))
                            { echo ' <li><a href="#"> No Breaking News </a></li>'; }else{
                                $result = NewsHeadline::get_news_headline($conn);
                            while ($row = $result->fetch_assoc()) {
                                    ?>

                                    <li><a href="#"> <?php echo $row["title"]; ?></a></li>

                                <?php } ?>

                                <?php  }
                            ?>
                        </ul>
                    </div>
                </div>


                <!-- Breaking News Widget -->
                <!-- INTERNATIONAL News Widget
                <div class="breaking-news-area d-flex align-items-center mt-15">
                    <div class="news-title title2">
                        <p>International</p>
                    </div>
                    <div id="internationalTicker" class="ticker">
                        <ul>
                            <li><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</a></li>
                            <li><a href="#">Welcome to Colorlib Family.</a></li>
                            <li><a href="#">Nam eu metus sitsit amet, consec!</a></li>
                        </ul>
                    </div>
                </div>-->
            </div>

            <!-- Hero Add -->
            <div class="col-12 col-lg-4">
                <div class="hero-add">
                    <a href="#"><img src="img/bg-img/hero-add.gif" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>


