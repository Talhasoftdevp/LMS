<div style="height: 100vh">
    <section class="sec search">
        <div class="container">
            <div class="row">
                <div class="col-md-12" style="margin-left: 20px;">
                    <h4>Lectures of Class <?php echo $class ?></h4>
                    <div class="orange_line2" style="width: 18%; margin-top:2px"></div>


                </div>
                <!--col12-->
                <div class="clearfix"></div>
                <br />

                <div class="col-md-12">
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
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Teacher</th>
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Added On</th>
                                            <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($records as $record) { ?>
                                            <tr>
                                                <td><?php echo $record['name']; ?></td>
                                                <td style="text-align:center"><?php echo $record['subject']; ?></td>
                                                <td style="text-align:center"><?php echo $record['teacherName']; ?></td>
                                                <td style="text-align:center">
                                                    <?php
                                                    if ($record['inserted_on'] != '0000-00-00 00:00:00') {
                                                        $dt = new DateTime($record['inserted_on']);
                                                        $date = $dt->format('d-m-y');
                                                        echo $date;
                                                    } else {
                                                        echo '0000-00-00';
                                                    }
                                                    ?>
                                                </td>
                                                <td style="text-align: center;">
                                                    <a href="<?php echo base_url('Lectures/start_lecture' . '/' . $record['chapter_id'] . '/' . $student_id . '/' . $class . '/' . $record['subject']); ?>" name="view_lecture_by_students_Class" title="View Lecture" type="submit" target="_blank" value="<?php echo $record['chapter_id']; ?>" class="btn btn-info active"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                    <a href="<?php echo base_url('Lectures/download_assignment' . '/' . $record['chapter_id'] . '/' . $student_id . '/' . $class); ?>" name="view_lecture_by_students_Class" title="Download Assignment" type="submit" target="_blank" value="<?php echo $record['chapter_id']; ?>" class="btn btn-info active"><i class="fa fa-arrow-circle-down" aria-hidden="true"></i></a>
                                                    <button id="uploadFile_<?php echo $record['chapter_id'] ?>" name="uploadAssignment" data-toggle="modal" data-target="#uploadFileModal_<?php echo $record['chapter_id'] ?>" data-id="<?php echo $record['chapter_id']; ?>" class="btn btn-info active upload_button"><i class="fa fa-upload" aria-hidden="true"></i></button>
                                                    <div class="modal" id="uploadFileModal_<?php echo $record['chapter_id'] ?>" data-backdrop="false" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Upload Assignment</h5>

                                                                </div>
                                                                <!-- <input name="uplaodAssignment" id="upload_Assignment" type="file" multiple /> -->
                                                                <form class="form-horizontal" enctype="multipart/form-data" id="submit" action="<?php echo base_url('lectures/upload_assignment' . '/'  . $student_id . '/' . $class . '/' . $student_name) ?>" method="post" role="form">
                                                                    <div>
                                                                        <div id="uplaodAssignment">
                                                                            <!-- <span>Choose file</span> -->
                                                                            <input type="file" id="files" name="uploadAssignment[]" multiple />
                                                                            <!-- <label for="files">Select file</label> -->
                                                                        </div>
                                                                        <!-- <input type="text"> -->
                                                                        <!-- <div class="file-path-wrapper">
                                                                <input class="file-path validate" type="text" placeholder="Upload your file">
                                                            </div> -->
                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-secondary Upload">Upload</button>
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>

                                            </tr>
                                        <?php } ?> </tbody>
                                </table>
                            </div>
                        <?php } else { ?> <div class=" padding_null">
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
<div id="ajaxspinner" style="position: absolute; top: 50%; left: 50%; display: none">
    <i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i>
</div>