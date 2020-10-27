<style>
    .input-disabled {
        background-color: #848484;
    }
</style>
<div class="main-content">
    <div class="main-content-inner">

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
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

                            <h4 class="widget-title lighter"></h4>
                            <div style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="<?php echo base_url(); ?>" class="btn btn-xs btn-success">
                                    Back
                                </a>
                            </div>
                            <div style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="#" id="submit_action" class="btn btn-xs btn-info">
                                    <?php echo ($edit == TRUE) ? 'Update' : 'Save'; ?> Record
                                </a>
                            </div>
                        </div>
                        <?php
                        if ($edit == TRUE) {
                            $action = base_url($segment_1n2) . '/update_action/' . $this->uri->segment(4);
                        } else {
                            $action = base_url($segment_1n2) . '/create_action';
                        }
                        ?>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo $action; ?>" id="<?php echo $this->uri->segment(2) . '_form'; ?>" method="post" role="form">
                                        <div class="alert"></div>
                                        <div class="col-sm-11">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Class </label>
                                                <div class="col-sm-9">
                                                    <select name="class" id="classID" class="col-xs-10 col-sm-6">
                                                        <option hidden>Please Select Class</option>
                                                        <?php if (!empty($classes)) { ?>
                                                            <?php foreach ($classes as $class) { ?>
                                                                <option value="<?php echo $class['class']; ?>" <?php echo ($edit == TRUE && $record_info['class'] == $class['class']) ? 'selected=selected' : ''; ?>><?php echo $class['class']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Subject </label>
                                                <div class="col-sm-9">
                                                    <select name="subject" id="subjectId" class="col-xs-10 col-sm-6 subject">
                                                        <option hidden>Please Select Subject</option>
                                                        <?php if ($edit == TRUE) { ?>
                                                            <?php if (!empty($subjects)) { ?>
                                                                <?php foreach ($subjects as $subject) { ?>
                                                                    <option value="<?php echo $subject['subject']; ?>" <?php echo ($edit == TRUE && $record_info['subject'] === $subject['subject']) ? 'selected=selected' : ''; ?>><?php echo $subject['subject']; ?></option>
                                                                <?php } ?>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Live Session ID </label>
                                                <div class="col-sm-9">
                                                    <input type="text" class="col-xs-10 col-sm-6" name="session_id" id="session_id" placeholder="Please Input Zoom Personal Meeting ID " value="<?php echo ($edit == TRUE) ? $record_info['session_id'] : ''; ?>" />
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Date </label>
                                                <div class="col-sm-9">
                                                    <input type="date" class="" name="date" id="date" placeholder="Please Input Zoom Personal Meeting ID " value="<?php echo ($edit == TRUE) ? $record_info['date'] : ''; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Start Time </label>
                                                <div class="col-sm-2">
                                                    <input type="time" class="" name="start_time" id="start_time" placeholder="Please Input Zoom Personal Meeting ID " value="<?php echo ($edit == TRUE) ? $record_info['start_time'] : ''; ?>" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> End Time </label>
                                                <div class="col-sm-2">
                                                    <input type="time" class="" name="end_time" id="end_time" placeholder="Please Input Zoom Personal Meeting ID " value="<?php echo ($edit == TRUE) ? $record_info['end_time'] : ''; ?>" />
                                                </div>
                                            </div>

                                        </div>
                                        <div class="col-sm-5">
                                            <?php if ($edit == TRUE) { ?>
                                                <!-- <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" /> -->
                                            <?php } ?>

                                            <input type="hidden" name="TeacherName" value="<?php echo $this->session->userdata("username"); ?>" />

                                        </div>
                                    </form>

                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->
    <div id="ajaxspinner" class="modal">
        <i class="fas fa-spinner fa-spin fa-3x fa-fw" style="display:none" "></i>
    </div>
    <!--  -->