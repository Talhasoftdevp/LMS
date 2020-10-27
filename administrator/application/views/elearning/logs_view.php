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

                            <?php /*?><!--<div  style="display:inline-block;float:right;margin:4px 6px 0px 0px ;">
                                <a href="<?php echo base_url($segment_1n2);?>/create" class="btn btn-xs btn-success">
                                    Create Record
                                </a>
                            </div>--><?php */?>
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
                                                <th>Trainee</th>
                                                <th>Training</th>                                                
                                                <th>Assign on</th>
                                                <th>Status</th>                                                
                                                <th>Marks</th>
                                                <th>remarks</th>                                                
                                                
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
                                                    <td><?php echo $record['training']; ?></td>
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
                                                    <td>
														<?php
														if($record['status'] == 0){ 
															echo "Not attempted"; 
														}
														if($record['status'] == 1){ 
															echo "Attempted"; 
														}
														if($record['status'] == 2){ 
															echo "Time Barred"; 
														}
														if($record['status'] == 3){ 
															echo "Expired"; 
														}
														
														?>
                                                    </td>                                                    
                                                    <td>
                                                    <?php
													 
													if($record['status'] == 1){
														$total_questions = $record['right_answer']+$record['wrong_answer']+$record['unanswered'];
														$percentage = round(($record['right_answer']/$total_questions)*100,2);
														echo $percentage.'%';														
													}else{
														echo '--';
													}
													?>
                                                    </td>
                                                    <td>
                                                    <?php 
													if($record['status'] == 1){
														$total_questions = $record['right_answer']+$record['wrong_answer']+$record['unanswered'];
														$percentage = round(($record['right_answer']/$total_questions)*100,2);
														$percentage;
														$remarks = ($percentage >= 70) ? '<label class="label label-primary">Pass</label>' : '<label class="label label-danger">Fail</label>';
														echo $remarks;
													}else{
														echo '--';
													}
													?>
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
