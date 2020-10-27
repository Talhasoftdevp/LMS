<footer>
    <div class="container">
        <div class="row">
            <div class="top">
                <!-- <div class="col-md-3">
                    <h6>Silver Solve</h6>
                </div> -->
                <!--col-->

                <div class="col-md-6 col-md-pull-1">
                    <ul>
                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                        <li><a href="<?php echo base_url(); ?>elearning">E-Learning</a></li>
                        <li><a href="<?php echo base_url(); ?>contact">Contact us</a></li>
                    </ul>
                </div>
                <!--col-->

                <div class="col-md-3 col-md-push-3">
                    <div class="sm">
                        <ul>
                            <li class="fb">
                                <a href="http://www.facebook.com/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="twitter">
                                <a href="http://www.twitter.com/" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="linkedin">
                                <a href="http://www.linkedin.com/" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!--col-->
            </div>
            <!--top-->
            <div class="clearfix"></div>

            <div class="bottom">
                <div class="col-md-12">

                    <ul>
                        <li>Copyright &copy; 2020</li>
                        <li><a href="https://www.silversolve.com/">Silver Solve</a></li>
                        <!-- <li><a href="<?php echo base_url(); ?>terms">Terms of Use</a></li> -->
                    </ul>

                </div>
                <!--col-->
            </div>
            <!--bottom-->
        </div>
        <!--row-->
    </div>
    <!--container-->
</footer>
<div class="clearfix"></div>

<!-- JAVASCRIPT -->
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tabs/js/jquery-1.4.2.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tabs/js/cufon-yui.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tabs/js/cufon-replace.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tabs/js/Myriad_Pro_400.font.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tabs/js/Myriad_Pro_700.font.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/tabs/js/Myriad_Pro_600.font.js"></script>

<script src="<?php echo base_url(); ?>assets/js/jquery-1.11.3.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pace.min.js"></script>
<!--<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>-->
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>

<!-- SSL Security -->
<!-- <script type="text/javascript" src="https://cdn.ywxi.net/js/1.js" async></script> -->


<?php include(APPPATH . 'views/template/main_js.php'); ?>
<?php
if (!isset($is_home)) {

    if (file_exists($current_js)) {

        include($current_js);
    }
}
?>

</body>

</html>