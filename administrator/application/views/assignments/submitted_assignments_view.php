<div>
    <section class="sec search">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-top:20px">
                    <h2 style="color:#0D4F8B;">Submitted Assignments</h2>
                    <div class="orange_line2" style="margin-left:415px;width: 27%; margin-top:10px"></div>
                </div>
            </div>
            <div class="row" style="padding-top: 40px;padding-bottom: 20px;padding-left:300px;">
                <div class="col-md-5">
                    <h4 style="color:#0D4F8B;">Chapter: <font style="color:#f27a21;"><?php echo $chapter_name ?></font>
                    </h4>

                </div>
                <div class="col-md-7">
                    <h4 style="color:#0D4F8B;">Class: <font style="color:#f27a21;"><?php echo $class ?></font>
                    </h4>
                </div>
                <div class="col-md-4">
                    <h4 style="color:#0D4F8B;">Subject: <font style="color:#f27a21;"><?php echo $subject ?></font>
                    </h4>
                </div>

                <div class="col-md-8" style="left: 50px;">
                    <button name="view_lecture_by_students_Class" type="submit" value="" class="btn btn-success btn-sm active " onclick="window.location.href='<?php echo base_url(); ?>assignments/assignments_logs/download_all_assignments/'+ '<?php echo $class; ?>/'+'<?php echo $chapter_name ?>/'+'<?php echo $chapter_id ?>'">Download All</button>
                </div>
            </div>
            <div class="row">
                <div class="panel-body">
                    <?php if (!empty($students_data)) { ?>
                        <div class="alert"></div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover " id="simple-table">
                                <thead>
                                    <tr>
                                        <!-- <th class="center" width="5%">
                                            <label class="pos-rel">
                                                <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                <span class="lbl"></span>
                                            </label>
                                        </th> -->
                                        <th style="background-color:#26466D; color:white ;width:2%;text-align:center">Student</th>
                                        <th style="background-color:#26466D; color:white ;width:2%;text-align:center">Uplaoded On</th>
                                        <th style="background-color:#26466D; color:white;width:2%;text-align:center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($students_data as $student_data) { ?>
                                        <tr>
                                            <!-- <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace case" name="case" value="1">
                                                    <span class="lbl"></span>
                                                </label>
                                            </td> -->
                                            <td style="text-align: center;"><?php echo $student_data['student_name']; ?></td>
                                            <td style="text-align: center;">

                                                <?php
                                                if ($student_data['inserted_on'] != '0000-00-00 00:00:00') {
                                                    $dt = new DateTime($student_data['inserted_on']);
                                                    $date = $dt->format('d-m-y');
                                                    echo $date;
                                                } else {
                                                    echo '00-00-0000';
                                                }
                                                ?>
                                            </td>
                                            <td style="text-align: center;">
                                                <!-- <?php //echo form_open('Lectures/lecturesClassWise'); 
                                                        ?> -->
                                                <a href="<?php echo base_url('assignments/assignments_logs/download_assignment' . '/' . $chapter_id . '/' . $student_data['student_id'] . '/' . $student_data['class']); ?>" name="view_lecture_by_students_Class" title="Download Assignment" type="submit" value="" class="btn btn-info active"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>
                                                <!-- <?php //echo form_close(); 
                                                        ?> -->
                                            </td>

                                        </tr>
                                    <?php } ?>

                                </tbody>
                            </table>
                        </div>

                    <?php } else { ?>
                        <div class="padding_null">
                            <b>Records Not Found.</b>
                        </div>
                    <?php } ?>

                </div>
                <!--panel-body-->
                <!-- </div> -->
                <!--panel-->
            </div>
            <!--col9-->
            <div class="clearfix"></div>
        </div>
        <!--row-->
</div>
<!--container-->
</section>
<div class="clearfix"></div>
</div>