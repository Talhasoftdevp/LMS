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

                                <a href="<?php echo base_url($segment_1n2);?>/create" class="btn btn-xs btn-success">
                                    Create Record
                                </a>

                            </div>
                        </div>

                        <div class="widget-body">
                            <div class="widget-main">
                                <?php if (!empty($records)) { ?>
                                <div class="alert alert-danger"></div>    
                                    <table class="table table-striped table-bordered table-hover" id="simple-table">
                                        <thead>
                                            <tr>
                                                <th class="center" width="5%">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                        <span class="lbl"></span>
                                                    </label>
                                                </th>
                                                <th width="10%">Image</th>
                                                <th width="30%">Title</th>
                                                <th class="align-center hidden-480" width="50%">Headline</th>
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($records as $record) { ?>                                                       
                                                <tr>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox"   class="ace case" name="case" value="<?php echo $record[$row_id]; ?>">
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="profile-picture">
                                                            <img width="70px" height="70px" src="<?php echo base_url() . 'upload/news/'.((!empty($record['image']))? $record['image'] :'profile-pic.jpg'); ?>" id="avatar" class="editable img-responsive" />
                                                        </span>
                                                    </td>
                                                    <td><?php echo $record['title']; ?></td>
                                                    <td class="align-center">
                                                        <?php echo $record['headline']; ?>
                                                    </td>
                                                    <td>
                                                        <?php include(APPPATH . 'views/crude.php'); ?>
                                                    </td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table> 
                                    
                                    
                                    <div class="dt-panelfooter clearfix">
                                    <div class="dataTables_info" id="exampleTableTools_info" role="status" aria-live="polite">Total entries: <strong><?php echo $number_of_records; ?></strong></div>
                                    <div class="dataTables_paginate paging_simple_numbers" id="exampleTableTools_paginate"> 
                                    <?php echo $this->pagination->create_links(); ?>                                       
                                    </div></div>
                                    
                                    
                                    
                                    
                                    

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
