<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Member Management</span> - Upload Bank Wire Proof</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Member Management</li>
							<li>Upload Bank Wire Proof</li>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
							    <?php echo $this->session->flashdata('flash_msg');?>
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Upload Bank Wire Proof</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url()."user/BankWireMemberReport/uploadProof/",array('method'=>'post','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Username:</label>
													<div class="col-lg-9">
														<?php 
														if(!empty($username))
														{
														?>
														<input  type="text" value="<?php echo $username;?>" disabled class="form-control" placeholder="Enter Username">
														<input type="hidden" name="username" value="<?php echo $username;?>">
														<?php 
														}
														else 
														{
														?>
														<input  type="text" name="username" class="form-control" required placeholder="Enter Username">
														<?php	
														}
														?>
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Proof:</label>
													<div class="col-lg-9">
														<input  type="file" name="proof" class="form-control" required placeholder="Enter Username">
													</div>
												</div>
												<div class="text-right">
													<button id="submitBtn" type="submit" name="btn" value="submit" class="btn btn-primary">Upload<i class="icon-arrow-right14 position-right"></i></button>
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

