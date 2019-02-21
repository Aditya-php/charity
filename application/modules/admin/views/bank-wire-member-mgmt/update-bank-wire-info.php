<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Member Management</span> - Update Bank Wire Details</h4>
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
							<li class="active">Member Management</li>
							<li>Update Bank Wire Details</li>
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
							    <?php echo $this->session->flashdata('flash_msg');?>
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Update Bank Wire Details</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										$name=(!empty($details->name))?$details->name:null;
										$account_no=(!empty($details->account_no))?$details->account_no:null;
										$bank_name=(!empty($details->bank_name))?$details->bank_name:null;
										$branch_code=(!empty($details->branch_code))?$details->branch_code:null;
										echo form_open(site_url()."admin/BankWireMemberReport/updateBankWireDetail/",array('method'=>'post','class'=>'form-horizontal' , 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Name:</label>
													<div class="col-lg-9">
														<input value="<?php echo $name;?>" id="name" type="text" name="name" class="form-control" placeholder="Enter Name">
														
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Account No:</label>
													<div class="col-lg-9">
														<input value="<?php echo $account_no;?>" id="account_no" type="text" name="account_no" class="form-control" placeholder="Enter Account No">
														
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Bank Name:</label>
													<div class="col-lg-9">
														<input value="<?php echo $bank_name;?>" id="bank_name" type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name">
														
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Branch Code:</label>
													<div class="col-lg-9">
														<input value="<?php echo $branch_code;?>" id="branch_code" type="text" name="branch_code" class="form-control" placeholder="Enter Branch Code">
														
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