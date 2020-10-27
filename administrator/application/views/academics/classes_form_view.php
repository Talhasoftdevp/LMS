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
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Class </label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="class" value="<?php echo ($edit == TRUE) ? $record_info['class'] : ''; ?>" name="class" placeholder="Please Input Value for Class" class="col-xs-7 col-sm-7" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Section </label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="section" value="<?php echo ($edit == TRUE) ? $record_info['section'] : ''; ?>" name="section" placeholder="Please Input Value for Section" class="col-xs-7 col-sm-7" />
                                                </div>
                                            </div>
                                            <div class="form-group field_wrapper">
                                                <?php if ($edit == TRUE) {
                                                    for ($initial = 0; $initial < 1; $initial++) { ?>
                                                        <label class=" col-sm-3 control-label no-padding-right" for="form-field-1"> Subject </label>
                                                        <div class="col-sm-9">
                                                            <input type="text" id="section" value="<?php echo $record_info['subject'] ?>" name="subject[]" placeholder="Please Input Value for Section" class=" col-sm-10" style='width:15em;margin-bottom:15px' />

                                                        </div>
                                                    <?php }
                                                } else { ?>
                                                    <label class=" col-sm-3 control-label no-padding-right" for="form-field-1"> Subject </label>
                                                    <div class="col-sm-9">
                                                        <input type="text" id="subject_" value="" placeholder="Please Input Value for Subject" class="col-xs-10 col-sm-10" style='width:15em;margin-bottom:15px' />
                                                        &nbsp; <button data-id="1" type="button" class="btn btn-success btn-sm add">Add Subject</button>
                                                    </div>
                                                <?php } ?>
                                            </div>


                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                        <?php /*?><!--<div class="form-group">
                                                                <div class="col-xs-5">
                                                                    <span class="profile-picture">
                                                                        <img src="<?php echo base_url() . 'upload/customer/'.((!empty($record_info['avatar']))? $record_info['avatar'] :'profile-pic.jpg'); ?>" id="avatar" class="editable img-responsive" />
                                                                    </span>           
                                                                </div>
                                                            </div>--><?php */ ?>

                                                    </div>
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
    <div id="ajaxspinner" class="modal">
        <i class="fas fa-spinner fa-spin fa-3x fa-fw" style="display:none" "></i>
    </div>