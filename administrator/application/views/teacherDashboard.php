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


            <div class="row">
                <div class="col-md-7">
                    <div class="row form-group row-margining">
                        <div class="col-md-6 col-spacing">
                            <div class="card-success">
                                <div class="card-block  color">
                                    <h6 class=" display-4 text-center h_customCSS"><?php echo 'Classes Assigned' ?></h6>
                                    <h1 class="display-1 text-center h_customCSS"><?php echo $classesAssigned  ?></h1>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-spacing">
                            <div class="card-danger">
                                <div id="assignment_insights" class="card-block color_2" style="cursor:pointer">
                                    <h6 class=" display-4 text-center h_customCSS " style="font-size: 30px;"><?php echo 'Assignment Insights' ?></h6>
                                    <h1 class="display-1 text-center h_customCSS" style="padding-bottom:70px"><span><i class="fa fa-external-link "></i></span></h1>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row row-margining">
                        <div class="col-md-6 col-spacing">
                            <div class="card-info">
                                <div class="card-block color_2">
                                    <h6 class=" display-4 text-center h_customCSS "><?php echo 'Courses Upload' ?></h6>
                                    <h1 class="display-1 text-center h_customCSS"><?php echo $coursesUpload  ?></h1>
                                </div>
                            </div>

                        </div>

                        <div class="col-md-6 col-spacing">
                            <div class="card-warning">
                                <div class="card-block color">
                                    <h6 class=" display-4 text-center h_customCSS "><?php echo 'Subjects Assigned' ?></h6>
                                    <h1 class="display-1 text-center h_customCSS"><?php echo $subjectsAssigned  ?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-5">

                    <div class="color_3">
                        <h1 class=" display-4 text-center h_customCSS_2 "><button id="createCourse" class="button">Create Course</button></h1>
                        <h1 class="display-1 text-center h_customCSS_3"><button id="manageCourse" class="button2">Manage Course</button></h1>
                        <h1 class=" display-4 text-center h_customCSS_4 "><button id="createLiveSession" class="button3">Create Live Session</button></h1>
                        <h1 class=" display-4 text-center h_customCSS_5 "><button id="manageLiveSession" class="button3">Manage Live Sessions</button></h1>
                    </div>
                </div>
            </div>
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->