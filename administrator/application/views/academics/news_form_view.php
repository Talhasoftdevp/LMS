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
                            <div  style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="<?php echo base_url($segment_1n2); ?>" class="btn btn-xs btn-success">
                                    Back
                                </a>
                            </div>        
                            <div  style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="#" id="submit_action"  class="btn btn-xs btn-info">
                                    <?php echo ($edit==TRUE)?'Update':'Save'; ?> Record
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
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Title </label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="title" value="<?php echo ($edit==TRUE)? $record_info['title']:''; ?>" name="title" placeholder="Name" class="col-xs-11 col-sm-11" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Headline</label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="headline" value="<?php echo ($edit==TRUE)? $record_info['headline']:''; ?>" name="headline"  class="col-xs-11 col-sm-11" />
                                                </div>
                                            </div>                                                                                       
                                            <div class="form-group">
                                                 <label class="col-sm-3 control-label no-padding-right" for="form-field-4">Image</label>
                                                            <div class="col-sm-8">
                                                                <input  type="file" class="col-xs-10 col-sm-10" name="image"  id="id-input-file-3" />
                                                            </div>
                                                        </div>            
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-3">Content</label>
                                                <div class="col-sm-9">
                                                    <textarea rows="10" class="col-xs-12 col-sm-12" name="content" id="content"><?php echo ($edit==TRUE)? $record_info['content']:'' ; ?></textarea>                                                    
                                                </div>
                                            </div> 
                                        </div>
                                         <?php if($edit==TRUE){?>
                                            <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" />
                                         <?php } ?>
                                    </form> 

                                </div><!-- /.widget-main -->
                            </div><!-- /.widget-body -->
                        </div>

                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.page-content -->
        </div>
    </div><!-- /.main-content -->

