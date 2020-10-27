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
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Name </label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" value="<?php echo ($edit == TRUE) ? $record_info['user_name'] : ''; ?>" name="user_name" placeholder="Name" class="col-xs-10 col-sm-12" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-3">Email</label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="email" value="<?php echo ($edit == TRUE) ? $record_info['email'] : ''; ?>" name="email" placeholder="email" class="col-xs-10 col-sm-12" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Password</label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="father_name" value="" name="password" placeholder="<?php echo ($edit == true) ? 'Leave Empty if you Dont Want To Change Password' : '' ?>" class="col-xs-10 col-sm-12" />
                                                </div>
                                            </div>

                                            <div class=" form-group field_wrapper">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class </label>
                                                <div class="col-sm-9">
                                                    <select name="class[]" id="class" class="col-xs-5 col-sm-4 classTest class-dropdown-alignment">
                                                        <option hidden>Please Select Class</option>
                                                        <?php if (!empty($classes)) { ?>
                                                            <?php foreach ($classes as $class) { ?>
                                                                <option value="<?php echo $class['class']; ?>"><?php echo $class['class']; ?></option>
                                                            <?php } ?>
                                                        <?php } ?>
                                                    </select>
                                                    &nbsp;
                                                    <select name="section[]" id="sectionID" class="col-xs-5 col-sm-4 sectionTest section-dropdown-alignment" style='left:1%'>
                                                        <option hidden>Please Select Section</option>
                                                    </select>
                                                    &nbsp;
                                                    <select name="subjects[]" id="subjectId" class="col-xs-5 col-sm-4 subjectTest subject-dropdown-alignment" style="right:-1.5%;margin-top: -5.3%;">
                                                        <option hidden>Please Select Subject</option>
                                                    </select> &nbsp;
                                                    <button data-id="1" type="button" class="btn btn-success btn-xs add add-button-alignment" id="addAnother" style="left:32%;"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="form-group" style="margin-left: 25%;">
                                                    <div class="col-md-12 table-alignment">
                                                        <?php $count = 1; ?>
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover" id="simple-table">
                                                                <thead>
                                                                    <tr>
                                                                        <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Class</th>
                                                                        <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Section</th>
                                                                        <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Subject</th>
                                                                        <th style="background-color:#26466D; color:white ;width:25%;text-align:center">Action</th>

                                                                    </tr>
                                                                </thead>

                                                                <tbody id="childs">
                                                                    <?php if ($edit == TRUE) { ?>
                                                                        <?php if ($teacherInfo) { ?>
                                                                            <?php foreach ($teacherInfo as $teacherInfo) { ?>
                                                                                <?php $count = 1; ?>
                                                                                <tr class="table_row_">
                                                                                    <td name="class" value='<?php echo $teacherInfo['class']; ?>' style="text-align: center;"><?php echo $teacherInfo['class']; ?></td>
                                                                                    <input type="hidden" name="classes_assigned[]" value="<?php echo $teacherInfo['class']; ?>" />
                                                                                    <td name="section" value='<?php echo $teacherInfo['section']; ?>' style="text-align: center;"><?php echo $teacherInfo['section']; ?></td>
                                                                                    <input type="hidden" name="section_assigned[]" value="<?php echo $teacherInfo['section']; ?>" />
                                                                                    <td name="subject" value='<?php echo $teacherInfo['subject']; ?>' style="text-align: center;"><?php echo $teacherInfo['subject']; ?></td>
                                                                                    <input type="hidden" name="subject_assigned[]" value="<?php echo $teacherInfo['subject']; ?>" />
                                                                                    <td><button data-id="<?php echo uniqid() ?>" type="button" class="btn btn-danger btn-xs remove"><i class="fa fa-trash"></i></button></td>
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
                                            </div>
                                            <div class="container-fluid col-sm-8.5" style="margin-left:26%;margin-top:-5%">
                                                <div class=" row">
                                                    <!-- <div class="col-sm-3 control-label no-padding-right"></div> -->

                                                    <div id="container"></div>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="">

                                            <?php if ($edit == TRUE) { ?>
                                                <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" />
                                            <?php } ?>
                                        </div>
                                        <div class="form-group" style="display: none">
                                            <label class="col-sm-3 control-label no-padding-right" for="form-field-4">User Id</label>
                                            <div class="col-sm-8">
                                                <input name="user_role" value="Teacher" />
                                            </div>
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