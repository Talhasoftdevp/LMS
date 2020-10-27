<style>
	.result {}

	.result .usr_name {
		padding-bottom: 30px;
	}

	.result .usr_name p {
		font-weight: bold;
		color: #b3b3b3;
		text-transform: uppercase;
		border-right: 1px solid #b3b3b3;
		padding-bottom: 30px;
	}

	.result .usr_name h6 {
		font-weight: bold;
		color: #000;
		text-transform: uppercase;
		padding-bottom: 30px;
	}

	.result .usr_name span {
		float: right;
		font-weight: bold;
		padding-bottom: 30px;
	}

	.result .usr_name .img_holder {
		text-align: center;
		padding-bottom: 30px;
	}

	.result .usr_name .img_holder h1 {
		text-transform: capitalize;
	}

	.result .usr_name .img_holder h1:before {
		content: '\f0f6  ';
		font-family: FontAwesome;
		padding-right: 10px;
		color: #f37b21;
	}

	.result .line {}

	.result .line img {
		width: 100%;
		padding-bottom: 30px;
	}

	.result .no_question {
		text-align: center;
		padding-bottom: 30px;
	}

	.result .no_question i {
		font-size: 50px;
		padding-bottom: 10px;
		color: #f37b21;
	}

	.result .no_question p {
		color: #f37b21;
		text-transform: capitalize;
		border-bottom: 1px solid #e4e4e4;
		padding-bottom: 10px;
		font-weight: bold;
	}

	.result .no_question h1 {
		font-weight: bold;
	}

	.result .margin {
		border-bottom: 1px solid #e4e4e4;
		margin: 30px 0px;
	}

	.result .percent {}

	.result .percent h1 {
		text-align: center;
		font-weight: bold;
	}

	.result .percent h1 span {
		font-size: 40px;
		font-weight: bold;
		padding-right: 10px;
		color: #f37b21;
	}

	.result .percent h2 {
		text-align: center;
		padding: 30px;
		font-weight: bold;
	}

	.banner .img_holder img {
		width: 100%;
	}


	.result .remerks span {
		float: right;
		font-weight: bold;
		padding-bottom: 30px;
	}

	.result .remarks .title {
		text-align: center;
		padding-bottom: 30px;
	}

	.result .remarks .title h1 {
		text-transform: capitalize;
	}
</style>
<section class="banner">
	<div class="container-fluid">
		<div class="row">

			<div class="img_holder">
				<img src="<?php echo base_url(); ?>assets/images/wcc_result_new.jpg" alt="banner">
				<h4>Result</h4>
			</div>
			<!--item-->

		</div>
		<!--row-->
	</div>
	<!--container-->
</section>
<div class="clearfix"></div>

<section class="result sec">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="usr_name">
					<div class="col-md-1 col-xs-6">
						<p>user name</p>
					</div>
					<div class="col-md-1 col-xs-6">
						<h6><?php echo $this->session->userdata('e_portal_user_name'); ?></h6>
					</div>
					<div class="col-md-8">
						<div class="img_holder">
							<h1>final result</h1>
						</div>
					</div>
					<div class="col-md-1 col-xs-6">
						<p>Total<br> time spend?</p>
					</div>
					<div class="col-md-1 col-xs-6">

						<h1><?php echo $master_result['duration']; ?></h1>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="line">
					<div class="img_holder">
						<img src="<?php echo base_url(); ?>assets/images/line.png" alt="line">
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<div class="remarks">
					<div class="title">
						<h1><?php echo $master_result['remarks_title']; ?></h1>
						<p style="color:#114d89;"><?php echo $master_result['remarks_msg']; ?></p>
					</div>
				</div>
			</div>
			<div class="col-md-12">

				<div class="col-md-2">
					<div class="no_question">
						<i class="fa fa-question" aria-hidden="true"></i>
						<p>Total no of questions</p>
						<h1><?php echo $master_result['total_questions']; ?></h1>
					</div>
				</div>
				<div class="col-md-3">
					<div class="no_question">
						<i class="fa fa-check" aria-hidden="true"></i>
						<p>Total no of Right Answers</p>
						<h1><?php echo $master_result['right_answer']; ?></h1>
					</div>
				</div>
				<div class="col-md-3">
					<div class="no_question">
						<i class="fa fa-times" aria-hidden="true"></i>
						<p>Total no of Wrong Answers</p>
						<h1><?php echo $master_result['wrong_answer']; ?></h1>
					</div>
				</div>
				<div class="col-md-3">
					<div class="no_question">
						<i class="fa fa-question" aria-hidden="true"></i>
						<p>Toal no of Unanswered Questions</p>
						<h1><?php echo $master_result['unanswered']; ?></h1>
					</div>
				</div>
				<div class="col-md-1">
					<div class="no_question">
						<i class="fa fa-book" aria-hidden="true"></i>
						<p>Result</p>
						<h1><?php echo $master_result['remarks']; ?></h1>
					</div>
				</div>

			</div>
			<div class="clearfix"></div>
			<div class="col-md-12">
				<div class="margin"></div>
			</div>
			<div class="col-md-12">
				<div class="percent">
					<h1><span>%</span>Total Percentage</h1>
					<h2>%<?php echo $master_result['percentage']; ?></h2>
				</div>
			</div>

			<div class="col-md-12">
				<div style="text-align:center;">
					<a href="<?php echo base_url(); ?>elearning/quiz" class="btn btn-xl btn-warning">Back to Dashboard</a>
					<?php if ($master_result['remarks'] == 'Pass') { ?>
						<a href="<?php echo base_url(); ?>elearning/cerificate/<?php echo $master_result['assignment_id']; ?>" class="btn btn-xl btn-warning">Get Your Certificate</a>
					<?php } ?>
				</div>
			</div>

		</div>
		<!--row-->
	</div>
	<!--container-->
</section>
<div class="clearfix"></div>