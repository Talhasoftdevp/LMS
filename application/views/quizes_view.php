<section class="sec search">
<div class="container">
<div class="row">
	<div class="col-md-12">
    	<h4>Trainings</h4>
        <div class="orange_line2"></div>
        
    </div><!--col12-->
    <div class="clearfix"></div>
    <br />

    <div class="col-md-12">
    	<div class="panel panel-primary">
        	<div class="panel-heading">Total Trainings > <strong><?php echo count($records);?></strong>
            <div  style="display:inline-block;float:right;">
                                <a href="<?php echo base_url().$this->uri->segment(1);?>/out" class="btn btn-xs btn-warning">
                                    Log Out
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
                                                <th>Presentation</th>
                                                <th>Assign by</th>
                                                <th>Assign on</th>
                                                <th>Expiry</th>
                                                <th class="align-center hidden-480">Status</th>                                                
                                                <th width="5%">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                       		<?php foreach ($records as $record) { ?>                                                       
                                                <tr>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox"   class="ace case" name="case" value="1">
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td><?php echo $record['name']; ?></td>
                                                    <td>Admin</td>
                                                    <td>
													<?php
													if($record['inserted_on'] !='0000-00-00 00:00:00'){
													$dt = new DateTime($record['inserted_on']);
													$date = $dt->format('Y-m-d');
													echo $date; 
													}else{
													echo '0000-00-00';	
													}
													?>
                                                    </td>
                                                    <td><?php echo $record['expiry']; ?></td>
                                                    
                                                    <td class="align-center">
                                                       <?php if($record['status'] == 0){ ?>
													        <span class=" label label-success label-xl">Available</span>
                                                       <?php } ?>
                                                       <?php if($record['status'] == 1){ ?>
				                       <?php                                                            	
																	$total_questions = $record['right_answer']+$record['wrong_answer']+$record['unanswered'];
																	$percentage = round(($record['right_answer']/$total_questions)*100,2);
																	$percentage;
																	$remarks = ($percentage >= 70) ? '<span class=" label label-primary label-xl">Passed</span>' : '<span class="label label-danger label-xl">Failed</span>';
																	echo $remarks;
																
															
															?>
                                                       <?php } ?>
                                                       <?php if($record['status'] == 2){ ?>
													        <span class=" label label-warning label-xl">Time barred</span>
                                                       <?php } ?>
                                                       <?php if($record['status'] == 3){ ?>
													        <span class=" label label-danger label-xl">Expired</span>
                                                       <?php } ?>	
                                                    </td>                                                    
                                                    <td>
                                                        <?php include(APPPATH . 'views/crude_elearning.php'); ?>
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
</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>