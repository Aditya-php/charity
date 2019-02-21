<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payment Mode Management</span> - Edit Mobile Money Provider Details</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url().$module_name;?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Payment Mode Management</a></li>
            <li class="active">Edit Mobile Money Provider Details</li>
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
										<h5 class="panel-title">Edit Mobile Money Provider Details</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
										echo form_open(site_url().$module_name."/payment_mode_setting/editMobileMoneyProviderDetails",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										
										$money_provider_array=array(
										'1'=>'Orange',
										'2'=>'MTN',
										'3'=>'Moov'
										);
										
										$money_provider_id=(!empty($payment_details->money_provider_id))?$payment_details->money_provider_id:null;
										
										$money_provider_name=(!empty($payment_details->money_provider_name))?$payment_details->money_provider_name:null;
										
										$mobile_number=(!empty($payment_details->mobile_number))?$payment_details->mobile_number:null;
										
										?>
											<div class="panel-body">
												<div class="form-group">
													<label class="col-lg-3 control-label">Select Money Provider:</label>
													<div class="col-lg-9">
														<select name="money_provider_id" required class="form-control" placeholder="money provider">
															<option value="">-Select Money Provider-</option>
															<?php 
															foreach($money_provider_array as $k=>$provider_name)
															{
																if($money_provider_id==$k)
																{
															?>
																<option selected value="<?php echo $k;?>"><?php echo $provider_name;?></option>
															<?php 
																}
																else 
																{
															?>
																<option value="<?php echo $k;?>"><?php echo $provider_name;?></option>
															<?php 
																}
															?>
															<?php 
															}
															?>
														</select>
													</div>
												</div>
												<div class="form-group">
													<label class="col-lg-3 control-label">Enter Corresponding Mobile Number:</label>
													<div class="col-lg-9">
														<input type="text" required="" value="<?php echo $mobile_number;?>" name="mobile_number" class="form-control" placeholder="Enter Corresponding Mobile Number">
													</div>
												</div>
												<input type="hidden" name="id" value="<?php echo $payment_details->id;?>">
												<div class="text-right">
													<button type="submit" name="btn" value="edit" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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