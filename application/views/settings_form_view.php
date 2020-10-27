<section class="sec search">
<div class="container">
<div class="row">
	<div class="col-md-12">
    	<h4>Search</h4>
        <div class="orange_line2"></div>
        <h5>Search criteria</h5>
    </div><!--col12-->
    <div class="clearfix"></div>
    <div class="col-md-3">
        <ul class="list-group">
            <li class="list-group-item"><a href="<?php echo base_url(); ?>search">Individual</a></li>
            <li class="list-group-item"><a href="<?php echo base_url(); ?>entity">Entity</a></li>
            <li class="list-group-item"><a href="<?php echo base_url(); ?>aircraft">Vessel/Aircraft</a></li>
            <li class="list-group-item"><a href="<?php echo base_url(); ?>history">Search history</a></li>
            <li class="list-group-item active"><a href="<?php echo base_url(); ?>settings">Settings</a></li>
        </ul>
    </div><!--col3-->
    <div class="col-md-9">
    	<div class="panel panel-primary">
        	<div class="panel-heading">Settings > <strong><?php echo $this->session->userdata('no_of_subusers'); ?> subscribers allowed</strong>
            <div  style="display:inline-block;float:right;">
                                <a href="<?php echo base_url().$this->uri->segment(1); ?>" class="btn btn-xs btn-success">
                                    Back
                                </a>
                            </div>        
                            <div  style="display:inline-block;float:right; margin-right:4px;">
                                <a href="#" id="save"  class="btn btn-xs btn-info">
                                    <?php echo ($edit==TRUE)?'Update':'Save'; ?> Record
                                </a>
                            </div>
            </div>
             <?php
                        if ($edit == TRUE) {
                        $action = base_url().$this->uri->segment(1).'/update_action';
                        } else {
                        $action = base_url().$this->uri->segment(1).'/create_action';
                        }
                        ?>
            <div class="panel-body">
            	<form class="form-horizontal" action="<?php echo $action; ?>" id="<?php echo $this->uri->segment(1) . '_form'; ?>" method="post" role="form">
                                        <div class="alert alert-danger"></div>    
                                        <div class="col-md-6">
                                        	<label for="">Company Name</label>
                                            <input type="text" id="name" value="<?php echo ($edit==TRUE)? $record_info['user_name']:''; ?>" name="user_name" placeholder="Name" />
                                            <label for="">Email</label>
                                            <input type="text" id="email" value="<?php echo ($edit==TRUE)? $record_info['email']:''; ?>" name="email" placeholder="Name" />
                                            <label for="">Password</label>
                                            <input type="text" id="father_name" value="" name="password" placeholder="<?php echo ($edit == true)? 'Leave Empty if you Dont Want To Change Password' : '' ?>" />                                            
                                        </div> 
                                        <?php if($edit==TRUE){?>
                                          <input type="hidden" name="<?php echo $row_id; ?>" value="<?php echo $record_info[$row_id]; ?>" />
                                        <?php } ?>                             
                                    </form>
                
			</div><!--panel-body-->
		</div><!--panel-->
    </div><!--col9-->
    <div class="clearfix"></div>            
    <!-- SEARCH RESULTS -->
    <div class="col-md-12">
    <h5>Search results</h5>
    <!--<iframe scrolling="yes" src="http://api.ofac-analyzer.com/reportView.aspx?rptId=S1&ofacId=812348&searchKey=1317327&rptType=P"></iframe>-->
    </div><!--col12-->
    
</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>