<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Package Management</span> - <?php echo $title;?></h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Account Management</li>
							<?php echo $breadcrumb;?>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<?php echo $this->session->flashdata('flash_msg');?>
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-6">
							<!-- Basic layout-->
							<div class="panel panel-flat border-top-success">
								<?php 
								if(!empty($my_active_ackage) && count($my_active_ackage)>0)
								{
									//pr($my_active_ackage);
								?>
								<div class="panel-body text-center">
									<div class="border-success text-success">
										<!--<i class="icon-book"></i>-->
									    <img style='border-radius:50%' width="20%" width="200px" src='<?php echo base_url().'images/'.$my_active_ackage->pkg_image;?>'>	
									</div>
									<h5 class="text-semibold">Package Name : <?php echo $my_active_ackage->title;?> </h5>
									<p class="mb-15">Package Amount : $ <?php echo $my_active_ackage->amount;?></p>
									<p class="mb-15">Date of Activation : <?php echo date(date_formats(),strtotime($my_active_ackage->created_date));?></p>
									<p class="mb-15">Expire Date : No Expiry</p>
									<p class="mb-15">Satus : Active</p>
								</div>
								<?php 
								}
								?>
							</div>
							<!-- /basic layout -->
						</div>
						<div class="col-md-6">
							<!-- Basic layout-->
							<div class="panel panel-flat border-top-success">
								<div class="panel-heading">
									<h6 class="panel-title">Package upgraded log information</h6>
								</div>
								<div class="panel-body">
								<?php 
								//pr(getPackageInfo(5));
								if(!empty($package_log) && count($package_log)>0)
								{
									foreach ($package_log as $log) 
									{
									$old_package_info=getPackageInfo($log->old_package_id);
                                    $new_package_info=getPackageInfo($log->new_package_id);
								?>
								->Dear User You have upgraded <?php echo $new_package_info->title;?> from <?php echo $old_package_info->title;?> on date <?php echo date(date_formats(),strtotime($log->purchased_date));?> <br>
								<?php 		
									}//end foreach here!
								}
								else 
								{
								?>
								You have not upgraded any package from starting..........
								<?php 	
								}//end if else here!
								?>
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
