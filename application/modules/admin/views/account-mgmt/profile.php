 <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/uploaders/fileinput.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/uploader_bootstrap.js"></script>

<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Account Setting</span> - Update Profile</h4>
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
							<li class="active">Update Profile</li>
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
										<h5 class="panel-title">Update Profile</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url()."admin/account/profileManagement",array('method'=>'post','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Username:</label>
													<div class="col-lg-9">
														<input type="text" name="username" class="form-control" value="<?php echo $user->username;?>">
														<?php 
														echo form_error('username',"<span style='font-weight:bold;color:red;'>","</span>")
														?>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Panel Title:</label>
													<div class="col-lg-9">
														<input type="text" name="panel_title" class="form-control" value="<?php echo $user->panel_title;?>">
													</div>
												</div>

												
												<div class="form-group">
													<label class="col-lg-3 control-label">Profile Pic:</label>
													<div class="col-lg-9">
														<?php
														if(!empty($user->image))
														{ 
														?>
                                                        <div class="file-preview-old">
															   <div class="file-preview-thumbnails">
															<div class="file-preview-frame">
															   <img src="<?php echo base_url();?>images/<?php echo $user->image;?>" class="file-preview-image" style="width:auto;height:160px;">
															</div>
															</div>
															   <div class="clearfix"></div>   <div class="file-preview-status text-center text-success"></div>
															   <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                                       </div>	
														<?php	
													     }
														?>
														
														<input name='profile_pic' type="file" class="file-input">

														<input  name='profile_pic_old' value="<?php echo $user->image;?>" type="hidden">
										
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Facebook Link:</label>
													<div class="col-lg-9">
														<input type="text" name="facebook_link" class="form-control" value="<?php echo $user->facebook_link;?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Google Plus Link:</label>
													<div class="col-lg-9">
														<input type="text" name="google_plus_link" class="form-control" value="<?php echo $user->google_plus_link;?>">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Linkedin Link:</label>
													<div class="col-lg-9">
														<input type="text" name="linkedin_link" class="form-control" value="<?php echo $user->linkedin_link;?>">
													</div>
												</div>

												<div class="text-right">
													<button type="submit" name="btn" value="submit" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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
<style>
button.btn.btn-default.btn-icon.kv-fileinput-upload{
	display: none;
}
.file-preview-old {
    /*border-radius: 2px;
    border: 1px solid #ddd;*/
    width: 100%;
    margin-bottom: 20px;
    position: relative;
}
</style>
<script>
  $(document).ready(function(){
  	$(".file-caption-name").text("No Profile Pic Selected");
  });//end ready
</script>			