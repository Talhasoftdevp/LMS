<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta name="description" content="world compliance check">
<meta name="keywords" content="HTML,CSS">
<meta name="developer" content="ShoaibUddin">
<meta name="email" content="shoaib.qureshi@hotmail.com">
<meta name="robots" content="index,nofollow,noarchive,nocache">
<meta name="googlebot" content="snippet,nofollow,noarchive,nocache">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<title><?php if(basename($_SERVER['SCRIPT_NAME']) == 'index.php'){ echo 'Home'; } else { echo ucwords(substr(basename($_SERVER['SCRIPT_NAME']), 0, -4)); } ?></title>
<link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/favicon.png"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pace.css"/>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.min.css"/>
<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css"/>

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<body id="home">
<section class="certificate">
<div class="container">
<div class="row">
	<div class="certificate-bg">
		<div class="col-md-12">
			<div class="logo">
                <img src="<?php echo base_url(); ?>assets/images/cert_logo.png" alt=""/ >
			</div><!--logo-->
			<div class="clearfix"></div>
		</div><!--col-->
		<div class="col-md-12">
			<div class="achivement">
				<h1>Certificate <i style="text-transform: none;">of</i> Achievement</h1>
				<img src="<?php echo base_url(); ?>assets/images/certificate-bar.png" alt=""/>
				<p>THIS CERTIFICATE IS AWARDED TO</p>
			</div>
			<div class="text">
				<hr/>
				<h2><?php echo $user_name; ?></h2>
				<hr/>
			</div>
			<div class="exam">
				<p>FOR SUCCESSFUL COMPLETION OF THE WORLD COMPLIANCE CHECK</p>
				<h3> E-Learning <?php echo $name; ?> Training Curriculum</h3>
				<h5>ON THIS <?php echo $day; ?>, <?php echo $date; ?></h5>
				
			</div>
			<!--<div class="ceo">
				<p>_______________________________</p>
				<p>Kashif Mehmood CEO</p>
			</div>-->
		</div>
		<div class="col-md-12">
			<table>
				<tr>
					<td> 
					<div class="stamp">
						<img src="<?php echo base_url(); ?>assets/images/stamp.png" alt="" />
					</div>
					</td>
					<td>
						<div class="thomas" style="">
							<!--<h6>Dan Thomas, Board of World Compliance </h6>
							<p>THIS IS A COMPUTER-GENERATED CERTIFICATE AND DOES NOT REQUIRE A SIGN-OFF</p>-->
							<img src="<?php echo base_url(); ?>assets/images/dansign.png" alt="DanSign"/ >
						</div>
					</td>
				</tr>
			</table>
			<!--<div class="col-md-4">
				<div class="stamp">
					<img src="<?php echo base_url(); ?>assets/images/stamp.png" alt="" />
				</div>
			</div>
			
			<div class="col-md-6">
				<div class="thomas" style="">
					<h6>Dan Thomas, Board of World Compliance </h6>
					<p>THIS IS A COMPUTER-GENERATED CERTIFICATE AND DOES NOT REQUIRE A SIGN-OFF</p>
					<img src="<?php //echo base_url(); ?>assets/images/dansign.png" alt="DanSign"/ >
				</div>
			</div>
			<div class="col-md-2"></div>-->
		
		</div>
	</div>
</div>
</div>
</section>
<!-- JAVASCRIPT -->
<script src="<?php echo base_url(); ?>assets/js/jquery-3.1.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/pace.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<script type="text/javascript">
window.print();
</script>

</body>
</html>