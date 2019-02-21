<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Account Setting</span> - Change Password</h4>
						</div>
						<!--
						<div class="heading-elements">
							<div class="heading-btn-group">
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
								<a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
							</div>
						</div>
						-->
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Account Setting</li>
							<li class="active">Change Password</li>
						</ul>
						<ul class="breadcrumb"></ul>
						
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
							    <?php 
					                  if(!empty($this->session->flashdata('flash_msg')))
					                  {
					                  ?>
					               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
					                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
					                  <?php echo $this->session->flashdata('flash_msg');?>
					               </div>
					            <?php    
					                  }
					            ?>
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Change Password</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo validation_errors();
										$old_password=(!empty($old_password))?$old_password:'';
										$new_password=(!empty($new_password))?$new_password:'';
										$confirm_password=(!empty($confirm_password))?$confirm_password:'';

										echo form_open(site_url()."admin/account/changePassword",array('method'=>'post','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Old Password:</label>
													<div class="col-lg-9">
														<input value="<?php echo set_value('old_password',$old_password);?>" id="old_password" type="password" name="old_password" class="form-control" placeholder="Old Password">
														<span id="valid_old_password" style="color:red;font-weight:bold;display:none"></span>

														<?php echo form_error('old_password','<span id="valid_old_password" style="color:red;font-weight:bold;">', '</span>');?>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Enter New Password:</label>
													<div class="col-lg-9">
														<input value="<?php echo set_value('new_password',$new_password);?>"  id="new_password" type="password" name="new_password" class="form-control" placeholder="New Password">
														<span id="valid_new_password" style="color:red;font-weight:bold;display:none"></span>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Confirm Password:</label>
													<div class="col-lg-9">
														<input value="<?php echo set_value('confirm_password',$confirm_password);?>" id="confirm_password" type="password" name="confirm_password" class="form-control" placeholder="Confirm Password">
														<span id="valid_confirm_password" style="color:red;font-weight:bold;display:none"></span>
													</div>
												</div>

												<div class="text-right">
													<button id="submitBtn" type="submit" name="btn" value="submit" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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

  	$("#submitBtn").click(function(){
  	$("#valid_old_password").text('').css('display','none');	
  	$("#valid_new_password").text('').css('display','none');	
  	$("#valid_confirm_password").text('').css('display','none');	
     if($("#old_password").val()=="")
     {
     	$("#valid_old_password").text("Please enter old password!").css('display','');
     	return false;
     }

     if($("#new_password").val()=="")
     {
     	$("#valid_new_password").text("Please enter new password!").css('display','');
     	return false;
     }

     if($("#confirm_password").val()=="")
     {
     	$("#valid_confirm_password").text("Please enter old password!").css('display','');
     	return false;
     }

     if($("#new_password").val()!=$("#confirm_password").val())
     {
     	$("#valid_confirm_password").text("Sorry confirm password does not match!").css('display','');
     	return false;
     }
     return true;
  	});//end submit btn click here
  });//end ready
</script>			