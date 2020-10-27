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
            <li class="list-group-item active"><a href="<?php echo base_url(); ?>history">Search history</a></li>
            <li class="list-group-item"><a href="<?php echo base_url(); ?>settings">Settings</a></li>
        </ul>
    </div><!--col3-->
    <div class="col-md-9">
    	<div class="panel panel-primary">
        	<div class="panel-heading">Search History</div>
            <div class="panel-body">
                <form action="<?php echo base_url(); ?>entity/search" method="post" id="search_form" method="post" role="form">
                        <div class="col-md-6">
                            <label for="company_name">Search Key</label>
                            <input id="name" value="" name="first_name" type="text">                            
                        	<label for="">Refrence</label>
                            <input id="alias" value="" name="alias" type="text">
							<label for="company_name">From</label>
                            <input id="from" value="" name="from" class="datepicker" type="text">
                        </div><!--col-->
                    	<div class="col-md-6">
                        	<label for="">Timeframe</label>
                            <input id="timeframe" value="" name="timeframe"  type="text">
                            <label for="">The Last Days</label>
                            <input id="lastdays" value="" name="lastdays"  type="text">
							<label for="">To</label>
                            <input id="to" value="" name="to" class="datepicker" type="text">
							<div class="clear"></div>
							<input type="submit" name="btn" value="SUBMIT" />
                        </div><!--col-->
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