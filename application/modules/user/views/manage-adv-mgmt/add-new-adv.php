
<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Advertise Management</span> - Add New Advertisement</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Advertise Management</li>
							<li class="active">Add New Advertisement</li>
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
										<h5 class="panel-title">Add New Advertisement</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url()."user/ManageAdv/addNewAdv",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Select Cateory:</label>
													<div class="col-lg-9">
														<select class="form-control" required name="category_id">
															<option value="">Select Category</option>
															<?php 
															if(!empty($all_publish_category) && count($all_publish_category)>0)
															{

																foreach ($all_publish_category as $category) 
																{
															?>
																<option value="<?php echo $category->id;?>"><?php echo $category->title;?></option>
															<?php 		
																}
															}
															?>
														</select>	
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Title:</label>
													<div class="col-lg-9">
														<input type="text" required name="title" class="form-control" placeholder="Title">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Price:</label>
													<div class="col-lg-9">
														<input type="text" required name="price" class="form-control" placeholder="Price">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Image:</label>
													<div class="col-lg-9">
														<input required="" name='image' type="file" class="file-input">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Thumb Image1:</label>
													<div class="col-lg-9">
														<input name='image1' type="file" class="file-input">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Thumb Image2:</label>
													<div class="col-lg-9">
														<input name='image2' type="file" class="file-input">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">AAdvertisement Thumb Image3:</label>
													<div class="col-lg-9">
														<input name='image3' type="file" class="file-input">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Thumb Image4:</label>
													<div class="col-lg-9">
														<input name='image4' type="file" class="file-input">
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-lg-3 control-label">Advertisement Description:</label>
													<div class="col-lg-9">
														<textarea id="description" name="descs" class="col-lg-3 control-label"></textarea>
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="addNewAdv" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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