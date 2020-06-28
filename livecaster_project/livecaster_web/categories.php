<?php
if($_GET['categories']){$categoriesid = $_GET['categories'];}else{header("Location: ../index.php");}
require_once "views/header.php";
?>
<!-- ##### Featured Post Area End ##### -->
    <!-- ##### Popular News Area Start ##### -->
    <div class="popular-news-area section-padding-80-50">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-7 col-lg-12">
                    <div class="section-heading">
                        <h6><?php $newscategory = NewsCategories::get_news_categories_title_by_id($conn,$categoriesid);echo $newscategory; ?></h6>
                    </div>

                    <div class="row">
                        <?php
                        $getsnewsbyidresult = News::get_news_by_categories($conn,$categoriesid,30);
                        while ($getnewsresult = $getsnewsbyidresult->fetch_assoc()) {
                        ?>
                            <!-- Single Post -->
                            <div class="col-12 col-lg-4">
                                <div class="single-blog-post">
                                    <div class="post-thumb">
                                        <a href="single-post.php?post=<?php echo $getnewsresult['id']; ?>">
                                            <?php
                                            $mediaRecordnews = MediaTable::get_recent_thumbnail($conn,$getnewsresult['id']);
                                            if (is_null($mediaRecordnews->fetch_assoc()))
                                            {
                                                echo '<img style="width=330px;height=291px;" atl="No Image Uploaded" src="img/no-image-uploaded.PNG"/>';
                                            }else {
                                                $mediaRownews = MediaTable::get_recent_thumbnail($conn,$getnewsresult['id'])->fetch_assoc();
                                                echo '<img style="object-fit: cover;" width="330px" height="291px" atl="' . $mediaRownews['media_name'] . '" src="data:' . $mediaRownews['media_type'] . ';base64,' . base64_encode($mediaRownews['media_data']) . '"/>';
                                            }
                                            ?>
                                        </a>
                                    </div>
                                    <div class="post-data">
                                        <a  href="single-post.php?post=<?php echo $getnewsresult['id']; ?>" class="post-title">
                                            <h6><?php echo $getnewsresult['sub_title']; ?></h6>
                                        </a>
                                        <div class="post-meta">
                                            <?php
                                            $datetime1 = Split::split_datetime($conn,$getnewsresult["date_time"]);
                                            $date1 = date_create($datetime1[0]);
                                            ?>
                                            <div class="post-date"><a href="#"><?php echo date_format($date1,"M d, Y"); ?></a></div>
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
require_once "views/footer.php";
?>
