<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - Edit Package</h4>
						</div>

						<div class="heading-elements">
                         <div class="heading-btn-group">
                            <a href="<?php echo site_url();?>admin/package/allPackages" class="btn btn-success"><i class="icon-arrow-left52 position-left"></i> Back</a>
                          </div>
                        </div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li><a>Package Management</a></li>
							<li class="active">Edit Package</li>
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
										<h5 class="panel-title">Edit Pacakge</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										//pr($package);
										echo form_open(site_url()."admin/package/editPackage/".ID_encode($package->id),array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										<!--<form method="post" class="form-horizontal">-->								
											<input type="hidden" name="id" value="<?php echo ID_encode($package->id);?>">
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input type="text" name="title" value="<?php echo $package->title;?>" class="form-control" placeholder="Title">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Amount (<?php echo currency();?>):</label>
													<div class="col-lg-9">
														<input type="text" name="amount" value="<?php echo $package->amount;?>" class="form-control" placeholder="Amount">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label"></label>
													<div class="col-lg-9">
														<img width="30%" src="<?php echo site_url();?>images/<?php echo $package->pkg_image; ?>">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Package Image:</label>
													<div class="col-lg-9">
														<input name='pkg_image' type="file" class="file-input">
														<input type="hidden" name="old_pkg_img" value="<?php if(!empty($package->pkg_image))echo $package->pkg_image;?>">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Description:</label>
													<div class="col-lg-9">
														<textarea id="description" name="description" class="col-lg-3 control-label"><?php echo $package->description;?></textarea>
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="editPackage" class="btn btn-primary">Update<i class="icon-arrow-right14 position-right"></i></button>
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
	CKEDITOR.replace( 'description');
	</script>			