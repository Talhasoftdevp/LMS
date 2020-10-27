<div class=" main-content">
    <div class="main-content-inner">

        <div class="page-content">
            <?php if ($this->session->userdata('user_role') == 'Admin') {
                echo '<div class="page-header">';
                echo '<h1>';
                echo 'Dashboard';
                echo '<small>';
                // echo '<i class="ace-icon fa fa-angle-double-right"></i>';
                echo 'overview &amp; stats';
                echo '</small>';
                echo '</h1>';
                echo '</div>';
            }

            ?>

            <div class="row no-gutters" style="margin-top:6.5%">
                <div class="col-xs-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="row mb-3">
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-inverse card-success">
                                <div class="card-block bg-success">
                                    <h6 class=" display-4 text-center customCSS " style="padding-top:-10px;margin-top:-3%"><?php echo 'Teachers Count' ?></h6>
                                    <h1 class="display-1 text-center customCSS"><?php echo $teachersCount  ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-inverse card-danger">
                                <div class="card-block bg-danger">
                                    <h6 class=" display-4 text-center customCSS " style="padding-top:-10px;margin-top:-3%"><?php echo 'Students Count' ?></h6>
                                    <h1 class="display-1 text-center customCSS"><?php echo $studentCount  ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-inverse card-info">
                                <div class="card-block bg-info">
                                    <h6 class=" display-4 text-center customCSS " style="padding-top:-10px;margin-top:-3%"><?php echo 'Classes Count' ?></h6>
                                    <h1 class="display-1 text-center customCSS"><?php echo $classesCount  ?></h1>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-6">
                            <div class="card card-inverse card-warning">
                                <div class="card-block bg-warning">
                                    <h6 class=" display-4 text-center customCSS " style="padding-top:-10px;margin-top:-3%"><?php echo 'Subjects Count' ?></h6>
                                    <h1 class="display-1 text-center customCSS"><?php echo $subjectsCount  ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->