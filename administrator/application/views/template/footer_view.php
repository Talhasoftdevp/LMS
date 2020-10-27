<div class="footer">
    <div class="footer-inner">
        <div class="footer-content">
            <span>

                <a href="https://www.silversolve.com/">
                    <span>Powered by Silver Solve @ 2020</span>
                </a>
            </span>


            <span class="action-buttons">
                <a href="#">
                    <i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
                </a>

                <a href="#">
                    <i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
                </a>

                <a href="#">
                    <i class="ace-icon fa fa-rss-square orange bigger-150"></i>
                </a>
            </span>
        </div>
    </div>
</div>

<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
    <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
</a>
</div><!-- /.main-container -->

<!-- basic scripts -->

<!--[if !IE]> -->
<script src="<?php echo base_url(); ?>assets/js/jquery.2.1.1.min.js"></script>

<!-- <![endif]-->

<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

<!--[if !IE]> -->
<script type="text/javascript">
    window.jQuery || document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.min.js'>" + "<" + "/script>");
</script>

<!-- <![endif]-->

<!--[if IE]>
<script type="text/javascript">
window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
<script type="text/javascript">
    if ('ontouchstart' in document.documentElement)
        document.write("<script src='<?php echo base_url(); ?>assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
</script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.custom.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.ui.touch-punch.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.easypiechart.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.sparkline.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.pie.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.flot.resize.min.js"></script>

<!-- page specific plugin scripts -->

<!-- ace scripts -->
<script src="<?php echo base_url(); ?>assets/js/ace-elements.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/ace.min.js"></script>

<!-- inline scripts related to this page -->

<!-- page specific plugin scripts -->
<!--        <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.min.js"></script>
       <script src="<?php echo base_url(); ?>assets/js/jquery.dataTables.bootstrap.min.js"></script>
       <script src="<?php echo base_url(); ?>assets/js/dataTables.tableTools.min.js"></script>
       <script src="<?php echo base_url(); ?>assets/js/dataTables.colVis.min.js"></script>-->

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