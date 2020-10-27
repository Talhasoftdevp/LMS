<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="description" content="heraldcitischool">
    <meta name="keywords" content="HTML,CSS">
    <meta name="developer" content="Gohar ul Islam">
    <meta name="email" content="goharulislam@gmail.com">
    <meta name="robots" content="index,nofollow,noarchive,nocache">
    <meta name="googlebot" content="snippet,nofollow,noarchive,nocache">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>Home</title>
    <link rel="icon" type="image/png" href="<?php echo base_url(); ?>assets/images/logo2.png" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/pace.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/owl.carousel.css" />
    <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body id="home">
    <header>
        <div class="container header">
            <div class="row">
                <div class="col-md-6">
                    <a href="">
                        <!--<div class="logo img_holder">-->
                        <div class="">
                            <!-- <div id="earth"></div> -->
                            <img src="<?php echo base_url(); ?>assets/images/logo2.png">
                            <h3>Silver Solve</h3>
                        </div>
                        <!--logo-->
                    </a>
                </div>

                <!-- <div class="col-md-3">
                    <div class="sm">
                        <ul>
                            <li class="fb">
                                <a href="http://www.facebook.com/" target="_blank">
                                    <i class="fa fa-facebook"></i>
                                </a>
                            </li>
                            <li class="twitter">
                                <a href="http://www.twitter.com/" target="_blank">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </li>
                            <li class="linkedin">
                                <a href="http://www.linkedin.com/" target="_blank">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <!--col-->
                <!--col-->
                <?php if ($this->session->userdata('is_front_logged_in') == FALSE) { ?>
                    <div class="col-md-3 pull-right">
                        <!--<div class="login">
                            <ul>
                                <li><a href="<?php echo base_url() ?>login">LOGIN</a></li>                
                            </ul>
                        </div>-->
                        <!--login-->
                    </div>
                    <!--col-->
                <?php } else { ?>
                    <div class="col-md-3 pull-right">
                        <div class="login">
                            <ul>
                                <li><a href="#"><?php echo $this->session->userdata('company_name'); ?></a></li>
                                <li><a href="<?php echo base_url(); ?>login/out">LOGOUT</a></li>
                            </ul>
                        </div>
                        <!--login-->
                    </div>
                    <!--col-->
                <?php } ?>
                <!-- <div class="col-md-3">
    
    	<form method="post" action="#" enctype="multipart/form-data">
            <div class="wrapper">
            	<input type="search" placeholder="Search" class="pull-left"/>
                <button type="submit"><i class="fa fa-search"></i></button>
            </div>
        </form>
    
    </div>-->
                <!--col-->

            </div>
            <!--row-->
        </div>
        <!--container-->


    </header>
    <div class="clearfix"><?php include('navigation_view.php'); ?></div>