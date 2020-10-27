<div style="height: 100vh">
    <section class="sec search">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="text-align:center;margin-top:20px">
                    <h2 style="color:#26466D;">Assignment Logs</h2>
                    <div class="orange_line2" style="margin-left:460px;width: 19%; margin-top:10px"></div>
                </div>
                <!--col12-->
                <div class="clearfix"></div>
                <br />
                <div class="col-md-12" style="margin-top: 2%;">
                    <div class="panel-body">
                        <?php if (!empty($records)) { ?>
                            <div class="alert"></div>
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="simple-table">
                                    <thead>
                                        <tr>
                                            <!-- <th class="center" width="5%">
                                            <label class="pos-rel">
                                                <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                <span class="lbl"></span>
                                            </label>
                                        </th> -->
                                            <th style="background-color:#26466D; color:white ;width:20%;text-align:center">Name Of Chapter</th>
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Subject</th>
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Class</th>
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Given On</th>
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Action</th>
                                            <!-- <th style="background-color:#26466D; color:white ;width:5%;text-align:center">Action</th> -->
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
                                                <td><?php echo $record['name']; ?></td>
                                                <td style="text-align:center"><?php echo $record['subject']; ?></td>
                                                <td style="text-align:center"><?php echo $record['class']; ?></td>
                                                <td style="text-align:center">
                                                    <?php
                                                    if ($record['inserted_on'] != '0000-00-00 00:00:00') {
                                                        $dt = new DateTime($record['inserted_on']);
                                                        $date = $dt->format('d-m-y');
                                                        echo $date;
                                                    } else {
                                                        echo '00-00-0000';
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align:center">
                                                    <button name="view_lecture_by_students_Class" type="submit" value="" class="btn btn-danger btn-xs active" onclick="window.location.href='<?php echo base_url(); ?>assignments/assignments_logs/submitted_assignments/'+ '<?php echo $record['name']; ?>/'+'<?php echo $record['class']; ?>/' + '<?php echo $record['subject']; ?>/'+ '<?php echo $record['chapter_id']; ?>'">View Status</button>
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

                    <!--panel-->
                </div>
                <!--col9-->
                <div class="clearfix"></div>
            </div>
            <!--row-->
        </div>
        <!--container-->
    </section>
</div>
<div class="clearfix"></div>
<div id="ajaxspinner" class="modal">
    <i class="fas fa-spinner fa-spin fa-3x fa-fw" style="display:none" "></i>
</div>
<!-- <i id=" ajaxspinner" class="fas fa-spinner "></i> -->