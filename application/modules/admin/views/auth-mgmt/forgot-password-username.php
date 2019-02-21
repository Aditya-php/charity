<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Irent Admin</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>/admin_assets/assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->
	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>/admin_assets/assets/js/core/app.js"></script>
	<!-- /theme JS files -->
</head>
<body>
	<!-- Main navbar -->
	<!-- /main navbar -->
	<!-- Page container -->
	<div class="page-container login-container">
		<!-- Page content -->
		<div class="page-content">
			<!-- Main content -->
			<div class="content-wrapper">

				<!-- Content area -->
				<div class="content">

					<!-- Simple login form -->
					<?php //echo validation_errors('<h3 style="color:red;font-weight:bold;">','</h3>');?>
					<form action="<?php echo site_url();?>admin/auth/forgotPassword" method="post">
						<div class="panel panel-body login-form">

							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-reading"></i></div>
								<h5 class="content-group">Forgot Password <small class="display-block">Enter your user name below</small></h5>
								<?php 
			                        echo $this->session->flashdata('res');
			                    ?>
							</div>
							<?php echo form_error('username', '<h5 style="color:red;">', '</h5>'); ?>
							<div class="form-group has-feedback has-feedback-left">
								  <input type="text" name="username" class="form-control" placeholder="Username" required="" />
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" name="btn" value="forgot_password" class="btn btn-primary btn-block">Submit <i class="icon-circle-right2 position-right"></i></button>
							</div>
						</div>
					</form>
					<!-- /simple login form -->


					<!-- Footer -->
					<div class="footer text-muted">
						&copy; <?php echo date("Y") ?>.<a href="#">iRent online. All right reserved</a> Developed by<a href="http://global-mlm.com/" target="_blank"> Global MLM</a>
					</div>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>



