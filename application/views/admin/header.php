<!DOCTYPE html>

<html lang="en">





<!-- Mirrored from www.themeon.net/nifty/v2.3/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:36:48 GMT -->

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard | Tips and Go.</title>





    <!--STYLESHEET-->

    <!--=================================================-->







    <!--Bootstrap Stylesheet [ REQUIRED ]-->

    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">





    <!--Nifty Stylesheet [ REQUIRED ]-->

    <link href="<?php echo base_url(); ?>assets/admin/css/nifty.min.css" rel="stylesheet">



    

    <!--Font Awesome [ OPTIONAL ]-->

    <link href="<?php echo base_url(); ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">



	<?php if(isset($is_trips) || isset($is_table)){ ?>

		<!--Bootstrap Select [ OPTIONAL ]-->

    <link href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">

	

	

		<!--Bootstrap Table [ OPTIONAL ]-->

		<link href="<?php echo base_url(); ?>assets/admin/plugins/datatables/media/css/dataTables.bootstrap.css" rel="stylesheet">

		<link href="<?php echo base_url(); ?>assets/admin/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css" rel="stylesheet">

	<?php }else{ ?>

		<!--Animate.css [ OPTIONAL ]-->

		<link href="<?php echo base_url(); ?>assets/admin/plugins/animate-css/animate.min.css" rel="stylesheet">

	

	

		<!--Morris.js [ OPTIONAL ]-->

		<link href="<?php echo base_url(); ?>assets/admin/plugins/morris-js/morris.min.css" rel="stylesheet">

	<?php } ?>



    <!--Switchery [ OPTIONAL ]-->

    <link href="<?php echo base_url(); ?>assets/admin/plugins/switchery/switchery.min.css" rel="stylesheet">





    <!--Bootstrap Select [ OPTIONAL ]-->

    <link href="<?php echo base_url(); ?>assets/admin/plugins/bootstrap-select/bootstrap-select.min.css" rel="stylesheet">





    <!--Demo script [ DEMONSTRATION ]-->

    <link href="<?php echo base_url(); ?>assets/admin/css/demo/nifty-demo.min.css" rel="stylesheet">









    <!--SCRIPT-->

    <!--=================================================-->



    <!--Page Load Progress Bar [ OPTIONAL ]-->

    <link href="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.min.css" rel="stylesheet">

    <script src="<?php echo base_url(); ?>assets/admin/plugins/pace/pace.min.js"></script>





    

	<!--



	REQUIRED

	You must include this in your project.



	RECOMMENDED

	This category must be included but you may modify which plugins or components which should be included in your project.



	OPTIONAL

	Optional plugins. You may choose whether to include it in your project or not.



	DEMONSTRATION

	This is to be removed, used for demonstration purposes only. This category must not be included in your project.



	SAMPLE

	Some script samples which explain how to initialize plugins or components. This category should not be included in your project.





	Detailed information and more samples can be found in the document.



	-->

		



</head>



<!--TIPS-->

<!--You may remove all ID or Class names which contain "demo-", they are only used for demonstration. -->



<body>

	<div id="container" class="effect mainnav-lg">

		

        <!--NAVBAR-->

        <!--===================================================-->

        <header id="navbar">

            <div id="navbar-container" class="boxed">



                <!--Brand logo & name-->

                <!--================================-->

                <div class="navbar-header">

                    <a href="<?php echo base_url("admin"); ?>" class="navbar-brand">

                        <img src="<?php echo base_url(); ?>assets/admin/img/logo.png" alt="Nifty Logo" class="brand-icon">

                        <div class="brand-title">

                            <span class="brand-text">Trips and Go</span>

                        </div>

                    </a>

                </div>

                <!--================================-->

                <!--End brand logo & name-->





                <!--Navbar Dropdown-->

                <!--================================-->

                <div class="navbar-content clearfix">

                    <ul class="nav navbar-top-links pull-left">



                        <!--Navigation toogle button-->

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <li class="tgl-menu-btn">

                            <a class="mainnav-toggle" href="#">

                                <i class="fa fa-navicon fa-lg"></i>

                            </a>

                        </li>

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <!--End Navigation toogle button-->







                        <!--Notification dropdown-->

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <li class="dropdown">

                            <a href="#" data-toggle="dropdown" class="dropdown-toggle">

                                <i class="fa fa-bell fa-lg"></i>

                                <span class="badge badge-header badge-danger">9</span>

                            </a>



                            <!--Notification dropdown menu-->

                            <div class="dropdown-menu dropdown-menu-md">

                                <div class="pad-all bord-btm">

                                    <p class="text-lg text-muted text-semibold mar-no">You have 9 notifications.</p>

                                </div>

                                <div class="nano scrollable">

                                    <div class="nano-content">

                                        <ul class="head-list">



                                            <!-- Dropdown list-->

                                            <li>

                                                <a href="#">

                                                    <div class="clearfix">

                                                        <p class="pull-left">Database Repair</p>

                                                        <p class="pull-right">70%</p>

                                                    </div>

                                                    <div class="progress progress-sm">

                                                        <div style="width: 70%;" class="progress-bar">

                                                            <span class="sr-only">70% Complete</span>

                                                        </div>

                                                    </div>

                                                </a>

                                            </li>



                                            <!-- Dropdown list-->

                                            <li>

                                                <a href="#">

                                                    <div class="clearfix">

                                                        <p class="pull-left">Upgrade Progress</p>

                                                        <p class="pull-right">10%</p>

                                                    </div>

                                                    <div class="progress progress-sm">

                                                        <div style="width: 10%;" class="progress-bar progress-bar-warning">

                                                            <span class="sr-only">10% Complete</span>

                                                        </div>

                                                    </div>

                                                </a>

                                            </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									                <div class="media-left">

									                    <img src="<?php echo base_url(); ?>assets/admin/img/av4.png" alt="Profile Picture" class="img-circle img-sm">

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">Lucy sent you a message</div>

									                    <small class="text-muted">30 minutes ago</small>

									                </div>

									            </a>

									        </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									                <div class="media-left">

									                    <img src="<?php echo base_url(); ?>assets/admin/img/av3.png" alt="Profile Picture" class="img-circle img-sm">

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">Jackson sent you a message</div>

									                    <small class="text-muted">40 minutes ago</small>

									                </div>

									            </a>

									        </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									        <span class="badge badge-success pull-right">90%</span>

									                <div class="media-left">

									                    <span class="icon-wrap icon-circle bg-danger">

									                        <i class="fa fa-hdd-o fa-lg"></i>

									                    </span>

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">HDD is full</div>

									                    <small class="text-muted">50 minutes ago</small>

									                </div>

									            </a>

									        </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									                <div class="media-left">

									                    <span class="icon-wrap bg-info">

									                        <i class="fa fa-file-word-o fa-lg"></i>

									                    </span>

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">Write a news article</div>

									                    <small class="text-muted">Last Update 8 hours ago</small>

									                </div>

									            </a>

									        </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									        <span class="label label-danger pull-right">New</span>

									                <div class="media-left">

									                    <span class="icon-wrap bg-purple">

									                        <i class="fa fa-comment fa-lg"></i>

									                    </span>

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">Comment Sorting</div>

									                    <small class="text-muted">Last Update 8 hours ago</small>

									                </div>

									            </a>

									        </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									                <div class="media-left">

									                    <span class="icon-wrap bg-success">

									                        <i class="fa fa-user fa-lg"></i>

									                    </span>

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">New User Registered</div>

									                    <small class="text-muted">4 minutes ago</small>

									                </div>

									            </a>

									        </li>

									

									        <!-- Dropdown list-->

									        <li>

									            <a href="#" class="media">

									                <div class="media-left">

									                    <img src="<?php echo base_url(); ?>assets/admin/img/av3.png" alt="Profile Picture" class="img-circle img-sm">

									                </div>

									                <div class="media-body">

									                    <div class="text-nowrap">Jackson sent you a message</div>

									                    <small class="text-muted">Yesterday</small>

									                </div>

									            </a>

									        </li>

                                        </ul>

                                    </div>

                                </div>



                                <!--Dropdown footer-->

                                <div class="pad-all bord-top">

                                    <a href="#" class="btn-link text-dark box-block">

                                        <i class="fa fa-angle-right fa-lg pull-right"></i>Show All Notifications

                                    </a>

                                </div>

                            </div>

                        </li>

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <!--End notifications dropdown-->







                        <!--Mega dropdown-->

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <li class="mega-dropdown">

                            <a href="#" class="mega-dropdown-toggle">

                                <i class="fa fa-th-large fa-lg"></i>

                            </a>

                            <div class="dropdown-menu mega-dropdown-menu">

                                <div class="clearfix">

                                    <div class="col-sm-12 col-md-3">



                                        <!--Mega menu widget-->

                                        <div class="text-center bg-purple pad-all">

                                            <h3 class="text-thin mar-no">Weekend shopping</h3>

                                            <div class="pad-ver box-inline">

                                                <span class="icon-wrap icon-wrap-lg icon-circle bg-trans-light">

                                                    <i class="fa fa-shopping-cart fa-4x"></i>

                                                </span>

                                            </div>

                                            <p class="pad-btm">

                                                Members get <span class="text-lg text-bold">50%</span> more points. Lorem ipsum dolor sit amet!

                                            </p>

                                            <a href="#" class="btn btn-purple">Learn More...</a>

                                        </div>



                                    </div>

                                    <div class="col-sm-4 col-md-3">



                                        <!--Mega menu list-->

                                        <ul class="list-unstyled">

									        <li class="dropdown-header">Pages</li>

									        <li><a href="#">Profile</a></li>

									        <li><a href="#">Search Result</a></li>

									        <li><a href="#">FAQ</a></li>

									        <li><a href="#">Sreen Lock</a></li>

									        <li><a href="#" class="disabled">Disabled</a></li>

									        <li class="divider"></li>

									        <li class="dropdown-header">Icons</li>

									        <li><a href="#"><span class="pull-right badge badge-purple">479</span> Font Awesome</a></li>

									        <li><a href="#">Skycons</a></li>

                                        </ul>



                                    </div>

                                    <div class="col-sm-4 col-md-3">



                                        <!--Mega menu list-->

                                        <ul class="list-unstyled">

									        <li class="dropdown-header">Mailbox</li>

									        <li><a href="#"><span class="pull-right label label-danger">Hot</span>Indox</a></li>

									        <li><a href="#">Read Message</a></li>

									        <li><a href="#">Compose</a></li>

									        <li class="divider"></li>

									        <li class="dropdown-header">Featured</li>

									        <li><a href="#">Smart navigation</a></li>

									        <li><a href="#"><span class="pull-right badge badge-success">6</span>Exclusive plugins</a></li>

									        <li><a href="#">Lot of themes</a></li>

									        <li><a href="#">Transition effects</a></li>

                                        </ul>



                                    </div>

                                    <div class="col-sm-4 col-md-3">



                                        <!--Mega menu list-->

                                        <ul class="list-unstyled">

									        <li class="dropdown-header">Components</li>

									        <li><a href="#">Tables</a></li>

									        <li><a href="#">Charts</a></li>

									        <li><a href="#">Forms</a></li>

									        <li class="divider"></li>

                                            <li>

                                                <form role="form" class="form">

                                                    <div class="form-group">

                                                        <label class="dropdown-header" for="demo-megamenu-input">Newsletter</label>

                                                        <input id="demo-megamenu-input" type="email" placeholder="Enter email" class="form-control">

                                                    </div>

                                                    <button class="btn btn-primary btn-block" type="submit">Submit</button>

                                                </form>

                                            </li>

                                        </ul>

                                    </div>

                                </div>

                            </div>

                        </li>

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <!--End mega dropdown-->



                    </ul>

                    <ul class="nav navbar-top-links pull-right">



                        <!--Language selector-->

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <li class="dropdown">

                            <a id="demo-lang-switch" class="lang-selector dropdown-toggle" href="#" data-toggle="dropdown">

                                <span class="lang-selected">

                                    <img class="lang-flag" src="<?php echo base_url(); ?>assets/admin/img/flags/united-kingdom.png" alt="English">

                                </span>

                            </a>



                            <!--Language selector menu-->

                            <ul class="head-list dropdown-menu">

						        <li>

						            <!--English-->

						            <a href="#" class="active">

						                <img class="lang-flag" src="<?php echo base_url(); ?>assets/admin/img/flags/united-kingdom.png" alt="English">

						                <span class="lang-id">EN</span>

						                <span class="lang-name">English</span>

						            </a>

						        </li>

						        <li>

						            <!--France-->

						            <a href="#">

						                <img class="lang-flag" src="<?php echo base_url(); ?>assets/admin/img/flags/france.png" alt="France">

						                <span class="lang-id">FR</span>

						                <span class="lang-name">Fran&ccedil;ais</span>

						            </a>

						        </li>

						        <li>

						            <!--Germany-->

						            <a href="#">

						                <img class="lang-flag" src="<?php echo base_url(); ?>assets/admin/img/flags/germany.png" alt="Germany">

						                <span class="lang-id">DE</span>

						                <span class="lang-name">Deutsch</span>

						            </a>

						        </li>

						        <li>

						            <!--Italy-->

						            <a href="#">

						                <img class="lang-flag" src="<?php echo base_url(); ?>assets/admin/img/flags/italy.png" alt="Italy">

						                <span class="lang-id">IT</span>

						                <span class="lang-name">Italiano</span>

						            </a>

						        </li>

						        <li>

						            <!--Spain-->

						            <a href="#">

						                <img class="lang-flag" src="<?php echo base_url(); ?>assets/admin/img/flags/spain.png" alt="Spain">

						                <span class="lang-id">ES</span>

						                <span class="lang-name">Espa&ntilde;ol</span>

						            </a>

						        </li>

                            </ul>

                        </li>

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <!--End language selector-->







                        <!--User dropdown-->

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <li id="dropdown-user" class="dropdown">

                            <a href="<?php echo base_url("admin/profile/".$this->session->userdata('user_id')) ?>" data-toggle="dropdown" class="dropdown-toggle text-right">
                                <span class="pull-right">
                                   <?php if (isset($user_detail->profile_pic) && !empty($user_detail->profile_pic)): ?>
		                            <img class="img-circle img-user media-object" src="<?php echo base_url("uploads/user-pic/" . $user_detail->profile_pic); ?>" alt="Profile Picture">
			                        <?php else: ?>
			                            <img class="img-circle img-user media-object" src="<?php echo base_url(); ?>assets/admin/img/av1.png" alt="Profile Picture">
			                        <?php endif; ?>
                                </span>

                                <div class="username hidden-xs">
                                	<?php if($user_detail->first_name && $user_detail->last_name){
					                            echo  ucwords($user_detail->first_name." ".$user_detail->last_name);
					                       }else{
					                            echo  ucwords($user_detail->username);
					                       }
					                ?>
                                </div>

                            </a>





                            <div class="dropdown-menu dropdown-menu-md dropdown-menu-right panel-default">



                                <!-- Dropdown heading  -->

                                <div class="pad-all bord-btm">

                                    <p class="text-lg text-muted text-semibold mar-btm">750Gb of 1,000Gb Used</p>

                                    <div class="progress progress-sm">

                                        <div class="progress-bar" style="width: 70%;">

                                            <span class="sr-only">70%</span>

                                        </div>

                                    </div>

                                </div>





                                <!-- User dropdown menu -->

                                <ul class="head-list">

                                    <li>

                                        <a href="<?php echo base_url("admin/profile/".$this->session->userdata('user_id')) ?>">

                                            <i class="fa fa-user fa-fw fa-lg"></i> Profile

                                        </a>

                                    </li>

                             		<li>

                                        <a href="<?php echo base_url("admin/edit_profile/") ?>">

                                            <i class="fa fa-edit fa-fw fa-lg"></i> Edit Profile

                                        </a>

                                    </li>

                                    <li>

                                        <a href="<?php echo base_url("admin/settings"); ?>">

                                            <span class="label label-success pull-right">New</span>

                                            <i class="fa fa-gear fa-fw fa-lg"></i> Settings

                                        </a>

                                    </li>

                                    <li>

                                        <a href="<?php echo base_url("admin/change_password"); ?>">

                                            <i class="fa fa-lock fa-fw fa-lg"></i> Change Password

                                        </a>

                                    </li>

                                </ul>



                                <!-- Dropdown footer -->

                                <div class="pad-all text-right">

                                    <a href="<?php echo base_url("admin/logout"); ?>" class="btn btn-primary">

                                        <i class="fa fa-sign-out fa-fw"></i> Logout

                                    </a>

                                </div>

                            </div>

                        </li>

                        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

                        <!--End user dropdown-->



                    </ul>

                </div>

                <!--================================-->

                <!--End Navbar Dropdown-->



            </div>

        </header>

        <!--===================================================-->

        <!--END NAVBAR-->