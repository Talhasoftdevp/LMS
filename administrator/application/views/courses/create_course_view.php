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
                                <li class="active"><?php echo $title; ?></li>
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
                            $action = base_url($segment_1n2) . '/update_action';
                        } else {
                            $action = base_url($segment_1n2) . '/create_action';
                        }
                        ?>
                        <div class="widget-body">
                            <div class="widget-main">
                                <div class="row">
                                    <div class="col-md-12">
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
                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Chapter </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" class="col-xs-10 col-sm-6" name="chapter" id="chapter" placeholder="Name" value="<?php echo ($edit == TRUE) ? $record_info['name'] : ''; ?>" />
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-2">Content</label>

                                                    <div class="col-sm-10">
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover" id="simple-table_">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="0.5%">Type</th>
                                                                        <!-- <th>Name</th>
                                                                <th>sort</th> -->
                                                                        <th width="0.5%">Content</th>
                                                                        <!-- <th width="5%">Action</th> -->
                                                                    </tr>
                                                                </thead>

                                                                <tbody>
                                                                    <?php $count = 1; ?>
                                                                    <?php if ($edit == TRUE) { ?>

                                                                        <tr id="row_<?php echo $count; ?>">
                                                                            <td>
                                                                                <select class="content_type" name="content_type" id="content_type">
                                                                                    <!-- <option value="0" hidden>Please Select Content Type</option> -->
                                                                                    <option value="1">PDF file</option>
                                                                                    <option value="2" selected>Youtube Link</option>
                                                                                </select>
                                                                            </td>
                                                                            <!-- <td><input type="text" class="col-xs-10 col-sm-10" name="name[]" id="name_<?php //echo $count; 
                                                                                                                                                            ?>" /></td>
                                                                    <td><input type="number" class="col-xs-10 col-sm-10" name="sort[]" id="sort_<?php //echo $count; 
                                                                                                                                                ?>" /></td> -->
                                                                            <td><input id="choice" type="text" value='<?php echo $youtube_link; ?>' class="col-xs-10 col-sm-12" name="choice" /></td>
                                                                            <!-- <td><button type="button" class="btn btn-danger btn-sm remove" data-id="<?php //echo $count; 
                                                                                                                                                            ?>">X</button></td> -->
                                                                        </tr>
                                                                    <?php } else { ?>
                                                                        <tr id="row_<?php echo $count; ?>">
                                                                            <td>
                                                                                <select class="content_type" name="content_type" id="content_type">
                                                                                    <option value="0" hidden>Please Select Content Type</option>
                                                                                    <option value="1">PDF file</option>
                                                                                    <option value="2">Youtube Link</option>
                                                                                </select>
                                                                            </td>
                                                                            <!-- <td><input type="text" class="col-xs-10 col-sm-10" name="name[]" id="name_<?php //echo $count; 
                                                                                                                                                            ?>" /></td>
                                                                    <td><input type="number" class="col-xs-10 col-sm-10" name="sort[]" id="sort_<?php //echo $count; 
                                                                                                                                                ?>" /></td> -->
                                                                            <td><input id="choice" type="file" class="col-xs-10 col-sm-12" name="pdf" /></td>
                                                                            <!-- <td><button type="button" class="btn btn-danger btn-sm remove" data-id="<?php //echo $count; 
                                                                                                                                                            ?>">X</button></td> -->
                                                                        </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- <button type="button" class="btn btn-sm add_more" data-id="<?php //echo $count; 
                                                                                                                        ?>">Add more</button> -->
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label class="col-sm-2 control-label no-padding-right" for="form-field-1"> Assignment </label>
                                                    <div class="col-sm-9">
                                                        <input name="assignment" type="file" class="col-xs-10 col-sm-6" value="" />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <?php if ($edit == TRUE) { ?>
                                                    <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" />
                                                <?php } ?>

                                                <?php if ($edit == TRUE) { ?>
                                                    <input type="hidden" name="record_created_date" value="<?php echo $record_info['inserted_on']; ?>" />
                                                <?php } ?>

                                                <input type="hidden" name="TeacherName" value="<?php echo $this->session->userdata("username"); ?>" />

                                            </div>
                                        </form>

                                    </div><!-- /.widget-main -->
                                </div><!-- /.widget-body -->
                            </div>
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