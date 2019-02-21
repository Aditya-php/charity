<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>iRent Online</title>
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
					<form action="<?php echo site_url();?>user/auth/resetPassword" method="post">
						<div class="panel panel-body login-form">
							<div class="text-center">
								<div class="icon-object border-slate-300 text-slate-300"><i class="icon-spinner11"></i></div>
								<h5 class="content-group">Reset Password</h5>
								<?php 
			                        echo $this->session->flashdata('res');
			                    ?>
							</div>
							<?php echo form_error('username', '<h5 style="color:red;">', '</h5>'); ?>
							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="password" id="password" class="form-control" placeholder="Password" required="" /><span><a style="display:none;" id="view" href="#">view</a></span>
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>

							</div>
							<div class="form-group has-feedback has-feedback-left">
								<input type="password" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password" required="" />
								<div class="form-control-feedback">
									<i class="icon-user text-muted"></i>
								</div>
								<span id="valid_confirm_password" style="color:red;font-weight:bold"></span>
							</div>
							<div class="form-group">
								<button type="submit" name="btn" id="btn" value="forgot_password" class="btn btn-primary btn-block">Submit <i class="icon-circle-right2 position-right"></i></button>
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
<script>
$(document).ready(function(){

	$("#btn").click(function(){
		if($("#password").val()!=$("#confirm_password").val())
		{
			$("#valid_confirm_password").text('Sorry confirm password does not match!');
			return false;
		}
		return true;
	});
	$("#password").keyup(function(){
		if($(this).val().length>0)
		$("#valid_confirm_password").text('');
	})
	$("#confirm_password").keyup(function(){
		if($(this).val().length>0)
		$("#valid_confirm_password").text('');
	})
	$("#view").click(function(){
		var type=$("#password").attr('type');
		if(type=="text")
		{
			$("#password").attr('type','password');
			$("#confirm_password").attr('type','password');
		}
		else if(type=="password")
		{
			$("#password").attr('type','text');
			$("#confirm_password").attr('type','text');
		}
	})
});//end ready
</script>



