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
.solutions p{line-height:20px; text-align:justify;}
</style>
<section class="banner">
<div class="container-fluid">
<div class="row">

	<div class="img_holder">
		<img src="<?php echo base_url(); ?>assets/images/solutions.jpg" alt="banner">        
	</div><!--item-->

</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>

<section class="sec solutions">
<div class="container">
<div class="row">
<div class="col-md-12">
	
    <?php if($tag == 'ca'){?>
	<h4>COMPLIANCE ADVISORY</h4>
    <div class="orange_line"></div>
	<p>At World Compliance Check  steer’s you through the complexities of regulation, from reviews and outsourcing through to setting up your own compliance department:</p>
    <br />
            <ul class="custom-bullet">
                <li>Compliance Reviews</li>
                <li>Compliance Monitoring</li>
                <li>Compliance Outsourcing</li>
                <li>Compliance Advice</li>
                <li>Creating a Compliance Department</li>
                <li>Training and mentoring your Compliance Office</li>
            </ul>
            <br />
			<p><strong>Reviews</strong></p>
            <p>WCC is able to review your compliance arrangements – policies, procedures, resourcing, reporting etc. – to assess how well they meet ever-evolving regulatory expectations. We are able to conduct full compliance reviews or specific examinations of just one area. Reasons you may want to consider the independence and objectivity that only an external expert can provide include:</p>
            <br />
            <ul class="custom-bullet">
                <li>Current best practice - make sure that you are up to date on the best way to stay compliant</li>
                <li>Changes in key personnel - understand your needs when key people join or leave your business</li>
                <li>Impact of take overs of one regulated business by another on the firms’ compliance operations</li>
                <li>Regulatory visits - prepare your business for large scale thematic and other reviews</li>
                <li>Benchmarking - review your current arrangements drawing on WCC’s extensive knowledge of current best practice</li>
                <li>Regulatory due-diligence following changes in senior management or in the event of the acquisition of a new financial services business</li>
            </ul>
            <br />
            <p><strong>Monitoring</strong></p>
            <p>An appropriately comprehensive compliance monitoring programme forms a critical part of a firm’s overall risk management framework. WCC can review your existing monitoring arrangements, identify any deficiencies in coverage and advise on any improvements you need to make.</p>        
			<p><strong>Outsourcing</strong></p>
            <p>For smaller organisations, finding someone with the right expertise to handle all your compliance needs in-house whilst keeping that person motivated and stimulated is a major challenge.</p>
            <p>WCC have a team of experienced compliance professionals who have satisfied the regulator’s requirements to be outsourced Compliance Officers and Money Laundering Reporting Officers. We work with you and your team to help ensure your on-going compliance with all regulatory requirements.</p>
            <br />
            <p><strong>Advice</strong></p>
            <p>Even the largest firms are confronted by compliance issues that they have not come across before. WCC’s depth and breadth of experience means that in most cases WCC’s experienced practitioners can identify a practical compliance solution quickly and cost effectively.</p>
            <p>Some firms like to be assured that they have access to this advice at all times and as part of a continuing relationship with WCC enter into a retainer agreement. The scope of such retainers is agreed with each client on an individual basis. Typically, it can include regular access to WCC’s consultants, regular monitoring reviews and updating of policies and procedures.</p>
            <p>WCC provides day to day support to all types of regulated business across the whole spectrum of compliance on retainer contracts or on an ad-hoc basis.</p>
            <br />
            <p><strong>Creating A Compliance Department</strong></p>
            <p>Following your authorisation, we can help you create your own compliance department - from helping you implement your compliance procedures through to interviewing potential candidates. And once it's up and running, we can keep it running smoothly - with on-going training as well as regular checks and support.</p>
            <?php } ?>
            
            <?php if($tag == 'fcap'){ ?>
            	<h4>FINANCIAL CRIME AND PREVENTION</h4>
                <div class="orange_line"></div>
                <p>Combating financial crime is high on every Firm's and regulators' agenda. Apart from financial loss, regulatory sanctions which include criminal penalties and adverse publicity are highly damaging to any business and career threatening to individuals.</p>
                <p>Many regulated businesses worry about money laundering - and the risks it poses. That's why we've developed a suite of money laundering prevention services, from reviews through to specialist training.</p>
                <br />
                        <ul class="custom-bullet">
                            <li>Policies & Procedures Reviews</li>
                            <li>Sanctions Compliance</li>
                            <li>AML Training</li>
                            <li>MLRO Reporting</li>
                            <li>Anti-Bribery & Corruption</li>
                            <li>Remediation</li>
                            <li>Risk Assessments</li>
                         </ul>
            <?php } ?>
            
            <?php if($tag == 'df'){?>
            	<h4>DOCUMENT FORMULATION</h4>
                <div class="orange_line"></div>
                <p>Is Your Business at Risk?</p>
                <p>Inadequate and ineffective compliance documentation can expose your business to enormous risk. We Are Specialists in Helping Your Business Stay Compliant We can create a comprehensive, practical suite of manuals, Policies and Procedures to meet the precise needs of your business.</p>
                <p>With our support, you will be up to date with the requirements of your regulator as well as the precise needs and demands of your business. We can also help you to evidence on-going staff awareness of the contents of these documents – something that could prove to be of critical importance to your firm in the future.</p>
                <p>Because compliance is all we do, you know that you have got genuine experts working on your behalf to provide a bespoke service to your firm. Our consultants consist of some of the most highly regarded in the industry.</p>
                <p>Practical, Efficient and Extensive</p>
                <p>Stay compliant in a practical and efficient way that is appropriate to your business.</p> 
                <p>Examples of regulatory documentation include:</p>
                <br />
                        <ul class="custom-bullet">
                            <li>Compliance Procedures Manual</li>
                            <li>Operating Procedures Manual</li>
                            <li>Corporate Governance Manual</li>
                            <li>AML & CTF Manual</li>
                            <li>Code of Conduct/Ethics</li>
                            <li>Risk Management Framework and Manuals</li>
                            <li>Business Continuity Plan</li>
                         </ul>
                 <p>What You Should Do Now?</p>
                 <p>Whether you’re a new start-up that needs a full suite of regulatory compliance documentation or an established firm that needs to audit and review your existing documentation and provide you with assurance that your documentation is up to date and effective, we have a dedicated team of consultants that can help you every step of the way</p>
            	
            <?php } ?>
    

</div><!--col-->
<div class="clearfix"></div>
</div><!--row-->
</div><!--container-->
</section>
<div class="clearfix"></div>

<?php /*?><!--<section class="brands">
<div class="container">
<div class="row">
<div class="col-md-12">

	<h4>Lorem Ipsum Dolar</h4>
    <div class="orange_line"></div>
	<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec hendrerit rhoncus dignissim. Morbi tincidunt, risus eget ultricies aliquam, orci sem porta enim, in laoreet sapien nisl nec risus. Proin a volutpat erat. Nam dictum libero consequat iaculis dapibus. Proin sed ipsum nibh. Duis venenatis hendrerit arcu, vel vehicula orci vestibulum eget. Nulla tincidunt metus non nulla dignissim, vitae tincidunt massa rhoncus. Curabitur vitae commodo ex, vel tempor libero. Suspendisse sit amet lacinia enim.</p>

</div><!--col-->
<div class="clearfix"></div>

<div class="col-md-2">
	<div class="box5">
		<div class="img_holder">
    		<img src="<?php echo base_url(); ?>assets/images/s1.jpg" alt="brand" />
    	</div>
    </div>
</div><!--col-->
<div class="col-md-2">
	<div class="box5">
		<div class="img_holder">
    		<img src="<?php echo base_url(); ?>assets/images/s1.jpg" alt="brand" />
    	</div>
    </div>
</div><!--col-->
<div class="col-md-2">
	<div class="box5">
		<div class="img_holder">
    		<img src="<?php echo base_url(); ?>assets/images/s1.jpg" alt="brand" />
    	</div>
    </div>
</div><!--col-->
<div class="col-md-2">
	<div class="box5">
		<div class="img_holder">
    		<img src="<?php echo base_url(); ?>assets/images/s1.jpg" alt="brand" />
    	</div>
    </div>
</div><!--col-->
<div class="col-md-2">
	<div class="box5">
		<div class="img_holder">
    		<img src="<?php echo base_url(); ?>assets/images/s1.jpg" alt="brand" />
    	</div>
    </div>
</div><!--col-->
<div class="col-md-2">
	<div class="box5">
		<div class="img_holder">
    		<img src="<?php echo base_url(); ?>assets/images/s1.jpg" alt="brand" />
    	</div>
    </div>
</div><!--col-->
<div class="clearfix"></div>

</div><!--row-->
</div><!--container-->
</section>
--><?php */?>
<div class="clearfix"></div>