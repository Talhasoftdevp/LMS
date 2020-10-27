<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title><?php echo $title; ?></title>

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- bootstrap & fontawesome -->
    <script src="<?php echo base_url(); ?>assets/sweet-alert/sweet-alert-2.js"></script>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" />
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.2.0/css/font-awesome.min.css" /> -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />

    <!-- page specific plugin styles -->

    <!-- text fonts -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/fonts/fonts.googleapis.com.css" /> -->

    <!-- ace styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

    <!--[if lte IE 9]>
                <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->

    <!--[if lte IE 9]>
          <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ace-ie.min.css" />
        <![endif]-->

    <!-- inline styles related to this page -->

    <!-- ace settings handler -->
    <script src="<?php echo base_url(); ?>assets/js/ace-extra.min.js"></script>

    <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

    <!--[if lte IE 8]>
        <script src="<?php echo base_url(); ?>assets/js/html5shiv.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/respond.min.js"></script>
        <![endif]-->
</head>

<body class="no-skin">
    <div id="navbar" class="navbar navbar-default ">
        <script type="text/javascript">
            try {
                ace.settings.check('navbar', 'fixed')
            } catch (e) {}
        </script>

        <div class="navbar-container customHeader" id="navbar-container">
            <button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar" data-toggle="collapse">
                <span class="sr-only">Toggle sidebar</span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>

                <span class="icon-bar"></span>
            </button>

            <div class="navbar-header pull-left custom-small">
                <a href="<?php echo base_url(); ?>" class="navbar-brand">

                    <!-- <img src="<?php echo site_url('assets/image/HCS.png') ?>" alt="HeralCity" width="500" height="600"> -->
                    <?php echo "Silver Solve" ?>

                </a>
            </div>

            <div class="  pull-right headerDropdown anchorWidth" role="navigation">
                <ul class="nav ace-nav">
                    <li class="">
                        <a data-toggle="dropdown" href="#" class="">
                            <img class="nav-user-photo" src="<?php echo base_url(); ?>upload/customer/<?php echo ($this->session->userdata('photo')) ? $this->session->userdata('photo') : 'profile-pic.jpg'; ?>" alt="Jason's Photo" />
                            <span class="user-info">
                                <small>Welcome,</small>
                                <?php echo ucfirst($this->session->userdata('username')); ?>
                            </span>

                            <i class="ace-icon fa fa-caret-down"></i>
                        </a>

                        <ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
                            <!-- <li>
                                    <a href="<?php echo base_url(); ?>app/user_profile">
                                        <i class="ace-icon fa fa-user"></i>
                                        Profile
                                    </a>
                                </li>-->
                            <li>
                                <a href="<?php echo base_url(); ?>login/out">
                                    <i class="ace-icon fa fa-power-off"></i>
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div><!-- /.navbar-container -->
    </div>

    <?php include('navigation_view.php'); ?>