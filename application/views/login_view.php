<style>
.custom-bullet li {
    display: flex;
	font-style: normal;
    font-variant: normal;
    font-weight: normal;
    font-size: 14px;
    line-height: normal;
    font-family: Lato;
    color: #6d6d6d;
	padding: 3px 0px;

}

.custom-bullet li:before
{
    /*Using a Bootstrap glyphicon as the bullet point*/
       content: "\f111";
    font-family: fontawesome;
    font-size: 10px;
    margin-right: 10px;
}

.login p{ line-height:20px; text-align:justify;}
.gray p{ line-height:20px; text-align:justify;}
.table th{text-align:center;}

</style>
<section class="sec login">
<div class="container">
<div class="row">
<?php /*?><!--<?php if($this->session->flashdata('msg')){ ?>
     <div class="alert show <?php echo ($this->input->get('msg')=='logout')?'alert-success':'alert-danger'; ?>">
     	<a class="close" data-dismiss="alert">
        	<i class="ace-icon fa fa-times"></i>
        </a>
        <?php echo $this->session->flashdata('msg');?>
        </div>
     <?php } ?>--><?php */?>

    <div class="col-md-6">
    	<?php /*?><!--<div class="box5">
        	<h5>Signup</h5>
            <div class="orange_line2"></div>
        	<?php echo form_open(base_url() . 'login/sign_up', array('id' => 'user_signup')); ?>
            	<label for="">Full Name</label>
                <input type="text" name="full_name"/>
                <div class="clearfix"></div>
                <label for="age">Age</label>
                <input type="text" name="age"/>
                <div class="clearfix"></div>
                <label for="email">Email</label>
                <input type="text" name="email"/>
                <div class="clearfix"></div>
                <label for="password1">Passowrd</label>
                <input type="password" name="password1"/>
                <div class="clearfix"></div>
                <label for="password2">Re enter Password</label><input type="password" name="password2"/>
                <div class="clearfix"></div>
                <input type="submit" name="btn" value="SUBMIT" />
            <?php echo form_close(); ?>
		</div>--><?php */?>
        
        <h5>World Compliance Check Screening</h5>
        <div class="orange_line2"></div>
        <p>World Compliance Check Screening Analyzer program, is the state of art screening and filtering system, developed keeping in parameters of the U.SA. Patriot Act and leading Regulators of the World. </p>
        <br />
        <p>World leading Financial Institutions, in the fields of Banking, Credit Unions, Insurance, Gaming, Auto/Boat Sales are using our platform to make their businesses safe.</p>
        <br />
        <p>World Compliance Check Screening Analyzer is a user friendly and easy to use solution which comes in various forms of packages.  The improvement and evolution of the World Check Screening Analyzer is 100% driven by the demands, desires and suggestions of our clients.</p>
        <br />
        <ul class="custom-bullet">
        	<li>Search the latest OFAC, BIS/BXA, OSFI, FBI (Complete List).</li>
            <li>Easy to Use, Search Forms (Person's Name, Company, Misc).</li>
            <li>Search List of Names.</li>
            <li>Instant Search Results</li>
            <li>Search Reports</li> 
            <li>Unlimited Searches (NO per search charge).</li>  
            <li>Historical/Audit Reports.</li>         
            <li>Search Logs.</li>
            <li>3 Access Point - Multi-User.</li>
            <li>Customer Support (Phone/Email/Chat).</li>
        </ul>

        
    </div><!--col-->
	<div class="col-md-6">
    		<div class="box5">
    		<?php if($this->session->flashdata('msg')){ ?>
             <div class="alert show <?php echo ($this->input->get('msg')=='logout')?'alert-success':'alert-danger'; ?>">
                <a class="close" data-dismiss="alert">
                    <i class="ace-icon fa fa-times"></i>
                </a>
                <?php echo $this->session->flashdata('msg');?>
                </div>
             <?php } ?>
        	<h5>Login</h5>
            <div class="orange_line2"></div>
        	<?php echo form_open(base_url() . 'login/in', array('id' => 'user_login')); ?>
            	<label for="email">Email</label>
                <input type="text" name="email"/>
                <div class="clearfix"></div>
                <label for="password">Password</label>
                <input type="password" name="password"/>
                <div class="clearfix"></div>
                <input  type="submit" name="btn" value="SUBMIT"/>
            <?php echo form_close(); ?>
            </div>
            
            <br />
            <br />
            <div class="clearfix"></div>
            <h5>Compliance Database Listing</h5>
        	<div class="orange_line2"></div>
            
            <table width="100%" class="table table-bordered">
            	<thead>
                	<tr>
                    	<th width="30%"><strong>Source</strong></th>
                        <th width="70%"><strong>Description</strong></th>
                    </tr>
                </thead>
                <tbody>
                	<tr>
                    	<td>OFAC</td>
                        <td>(SDN) Specially Designated Nationals List</td>                        
                    </tr>
                    <tr>
                    	<td></td>
                        <td>(OFCL) Consolidated List</td>                        
                    </tr>
                    <tr>
                    	<td>BIS</td>
                        <td>BIS Denied Persons/Unverified List/Entity List</td>                        
                    </tr>
                    <tr>
                    	<td>Canada</td>
                        <td>(OSFI)</td>                        
                    </tr>
                    <tr>
                    	<td>Europe</td>
                        <td>HM Treasury Sanction List</td>                        
                    </tr>
                    <tr>
                    	<td></td>
                        <td>European Union Sanction List</td>                        
                    </tr>
                    <tr>
                    	<td>UN</td>
                        <td>United Nations 1267 List</td>                        
                    </tr>
                </tbody>
            </table>
        
    </div><!--col-->


</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>