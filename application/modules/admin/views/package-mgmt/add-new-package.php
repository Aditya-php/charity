<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - Add New Package</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Package Management</li>
							<li class="active">Add New Package</li>
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
								<div class="panel panel-flat">
									<div class="panel-heading">
										<h5 class="panel-title">Add New Package</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url()."admin/package/addNewPackage",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input type="text" name="title" class="form-control" placeholder="Title">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Package Amount<?php echo " (".currency().")";?>:</label>
													<div class="col-lg-9">
														<input type="number" min="0" name="amount" class="form-control" placeholder="Package Amount">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Package Image:</label>
													<div class="col-lg-9">
														<input name='pkg_image' type="file" class="file-input">
													</div>
												</div>

												<div class="form-group">
													<label class="col-lg-3 control-label">Description:</label>
													<div class="col-lg-9">
														<textarea id="description" name="description" class="col-lg-3 control-label"></textarea>
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="addNewPackage" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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