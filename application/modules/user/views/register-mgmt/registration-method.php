<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Register Management</span> - <?php echo $title;?></h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Registraion Method</li>
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
										<h5 class="panel-title"><?php echo $title;?></h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<!--<form method="post" class="form-horizontal">-->								
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Ewallet:</label>
													<div class="col-lg-3">
														<select class="form-control">
															<option value="">-Select Method-</option>
															<option value="">Ewallet</option>
															<option value="">Epin</option>
														</select>
													</div>
												</div>
												
												<div class="text-right">
													<button id="submitBtn" type="submit" name="btn" value="submit" class="btn btn-primary">continue<i class="icon-arrow-right14 position-right"></i></button>
												</div>
												
											</div>
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
