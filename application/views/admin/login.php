<!DOCTYPE html>

<html lang="en">





<!-- Mirrored from www.themeon.net/nifty/v2.3/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:37:53 GMT -->

<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Tips and Go Login</title>





    <!--STYLESHEET-->

    <!--=================================================-->







    <!--Bootstrap Stylesheet [ REQUIRED ]-->

    <link href="<?php echo base_url(); ?>assets/admin/css/bootstrap.min.css" rel="stylesheet">





    <!--Nifty Stylesheet [ REQUIRED ]-->

    <link href="<?php echo base_url(); ?>assets/admin/css/nifty.min.css" rel="stylesheet">



    

    <!--Font Awesome [ OPTIONAL ]-->

    <link href="<?php echo base_url(); ?>assets/admin/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet">





    <!--Demo [ DEMONSTRATION ]-->

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

	<div id="container" class="cls-container">

		

		<!-- BACKGROUND IMAGE -->

		<!--===================================================-->

		<div id="bg-overlay" class="bg-img img-balloon"></div>

		

		

		<!-- HEADER -->

		<!--===================================================-->

		<div class="cls-header cls-header-lg">

			<div class="cls-brand">

				<a class="box-inline" href="index.html">

					<!-- <img alt="Nifty Admin" href="<?php echo base_url(); ?>assets/admin/img/logo.png" class="brand-icon"> -->

					<span class="brand-title">Nifty <span class="text-thin">Admin</span></span>

				</a>

			</div>

		</div>

		<!--===================================================-->

		

		

		<!-- LOGIN FORM -->

		<!--===================================================-->

		<div class="cls-content">

			<div class="cls-content-sm panel">

				<div class="panel-body">

					<p class="pad-btm">Sign In to your account</p>

					<?php if(isset($form_errors) && !empty($form_errors)): ?>

					  <div class="alert alert-danger"> <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>

						<p>Errors!</p>

						<?php echo $form_errors; ?> </div>

					  <?php endif; ?>

					<form action="<?php echo current_url(); ?>" method="post">

						<div class="form-group">

							<div class="input-group">

								<div class="input-group-addon"><i class="fa fa-user"></i></div>

								<input type="text" class="form-control" placeholder="Email" name="email" id="email">

							</div>

						</div>

						<div class="form-group">

							<div class="input-group">

								<div class="input-group-addon"><i class="fa fa-asterisk"></i></div>

								<input type="password" class="form-control" placeholder="Password" name="password" id="password">

							</div>

						</div>

						<div class="row">

							<div class="col-xs-4">

								<div class="form-group text-right">

								<button class="btn btn-success text-uppercase" type="submit">Sign In</button>

								</div>

							</div>

						</div>

					</form>

				</div>

			</div>

		</div>

		<!--===================================================-->

		

		

		<!-- DEMO PURPOSE ONLY -->

		<!--===================================================-->

		<div class="demo-bg">

			<div id="demo-bg-list">

				<div class="demo-loading"><i class="fa fa-refresh"></i></div>

				<img class="demo-chg-bg bg-trans" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-trns.jpg" alt="Background Image">

				<img class="demo-chg-bg" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-1.jpg" alt="Background Image">

				<img class="demo-chg-bg active" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-2.jpg" alt="Background Image">

				<img class="demo-chg-bg" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-3.jpg" alt="Background Image">

				<img class="demo-chg-bg" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-4.jpg" alt="Background Image">

				<img class="demo-chg-bg" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-5.jpg" alt="Background Image">

				<img class="demo-chg-bg" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-6.jpg" alt="Background Image">

				<img class="demo-chg-bg" src="<?php echo base_url(); ?>assets/admin/img/bg-img/thumbs/bg-img-7.jpg" alt="Background Image">

			</div>

		</div>

		<!--===================================================-->

		

		

		

	</div>

	<!--===================================================-->

	<!-- END OF CONTAINER -->





		

    <!--JAVASCRIPT-->

    <!--=================================================-->



    <!--jQuery [ REQUIRED ]-->

    <script src="<?php echo base_url(); ?>assets/admin/js/jquery-2.1.1.min.js"></script>





    <!--BootstrapJS [ RECOMMENDED ]-->

    <script src="<?php echo base_url(); ?>assets/admin/js/bootstrap.min.js"></script>





    <!--Fast Click [ OPTIONAL ]-->

    <script src="<?php echo base_url(); ?>assets/admin/plugins/fast-click/fastclick.min.js"></script>



    

    <!--Nifty Admin [ RECOMMENDED ]-->

    <script src="<?php echo base_url(); ?>assets/admin/js/nifty.min.js"></script>





    <!--Background Image [ DEMONSTRATION ]-->

    <script src="<?php echo base_url(); ?>assets/admin/js/demo/bg-images.js"></script>



    

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

		



</body>



<!-- Mirrored from www.themeon.net/nifty/v2.3/pages-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 12 Apr 2016 05:38:00 GMT -->

</html>

