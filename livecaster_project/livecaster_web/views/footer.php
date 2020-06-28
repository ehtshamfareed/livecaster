

<!-- ##### Footer Add Area Start ##### -->
<div class="footer-add-area">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="footer-add">
                    <a href="#"><img src="img/bg-img/footer-add.gif" alt=""></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Footer Add Area End ##### -->

<!-- ##### Footer Area Start ##### -->
<footer class="footer-area">

    <!-- Main Footer Area -->
    <div class="main-footer-area">
        <div class="container">
            <div class="row">

                <!-- Footer Widget Area -->
                <div class="col-12 col-sm-6 col-lg-12">
                    <div class="footer-widget-area mt-80">
                        <!-- Footer Logo -->
                        <div class="footer-logo" sytle="color:white;">
                            <?php echo '<h2><img style="margin-right: 20px" width="8%" height="8%" src="data:image/ico;base64,'.base64_encode( $_SESSION['icon'] ).'"/>'; echo "".$_SESSION['header']."</h2>"; ?>
                            <a href="#">LIVE CASTER News</a>
                            || <a href="mailto:<?php echo $_SESSION['superadmin_email']; ?>"><?php echo $_SESSION['superadmin_username']; ?></a>
                            || <a href="tel:<?php echo $_SESSION['superadmin_phone_number']; ?>"><?php echo $_SESSION['superadmin_phone_number']; ?></a>
                            <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                                Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="#" target="_blank"><?php echo $_SESSION['footer']; ?></a>
                                <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>



</footer>
<!-- ##### Footer Area Start ##### -->

<!-- ##### All Javascript Files ##### -->
<!-- jQuery-2.2.4 js -->
<script src="js/jquery/jquery-2.2.4.min.js"></script>
<!-- Popper js -->
<script src="js/bootstrap/popper.min.js"></script>
<!-- Bootstrap js -->
<script src="js/bootstrap/bootstrap.min.js"></script>
<!-- All Plugins js -->
<script src="js/plugins/plugins.js"></script>
<!-- Active js -->
<script src="js/active.js"></script>
</body>

</html>