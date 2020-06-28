<?php
if($_GET['post']){$postid = $_GET['post'];}else{header("Location: ../index.php");}
require_once "views/header.php";
?>

    <!-- ##### Blog Area Start ##### -->
    <div class="blog-area section-padding-0-80">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-8">
                    <div class="blog-posts-area">
                        <?php
                        $singleNewsRecord = News::get_news_by_id($conn,$postid);
                        $singleNews = $singleNewsRecord->fetch_assoc();
                        ?>
                        <!-- Single Featured Post -->
                        <div class="single-blog-post featured-post single-post">
                            <div class="post-thumb">
                                <a href="#">
                                    <?php
                                    $mediaRecordnews = MediaTable::get_recent_thumbnail($conn,$postid);
if (is_null($mediaRecordnews->fetch_assoc()))
{
    echo '<img style="width=610px;height=295px;" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
}else {
    $mediaRownews = MediaTable::get_recent_thumbnail($conn,$postid)->fetch_assoc();
    echo '<img style="object-fit: cover;" width="610px" height="295px" atl="' . $mediaRownews['media_name'] . '" src="data:' . $mediaRownews['media_type'] . ';base64,' . base64_encode($mediaRownews['media_data']) . '"/>';
}
                                    ?>
                                </a>
                            </div>
                            <div class="post-data">
                                <a href="categories.php?categories=<?php echo $singleNews['news_categories_id'] ?>" class="post-catagory"><?php $newscategory = NewsCategories::get_news_categories_title_by_id($conn,$singleNews['news_categories_id']);echo $newscategory; ?></a>
                                <a href="#" class="post-title">
                                    <h6><?php echo $singleNews['title']; ?></h6>
                                </a>
                                <div class="post-meta">
                                    <p class="post-author">By <a href="#">
                                           <?php $userrecord = Users::get_username_by_id($conn,$singleNews['authorize_users_id']);
                                            $userrow = $userrecord->fetch_assoc();echo $userrow['username'];?>
                                        </a></p>
                                    <h5><?php echo $singleNews['sub_title']?></h5>
                                        <?php echo $singleNews['description']?>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>




                <div class="col-12 col-md-6 col-lg-4">
                    <?php
                    $result = News::get_recent_news($conn,5);
                    while ($row = $result->fetch_assoc()) {

                        ?>
                        <!-- Single Featured Post -->
                        <div class="single-blog-post small-featured-post d-flex">
                            <div class="post-thumb">
                                <a href="single-post.php?post=<?php echo $row['id']; ?>">
                                    <!--<img src="img/bg-img/19.jpg" alt="">-->
                                    <?php
                                    $mediaRecord = MediaTable::get_recent_thumbnail($conn,$row['id']);
                        if (is_null($mediaRecord->fetch_assoc()))
                        {
                            echo '<img style="width=90px;height=90px;" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
                        }else {
                            $mediaRow = MediaTable::get_recent_thumbnail($conn, $row['id'])->fetch_assoc();
                            echo '<img style="object-fit: cover;" width="90px" height="90px" atl="' . $mediaRow['media_name'] . '" src="data:' . $mediaRow['media_type'] . ';base64,' . base64_encode($mediaRow['media_data']) . '"/>';
                        }
                                    ?>
                                </a>
                            </div>
                            <div class="post-data">
                                <a href="categories.php?categories=<?php echo $row['news_categories_id'] ?>" class="post-catagory">
                                    <?php
                                    $id = $row["news_categories_id"];
                                    $newscategory = NewsCategories::get_news_categories_title_by_id($conn,$id);
                                    echo $newscategory;
                                    ?>
                                </a>
                                <div class="post-meta">
                                    <a href="single-post.php?post=<?php echo $row['id']; ?>" class="post-title">
                                        <h6><?php echo $row["title"]; ?></h6>
                                    </a>
                                    <!-- <p class="post-date"><span>7:00 AM</span> | <span>April 14</span></p> -->
                                    <p class="post-date">
                                        <?php $datetime = Split::split_datetime($conn,$row["date_time"]);
                                        $time = date_create($datetime[1]);$date = date_create($datetime[0]);
                                        ?>
                                        <span><?php echo date_format($time,"g:i A"); ?></span> | <span><?php echo date_format($date,"d F Y"); ?></span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <?php

                    }
                    ?>

                </div>

            </div>
            <div class="pager d-flex align-items-center justify-content-between">
                <div class="prev">
                <?php
                if (is_null(News::get_news_by_min($conn,$_GET['post'])->fetch_assoc())){}else {
                    $result_prev = News::get_news_by_min($conn, $_GET['post']);
                    while ($row_prev = $result_prev->fetch_assoc())
                        $final_result_prev = $row_prev['id'];
                    ?>
                    <a href="single-post.php?post=<?php echo $final_result_prev;; ?>" class="active"><i
                                class="fa fa-angle-left"></i> previous</a>
                    <?php
                }
                        ?>
                        </div>
                <div class="next">
                    <?php
                    if (is_null(News::get_news_by_max($conn,$_GET['post'])->fetch_assoc())){}else {
                        $result_next = News::get_news_by_max($conn, $_GET['post']);
                        $row_next = $result_next->fetch_assoc();
                        ?>
                        <a href="single-post.php?post=<?php echo $final_result_next = $row_next['id']; ?>">Next <i
                                    class="fa fa-angle-right"></i></a>
                        <?php
                    }
                        ?>
                </div>
            </div>
        </div>
    </div>

<?php require_once "views/footer.php"; ?>