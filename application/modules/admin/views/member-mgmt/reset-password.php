<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Member Management</span> - Reset Password</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url()."admin";?>"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Member Management</li>
							<li class="active">Reset Password</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
				<?php echo $this->session->flashdata('flash_msg');?>
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Reset Password</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										//pr($all_packages);
										echo form_open(site_url()."admin/member/resetPassword",array('method'=>'post','class'=>'form-horizontal'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
											    <input type="hidden" name="user_id" value="<?php echo $user_id;?>">
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Password:</label>
													<div class="col-lg-9">
														 <input type="password" name="password" required id="password" title="Password" class="form-control" placeholder="Enter Password">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Confrim Password:</label>
													<div class="col-lg-9">
														 <input type="password" name="c_pass" required id="c_pass" title="Password" class="form-control" placeholder="Enter Password">
														 <span id="valid_cpass" style="color:red;font-weight:bold"></span>
													</div>
												</div>
												
												<div class="text-right">
													<button type="submit" name="btn" id="btn" value="reset_password" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
												</div>
											</div>
										<!--</form>-->
										<?php echo form_close();?>
								</div>
								<!-- /basic layout -->
						</div>
					</div>
					<!-- /vertical form options -->
					<!-- Footer -->
	                  <?php
	                  $this->load->view("common/footer-text");
	                  ?>
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
<script>
$(document).ready(function(){
	$("#btn").click(function(){
		
		var password=$("#password").val();
		var cpass=$("#c_pass").val();
		if(password!=cpass)
		{
			$("#valid_cpass").text("Sorry confirm password does not match");
			return false;
		}
		return true;
	});//end btn click
	$("#c_pass").keyup(function(){
		
		var password=$("#password").val();
		var cpass=$(this).val();
		if(password==cpass)
		{
			$("#valid_cpass").text('');
		}
	})
});
</script>			