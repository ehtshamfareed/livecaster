<?php include "views/header.php"?>

    <!-- ##### Featured Post Area Start ##### -->
    <div class="featured-post-area">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="row">

                        <!-- Single Featured Post -->
                        <div class="col-12 col-lg-7">
                            <?php
                            $singleNewsRecord = News::get_recent_news($conn,1);
                            if(!is_null($singleNewsRecord)){
                            $singleNews = $singleNewsRecord->fetch_assoc();

                            ?>
                            <div class="single-blog-post featured-post ">
                                <div class="post-thumb">
                                    <a href="single-post.php?post=<?php echo $singleNews['id']; ?>">
                                        <?php
                                        $mediaRecord1 = MediaTable::get_recent_thumbnail($conn,$singleNews['id']);
                                        if (is_null($mediaRecord1->fetch_assoc()))
                                        {
                                            echo '<img style="width=330px;height=261px;" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
                                        }else {
                                            $mediaRow1 = MediaTable::get_recent_thumbnail($conn,$singleNews['id'])->fetch_assoc();
                                            echo '<img style="object-fit: cover;" width="330px" height="261px" atl="' . $mediaRow1['media_name'] . '" src="data:' . $mediaRow1['media_type'] . ';base64,' . base64_encode($mediaRow1['media_data']) . '"/>';
                                        }
                                        ?>
                                    </a>
                                </div>
                                <div class="post-data">
                                    <a href="categories.php?categories=<?php echo $singleNews['news_categories_id'] ?>" class="post-catagory"><?php $newscategory = NewsCategories::get_news_categories_title_by_id($conn,$singleNews['news_categories_id']);echo $newscategory;?></a>
                                    <a href="single-post.php?post=<?php echo $singleNews['id']; ?>" class="post-title">
                                        <h6 style="width: 30px;"><?php echo $singleNews['title'];  ?></h6>
                                    </a>
                                    <div class="post-meta">
                                        <p class="post-author">By <a href="#">
                                                <?php
                                                $userrecord = Users::get_username_by_id($conn,$singleNews['authorize_users_id']);
                                                $userrow = $userrecord->fetch_assoc();echo $userrow['username'];
                                        ?>
                                            </a></p>
                                        <p class="post-excerp">
                                           <?php  echo $singleNews['sub_title']; ?>
                                        </p>

                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="col-12 col-lg-5">

                            <?php
                            $queryresult = News::get_recent_news_expectfirst($conn,2);
                            if(!is_null($queryresult)) {
                                while ($queryrow = $queryresult->fetch_assoc()) {

                                    ?>

                                    <!-- Single Featured Post -->
                                    <div class="single-blog-post featured-post-2">
                                        <div class="post-thumb">
                                            <a href="single-post.php?post=<?php echo $queryrow['id']; ?>">
                                                <?php

                                                $mediaRecord1 = MediaTable::get_recent_thumbnail($conn, $queryrow['id']);
                                                if (is_null($mediaRecord1->fetch_assoc())) {
                                                    echo '<img style="width=330px;height=261px;" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
                                                } else {
                                                    $mediaRow1 = MediaTable::get_recent_thumbnail($conn, $queryrow['id'])->fetch_assoc();
                                                    echo '<img style="width=330px;height=261px;" atl="' . $mediaRow1['media_name'] . '" src="data:' . $mediaRow1['media_type'] . ';base64,' . base64_encode($mediaRow1['media_data']) . '"/>';
                                                }
                                                ?>
                                            </a>
                                        </div>
                                        <div class="post-data">
                                            <a href="categories.php?categories=<?php echo $queryrow['news_categories_id'] ?>"
                                               class="post-catagory"><?php $newscategory = NewsCategories::get_news_categories_title_by_id($conn, $queryrow['news_categories_id']);
                                                echo $newscategory; ?></a>
                                            <div class="post-meta">
                                                <a href="single-post.php?post=<?php echo $queryrow['id']; ?>"
                                                   class="post-title">
                                                    <h6><?php echo $singleNews['title']; ?></h6>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            ?>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6 col-lg-4">
                   <?php
                   $result = News::get_recent_news($conn,6);
                   if(!is_null($result)) {
                   while ($row = $result->fetch_assoc()) {

                       ?>
                       <!-- Single Featured Post -->
                       <div class="single-blog-post small-featured-post d-flex">
                           <div class="post-thumb">
                               <a href="single-post.php?post=<?php echo $row['id']; ?>">
                                   <!--<img src="img/bg-img/19.jpg" alt="">-->
                                   <?php
                                   $mediaRecord = MediaTable::get_recent_thumbnail($conn, $row['id']);
                                   if (is_null($mediaRecord->fetch_assoc())) {
                                       echo '<img style="object-fit: cover;" width="90px" height="90px" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
                                   } else {
                                       $mediaRow = MediaTable::get_recent_thumbnail($conn, $row['id'])->fetch_assoc();
                                       echo '<img style="object-fit: cover;" width="90px" height="90px" atl="' . $mediaRow['media_name'] . '" src="data:' . $mediaRow['media_type'] . ';base64,' . base64_encode($mediaRow['media_data']) . '"/>';
                                   }
                                   ?>
                               </a>
                           </div>
                           <div class="post-data">
                               <a href="categories.php?categories=<?php echo $row['news_categories_id'] ?>"
                                  class="post-catagory">
                                   <?php
                                   $id = $row["news_categories_id"];
                                   $newscategory = NewsCategories::get_news_categories_title_by_id($conn, $id);
                                   echo $newscategory;
                                   ?>
                               </a>
                               <div class="post-meta">
                                   <a href="single-post.php?post=<?php echo $row['id']; ?>" class="post-title">
                                       <h6><?php echo $row["title"]; ?></h6>
                                   </a>
                                   <!-- <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p> -->
                                   <p class="post-date">
                                       <?php $datetime = Split::split_datetime($conn, $row["date_time"]);
                                       $time = date_create($datetime[1]);
                                       $date = date_create($datetime[0]);
                                       ?>
                                       <span><?php echo date_format($time, "g:i A"); ?></span> |
                                       <span><?php echo date_format($date, "d F Y"); ?></span>
                                   </p>
                               </div>
                           </div>
                       </div>
                       <?php
                   }
                   }
                    ?>

                </div>
            </div>
        </div>
    </div>
    <!-- ##### Featured Post Area End ##### -->
    <?php
    $result = NewsCategories::get_news_categories_title($conn);
    if(!is_null($result -> fetch_assoc())) {
       $result = NewsCategories::get_news_categories_title($conn);
        while ($row = $result->fetch_assoc()) {
            $news_by_categories = News::get_news_by_categories($conn,$row['id'],1);
            if(is_null($news_by_categories -> fetch_assoc())){}else {
                ?>
                <!-- ##### Popular News Area Start ##### -->
                <div class="popular-news-area section-padding-80-50">
                    <div class="container">
                        <div class="row">
                            <div class="col-12 col-md-7 col-lg-12">
                                <div class="section-heading">
                                    <a href="categories.php?categories=<?php echo $row['id'] ?>">
                                        <h6><?php echo $row['title']; ?></h6></a>
                                </div>

                                <div class="row">
                                    <?php
                                    $getsnewsbyidresult = News::get_news_by_categories($conn, $row['id'], 3);
                                    while ($getnewsresult = $getsnewsbyidresult->fetch_assoc()) {
                                        ?>
                                        <!-- Single Post -->
                                        <div class="col-12 col-lg-4">
                                            <div class="single-blog-post">
                                                <div class="post-thumb">
                                                    <a href="single-post.php?post=<?php echo $getnewsresult['id']; ?>">
                                                        <?php
                                                        $mediaRecordnews = MediaTable::get_recent_thumbnail($conn, $getnewsresult['id']);
                                        if (is_null($mediaRecordnews->fetch_assoc()))
                                        {
                                            echo '<img style="width=330px;height=291px;" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
                                        }else {
                                            $mediaRownews = MediaTable::get_recent_thumbnail($conn, $getnewsresult['id'])->fetch_assoc();
                                            echo '<img style="object-fit: cover;" width="330px" height="291px" atl="' . $mediaRownews['media_name'] . '" src="data:' . $mediaRownews['media_type'] . ';base64,' . base64_encode($mediaRownews['media_data']) . '"/>';
                                        }
                                                        ?>
                                                    </a>
                                                </div>
                                                <div class="post-data">
                                                    <a href="single-post.php?post=<?php echo $getnewsresult['id']; ?>"
                                                       class="post-title">
                                                        <h6><?php echo $getnewsresult['sub_title']; ?></h6>
                                                    </a>
                                                    <div class="post-meta">
                                                        <?php
                                                        $datetime1 = Split::split_datetime($conn, $getnewsresult["date_time"]);
                                                        $date1 = date_create($datetime1[0]);
                                                        ?>
                                                        <div class="post-date"><a
                                                                    href="#"><?php echo date_format($date1, "M d, Y"); ?></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- ##### Popular News Area End ##### -->
                <?php
            }
        }
    }

?>

<?php
include "views/footer.php";
?>



