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
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Company Name </label>
                                                <div class="col-sm-9">
                                                    <input type="text" id="name" value="<?php echo ($edit==TRUE)? $record_info['user_name']:''; ?>" name="user_name" placeholder="Name" class="col-xs-10 col-sm-10" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-3">Email</label>

                                                <div class="col-sm-9">
                                                    <input type="text" id="email" value="<?php echo ($edit==TRUE)? $record_info['email']:'' ; ?>" name="email" placeholder="email" class="col-xs-10 col-sm-10" />
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-2">Password</label>

                                                <div class="col-sm-9">
                                                    <input type="password" id="password" value="" name="password" placeholder="<?php echo ($edit == true)? 'Leave Empty if you Dont Want To Change Password' : '' ?>" class="col-xs-10 col-sm-10" />
                                                </div>
                                            </div> 
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1"> Presentation </label>
                                                <div class="col-sm-9">
                                                    <select name="press_id" id="press_id" class="col-xs-5 col-sm-5" >
                                                    	<?php if(!empty($presentations)){?>
                                                        	<?php foreach($presentations as $presentation){ ?>
                                                        	<option value="<?php echo $presentation['presentation_id']; ?>" ><?php echo $presentation['name']; ?></option>
                                                        	<?php } ?>
														<?php } ?>
                                                    </select>
                                                    &nbsp; <input type="text" name="exp_date" id="exp_date" readonly="readonly"  class="datepicker"/> 
                                                    &nbsp; <button data-id="1" type="button" class="btn btn-success btn-xs add"><i class="fa fa-plus"></i></button>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-1">Added Presentation </label>
                                                <div class="col-sm-9">
                                                	<?php $count = 1; ?>
                                                    <table width="100%" class="table table-striped table-bordered table-hover" id="simple-table">
                                                        <thead>
                                                            <tr>                                                                
                                                                <th width="50%">Presentation</th>
                                                                <th width="15">Expiry</th>
                                                                <th width="25%">status</th>                                                                                                   
                                                                <th width="10%">Action</th>
                                                            </tr>
                                                        </thead>
                
                                                        <tbody id="press">
                                                        <?php if($edit==TRUE){ ?>
															<?php if($record_info['assignments']){ ?>
                                                                <?php foreach($record_info['assignments'] as $assignment){ ?>
                                                                    <?php $count = $assignment['presentation_id']; ?>
                                                                    <tr id="row_<?php echo $count; ?>"> 
                                                                    <td valign="middle"><?php echo $assignment['name']; ?></td>
                                                                    <td valign="middle"><?php echo $assignment['expiry']; ?></td>
                                                                    <td valign="middle">
                                                                    <?php if($assignment['status'] == 0 || $assignment['status'] == 2){ ?>
                                                                    <span class="label label-success label-xs">New</span>
                                                                    <?php }?>
                                                                    <?php if($assignment['status'] == 1){ ?>
                                                                    <span class="label label-primary label-xs">Attempted</span>
                                                                    <?php }?>
                                                                    <?php if($assignment['status'] == 3){ ?>
                                                                    <span class="label label-danger label-xs">Expired</span>
                                                                    <?php }?>
                                                                    </td> 
                                                                    <td><button data-id="<?php echo $count; ?>" type="button" class="btn btn-danger btn-xs remove_edt"><i class="fa fa-trash"></i></button></td> </tr>
                                                                <?php } ?>                                                        
                                                            <?php } ?>
                                                        <?php } ?>                                                        
                                                        </tbody>
                                                	</table>
                                                    <input type="hidden" name="count" id="count" value="<?php echo $count; ?>" />       
                                                </div>
                                            </div>                                                                                       
                                            <?php /*?><!--<div class="form-group">
                                                <label class="col-sm-3 control-label no-padding-right" for="form-field-4"> Type </label>

                                                <div class="col-sm-9">
                                                    <select name="roles_id" id="roles_id" class="col-xs-10 col-sm-10" >
                                                    	<option value="1" <?php echo($edit == TRUE && $record_info['roles_id'] == 1) ? 'selected=selected' : ''; ?>>Administrator</option>
                                                        <option value="2" <?php echo($edit == TRUE && $record_info['roles_id'] == 2) ? 'selected=selected' : ''; ?>>Analyzer</option>
                                                    </select>                                    
                                                </div>
                                            </div>--><?php */?>
                                            <?php /*?><!--<div class="form-group">
                                                 <label class="col-sm-3 control-label no-padding-right" for="form-field-4">Image</label>
                                                            <div class="col-sm-8">
                                                                <input  type="file" class="col-xs-10 col-sm-10" name="photo"  id="id-input-file-3" />
                                                            </div>
                                                        </div>--><?php */?>            
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <div class="widget-body">
                                                    <div class="widget-main">
                                                            <?php /*?><!--<div class="form-group">
                                                                <div class="col-xs-5">
                                                                    <span class="profile-picture">
                                                                        <img src="<?php echo base_url() . 'upload/customer/'.((!empty($record_info['avatar']))? $record_info['avatar'] :'profile-pic.jpg'); ?>" id="avatar" class="editable img-responsive" />
                                                                    </span>           
                                                                </div>
                                                            </div>--><?php */?> 
                                                       
                                                    </div>
                                                </div>
                                            </div>   
                                            <?php if($edit==TRUE){?>
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

