<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payment Mode Management</span> - Add Bank Wire Details</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url().$module_name;?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Payment Mode Management</a></li>
            <li class="active">Add Bank Wire Details</li>
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
										<h5 class="panel-title">Add Bank Wire Details</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url().$module_name."/payment_mode_setting/addBankWirePaymentDetails",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Bank Name:</label>
													<div class="col-lg-9">
														<input type="text" name="bank_name" class="form-control" placeholder="Bank Name">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Account Name:</label>
													<div class="col-lg-9">
														<input type="text" name="account_name" class="form-control" placeholder="Account Name">
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Account No:</label>
													<div class="col-lg-9">
														<input type="text" name="account_no" class="form-control" placeholder="Account No">
													</div>
												</div>
												<div class="text-right">
													<button type="submit" name="btn" value="add" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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