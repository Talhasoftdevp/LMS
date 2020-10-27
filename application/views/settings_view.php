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
                                <a href="<?php echo base_url().$this->uri->segment(1);?>/create" class="btn btn-xs btn-success">
                                    Create Record
                                </a>
                            </div>
            </div>
            
            <div class="panel-body">
            	 <?php if (!empty($records)) { ?>
                                <div class="alert"></div>    
                                    <table class="table table-striped table-bordered table-hover" id="simple-table">
                                        <thead>
                                            <tr>
                                                <th class="center" width="5%">
                                                    <label class="pos-rel">
                                                        <input type="checkbox" id="check_all" name="check_all" class="ace">
                                                        <span class="lbl"></span>
                                                    </label>
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th class="align-center hidden-480"># of subusers</th>                                                
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
                                                    <td><?php echo $record['user_name']; ?></td>
                                                    <td><?php echo $record['email']; ?></td>
                                                    <td class="align-center">
                                                        <?php echo $record['no_of_subusers']; ?>
                                                    </td>                                                    
                                                    <td>
                                                        <?php include(APPPATH . 'views/crude.php'); ?>
                                                    </td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table> 

                                <?php } else { ?>
                                    <div class="padding_null">
                                        <b>Records Not Found.</b>
                                    </div>
                                <?php } ?>
                
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