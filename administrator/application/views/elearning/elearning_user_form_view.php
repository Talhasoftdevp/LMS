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
                                <a href="<?php echo base_url($segment_1n2); ?>" class="btn btn-xs btn-success">
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
                                    <form class="form-horizontal" enctype="multipart/form-data" action="<?php echo $action; ?>" id="<?php echo $this->uri->segment(2) . '_form'; ?>" method="post" role="form">
                                        <div class="alert"></div>
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>
                                                <div class="col-sm-7 input-fields-width">
                                                    <input type="text" id="user_name" value="<?php echo ($edit == TRUE) ? $record_info['user_name'] : ''; ?>" name="user_name" placeholder="Please Enter Your Name" class="col-xs-10 col-sm-10" />
                                                </div>
                                                <?php echo form_error('user_name'); ?>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right pl5" for="form-field-3">Family Code</label>

                                                <div class="col-sm-7 input-fields-width">
                                                    <input type="text" id="email" value="<?php echo ($edit == TRUE) ? $record_info['email'] : ''; ?>" name="email" placeholder="" class="col-xs-10 col-sm-10" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Password</label>

                                                <div class="col-sm-7 input-fields-width">
                                                    <input type="password" id="password" value="" name="password" placeholder="<?php echo ($edit == true) ? 'Leave Empty if you Dont Want To Change Password' : '' ?>" class="col-xs-10 col-sm-10" />
                                                </div>
                                            </div>
                                            <div class=" form-group field_wrapper">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Student</label>
                                                <div class="col-sm-7">
                                                    <input type="text" name="student" id="student_name" placeholder="Please Input Name of Student" class="col-xs-10 col-sm-10" style="width:13.5em;margin-bottom:15px;height:30px;margin-right:4px">
                                                    &nbsp;
                                                    <select name="class" id="class" class="col-xs-5 col-sm-5" style='width:14em'>
                                                        <option hidden>Please Select Class</option>
                                                        <?php if (!empty($classes)) { ?>
                                                            <?php foreach ($classes as $class) { ?>
                                                                <option value="<?php echo $class['class']; ?>"><?php echo $class['class']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                    &nbsp;
                                                    <button data-id="1" type="button" class="btn btn-success btn-xs add" id="addAnother" style="left:-0.5%;">Add Another</button>
                                                </div>
                                            </div>

                                            <div class="form-group" style="margin-left: 24%;">
                                                <div class="col-sm-8 table-alignment">
                                                    <?php $count = 1; ?>
                                                    <div class="table-responsive">
                                                        <table class="table table-striped table-bordered table-hover">
                                                            <thead>
                                                                <tr>
                                                                    <th style="background-color:#26466D; color:white ;width:50%;text-align:center">Student Name</th>
                                                                    <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Class</th>
                                                                    <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Action</th>

                                                                </tr>
                                                            </thead>

                                                            <tbody id="childs">
                                                                <?php if ($edit == TRUE) { ?>
                                                                    <?php if ($students) { ?>
                                                                        <?php foreach ($students as $student) { ?>
                                                                            <?php $count = $student['student_id']; ?>
                                                                            <tr id="row_<?php echo $count; ?>">
                                                                                <td style="text-align: center;"><?php echo $student['name']; ?></td>
                                                                                <input type="hidden" name="student_name[]" value="<?php echo $student['name']; ?>" />
                                                                                <td style="text-align: center;"><?php echo $student['class']; ?></td>
                                                                                <input type="hidden" name="class[]" value="<?php echo $student['class']; ?>" />
                                                                                <td><button data-id="<?php echo $count; ?>" type="button" class="btn btn-danger btn-xs remove"><i class="fa fa-trash"></i></button></td>
                                                                            </tr>
                                                                        <?php } ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <input type="hidden" name="count" id="count" value="<?php echo $count; ?>" />
                                                </div>
                                            </div>
                                            <?php if ($edit == TRUE) { ?>
                                                <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" />
                                            <?php } ?>
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
    <div id="ajaxspinner" style="position: absolute; top: 50%; left: 50%; display: none">
        <i class="fa fa-spinner fa-spin fa-3x fa-fw" aria-hidden="true"></i>
    </div>