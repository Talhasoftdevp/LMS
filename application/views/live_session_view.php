<!-- <div class="modal show" id="" data-backdrop="false" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div id="calendar">
            </div>
        </div>
    </div>
</div> -->
<!-- <style>
    .fc-day-grid-event .fc-content {
        white-space: normal;
    }
</style> -->
<?php
//print_r(date_default_timezone_set("Asia/Karachi"));
// print_r(date('d-m-y'))
?>
<div class="container" style="margin-top: 10px;">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-12 text-right" style="top: 33px;">
                    <button class="btn btn-info btn-md active" id="month_view" type="button">Month</button>
                    <button class="btn btn-info btn-md active" id="list_view" name="btn2" value="2" type="button">List</button>
                    <!-- <button class="btn btn-info btn-md" id="list_view" name="btn2" value="2" type="button">Download Zoom</button> -->
                    <a href="https://zoom.us/client/latest/ZoomInstaller.exe" name="Zoom CLient" title="Download Zoom" type="submit" target="_blank" class="btn btn-info btn-md active">Download Zoom</a>
                </div>
            </div>
            <div id="calendar_1">
            </div>
            <div id="calendar_2">
                <div style="height: 100vh">
                    <section class="sec search">
                        <div class="container">
                            <div class="row">
                                <div class="clearfix"></div>
                                <br />
                                <div class="col-md-12">
                                    <div class="panel-body">
                                        <?php if (!empty($records)) { ?>
                                            <div class="alert"></div>
                                            <table class="table table-striped table-bordered table-hover" id="list-view-live-sessions">
                                                <thead>
                                                    <tr>
                                                        <!-- <th class="center" width="5%">
                                                                                        <label class="pos-rel">
                                                                                            <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                                                            <span class="lbl"></span>
                                                                                        </label>
                                                                                    </th> -->
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Subject</th>
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Added On</th>
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Start Time</th>
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">End Time</th>
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Teacher</th>
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Status</th>
                                                        <th style="background-color:#26466D; color:white ;width:10%;text-align:center">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($records as $record) { ?>
                                                        <tr>
                                                            <td style="text-align:center"><?php echo $record['subject']; ?></td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                if ($record['date'] != '0000-00-00 00:00:00') {
                                                                    $dt = new DateTime($record['date']);
                                                                    $date = $dt->format('d-m-y');
                                                                    echo $date;
                                                                } else {
                                                                    echo '0000-00-00';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td style="text-align:center"><?php echo date('g:ia', strtotime($record['start_time'])); ?></td>
                                                            <td style="text-align:center"><?php echo date('g:ia', strtotime($record['end_time'])); ?></td>
                                                            <td style="text-align:center"><?php echo $record['teacher_name']; ?></td>
                                                            <td style="text-align:center">
                                                                <?php
                                                                date_default_timezone_set("Asia/Karachi");
                                                                if (date('d-m-y') < $date) {
                                                                    $status_button_color = 'progress-bar-dark';
                                                                    $Status = 'Will Be Live';
                                                                    $button_clickable = 'disabled';
                                                                    $click_status = 'disableClick';
                                                                } else if (date('d-m-y') == $date) {
                                                                    if (date('g:ia', strtotime(date("H:i"))) >= date('g:ia', strtotime($record['start_time'])) && date('g:ia', strtotime(date("H:i"))) < date('g:ia', strtotime($record['end_time']))) {
                                                                        $status_button_color = 'progress-bar-success';
                                                                        $Status = 'Live';
                                                                        $button_clickable = '';
                                                                        $click_status = '';
                                                                    } else if (date('g:ia', strtotime(date("H:i"))) < date('g:ia', strtotime($record['start_time']))) {
                                                                        $status_button_color = 'progress-bar-dark';
                                                                        $Status = 'Will Be Live';
                                                                        $button_clickable = 'disabled';
                                                                        $click_status = 'disableClick';
                                                                    } else {
                                                                        $status_button_color = 'progress-bar-danger';
                                                                        $Status = 'Expired';
                                                                        $button_clickable = 'disabled';
                                                                        $click_status = 'disableClick';
                                                                    }
                                                                } ?>
                                                                <span class="badge status-live-session <?php echo $status_button_color; ?>">
                                                                    <?php echo $Status; ?>
                                                                </span>
                                                            </td>
                                                            <td style="text-align: center;">
                                                                <a href="<?php echo $record['session_id']; ?>" name="view_lecture_by_students_Class" title="Join Class" type="submit" target="_blank" class="btn btn-info active btn-sm <?php echo $click_status; ?>" <?php echo  $button_clickable ?>>Join Class</a>
                                                            </td>
                                                        </tr>
                                                    <?php } ?> </tbody>
                                            </table> <?php } else { ?> <div class=" padding_null">
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
            </div>
        </div>
    </div>
</div>