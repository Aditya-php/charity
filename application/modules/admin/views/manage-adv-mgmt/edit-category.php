 <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/uploaders/fileinput.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/uploader_bootstrap.js"></script>
<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Advertise Management</span> - Edit Category</h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="#">Advertise Management</li>
							<li class="active">Edit Category</li>
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
										<h5 class="panel-title">Edit Category</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url()."admin/ManageAdv/editCategory/".ID_encode($id),array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										$title=(!empty($category_info->title))?$category_info->title:null;
										$old_image=(!empty($category_info->image))?$category_info->image:null;

										?>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Title:</label>
													<div class="col-lg-9">
														<input type="text" value="<?php echo $title;?>" required name="title" class="form-control" placeholder="Title">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Profile Pic:</label>
													<div class="col-lg-9">
														<?php
														if(!empty($category_info->image))
														{ 
														?>
                                                        <div class="file-preview-old">
															   <div class="file-preview-thumbnails">
															<div class="file-preview-frame">
															   <img src="<?php echo base_url();?>images/<?php echo $category_info->image;?>" class="file-preview-image" style="width:auto;height:160px;">
															</div>
															</div>
															   <div class="clearfix"></div>   <div class="file-preview-status text-center text-success"></div>
															   <div class="kv-fileinput-error file-error-message" style="display: none;"></div>
                                                       </div>	
														<?php	
													     }
														?>
														
														<input name='image' type="file" class="file-input">

														<input  name='image_old' value="<?php echo $old_image;?>" type="hidden">
										
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="addNewCategory" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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