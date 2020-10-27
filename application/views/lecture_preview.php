<link rel="stylesheet" href="<?php echo site_url('assets/css/bootstrap-4.1.3.css') ?>" />
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/viewLecture.css" />
<section class="customizedSection">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 style="margin-left:50px">Chapter: <font style="color:#f27a21;"><?php echo $lectureDetails['lectureName'] ?></font>
                </h4>
                <br>

            </div>
            <div class="col">
                <h4 style="margin-left:170px">Subject: <font style="color:#f27a21;"><?php echo $lectureDetails['subject'] ?></font>
                </h4>
                <br>
            </div>
        </div>
    </div>
    <div class="container custom">
        <div class="col-xs-12 col-sm-12 col-md-12">

            <div id="countdowntimer"><span id="ms_timer"><span></div>
            <?php
            //$numberOfSlides = count($slides);
            foreach ($lectureContent as $lectureContent) { ?>
                <div class="box5">
                    <?php if ($lectureContent['type'] != 'URL') { ?>
                        <!-- <img style="height: 470px;" class="img" src="<?php echo base_url(); ?>administrator/upload/elearning/chapter/<?php echo $lectureContent['path'];  ?>" /> -->
                        <embed src="<?php echo base_url(); ?>administrator/upload/elearning/chapter/<?php echo $lectureContent['path'];  ?>" width="100%" height="100%" />
                        <!-- <iframe id="iframepdf" src="<?php echo base_url(); ?>administrator/upload/elearning/chapter/<?php echo $lectureContent['path'];  ?>"></iframe> -->
                        <!-- <html>

                        <body>
                            <object data=<?php echo base_url(); ?>administrator/upload/elearning/chapter/<?php echo $lectureContent['path'];  ?>" type="application/pdf">
                                <embed src="<?php echo base_url(); ?>administrator/upload/elearning/chapter/<?php echo $lectureContent['path'];  ?>" type="application/pdf" />
                            </object>
                        </body>

                        </html> -->
                    <?php } else { ?>
                        <?php
                        $youtubeLink = str_replace($searchVal, $replaceVal, $lectureContent['path']);
                        ?>
                        <iframe style="height: 100%; width:100%;" src="<?php echo $youtubeLink;  ?>" frameborder="0" allowfullscreen><iframe>
                            <?php } ?>

                </div>
                <br />
            <?php } ?>
        </div>
    </div>
    <!--container-->
</section>
<div class="clearfix"></div>
<!--<script>		

</script>
-->