<div style="height: 100vh;">
    <section class="sec search">
        <div class="container">
            <div class="row">
                <!-- <div class="col-md-12">
                <h4>Trainings</h4>
                <div class="orange_line2"></div>

            </div> -->
                <!--col12-->
                <div class="clearfix"></div>
                <br />

                <div class="col-md-12">
                    <!-- <div class="panel panel-primary"> -->
                    <!-- <div class="panel-heading" style="height: 40px;">
                        <div style="display:inline-block;float:right; height:30px">
                            <a href="<?php echo base_url() . $this->uri->segment(1); ?>/out" class="btn btn-xs btn-warning">
                                Log Out
                            </a>
                        </div>
                    </div> -->

                    <div class="panel-body">
                        <?php if (!empty($records)) { ?>
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
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Student</th>
                                            <th style="background-color:#26466D; color:white;width:10%;text-align:center">Class</th>
                                            <th style="background-color:#26466D; color:white;width:10%;text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($records as $record) { ?>
                                            <tr>
                                                <!-- <td class="center">
                                                <label class="pos-rel">
                                                    <input type="checkbox" class="ace case" name="case" value="1">
                                                    <span class="lbl"></span>
                                                </label>
                                            </td> -->
                                                <td style="text-align: center;"><?php echo $record['name']; ?></td>
                                                <td style="text-align: center;"><?php echo $record['class']; ?></td>
                                                <td style="text-align: center;">
                                                    <!-- <?php //echo form_open('Lectures/lecturesClassWise'); 
                                                            ?> -->
                                                    <button name="view_lecture_by_students_Class" type="submit" value="<?php echo $record['class']; ?>" class="btn btn-warning active" onclick="window.location.href='<?php echo base_url(); ?>lectures/lecturesClassWise/'+ '<?php echo $record['class']; ?>/'+ '<?php echo $record['student_id']; ?>/'+ '<?php echo $record['name']; ?>'  ">Browse Lectures</button>
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