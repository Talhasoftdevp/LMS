<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row">
                <div class="col-md-12">
                    <!-- PAGE CONTENT BEGINS -->

                    <div class="widget-box">
                        <div class="widget-header widget-header-blue widget-header-flat">
                            <ul class="breadcrumb" style="margin: 6px 22px 0 0 !important;">
                                <li>
                                    <i class="ace-icon fa fa-home home-icon"></i>
                                    <a href="#">Home</a>
                                </li>

                                <li>
                                    <a href="#"><?php echo ucfirst($this->uri->segment(1)); ?></a>
                                </li>
                                <!-- <li class="active"><?php echo $title; ?></li> -->
                            </ul><!-- /.breadcrumb -->
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <?php if (!empty($records)) { ?>
                                    <div class="alert alert-danger"></div>
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
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Class</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Subject</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Session Date</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Start Time</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">End Time</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Host Class</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Status</th>
                                                    <th style="background-color:#26466D; color:white ;text-align:center">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($records as $record) { ?>

                                                    <tr>
                                                        <!-- <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" class="ace case" name="case" value="<?php echo $record[$row_id]; ?>">
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td> -->
                                                        <td style="text-align:center"><?php echo $record['class']; ?></td>
                                                        <td style="text-align:center"><?php echo $record['subject']; ?></td>
                                                        <td style="text-align:center">
                                                            <?php
                                                            if ($record['date'] != '0000-00-00 00:00:00') {
                                                                $dt = new DateTime($record['date']);
                                                                $date = $dt->format('d-m-y');
                                                                echo $date;
                                                            } else {
                                                                echo '00-00-0000';
                                                            }
                                                            ?>
                                                        </td>
                                                        <td style="text-align:center"><?php echo date('g:ia', strtotime($record['start_time'])); ?></td>
                                                        <td style="text-align:center"><?php echo date('g:ia', strtotime($record['end_time'])); ?></td>
                                                        <td style="text-align: center;">
                                                            <?php
                                                            date_default_timezone_set("Asia/Karachi");
                                                            if (date('d-m-y') < $date) {
                                                                $status_button_color = 'progress-bar-success';
                                                                $Status = 'Will Be Live';
                                                                $button_clickable = 'disabled';
                                                                $click_status = 'disableClick';
                                                            } else if (date('d-m-y') > $date) {
                                                                $status_button_color = 'progress-bar-danger';
                                                                $Status = 'Expired';
                                                                $button_clickable = 'disabled';
                                                                $click_status = 'disableClick';
                                                            } else if (date('d-m-y') == $date) {
                                                                if (date('g:ia', strtotime(date("H:i"))) >= date('g:ia', strtotime($record['start_time'])) && date('g:ia', strtotime(date("H:i"))) < date('g:ia', strtotime($record['end_time']))) {
                                                                    $status_button_color = 'progress-bar-success';
                                                                    $Status = 'Live';
                                                                    $button_clickable = '';
                                                                    $click_status = '';
                                                                } else if (date('g:ia', strtotime(date("H:i"))) < date('g:ia', strtotime($record['start_time']))) {
                                                                    $status_button_color = 'progress-bar-success';
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
                                                            <a href="<?php echo $record['session_id']; ?>" name="view_lecture_by_students_Class" title="Host Class" type="submit" target="_blank" class="btn btn-info active btn-xs <?php echo $click_status; ?>" <?php echo  $button_clickable ?>>Host Class</a>
                                                        </td>
                                                        <td style="text-align:center">

                                                            <span class="badge status-live-session <?php echo $status_button_color; ?>">
                                                                <?php echo $Status; ?>
                                                            </span>
                                                        </td>
                                                        <td style="text-align:center">
                                                            <?php include(APPPATH . 'views/crude_live_session.php'); ?>
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
                            </div><!-- /.widget-main -->
                        </div><!-- /.widget-body -->
                    </div>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div><!-- /.main-content -->