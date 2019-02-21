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
							<li class="active">Package Management</li>
							<?php echo $breadcrumb;?>
						</ul>
					</div>
				</div>
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Horizontal form options -->
					<div class="row">
					  	<?php 
					  	//pr($packages);
					  	if(!empty($packages) && count($packages)>0)
					  	{
					  		foreach ($packages as $package) 
					  		{
					  	?>
					  	<div class="col-md-4">
							<!-- Basic layout-->
							<div class="panel panel-flat border-top-success">
									<div class="panel-body text-center">
									<div class="border-success text-success">
										<!--<i class="icon-book"></i>-->
										<img style='border-radius:50%' width="90%" src='<?php echo base_url().'images/'.$package->pkg_image;?>'>
									</div>
									<h5 class="text-semibold">Package Name : <?php echo $package->title;?></h5>
									<p class="mb-15">Package Amount : $ <?php echo $package->amount;?></p>
									<a href="<?php echo site_url();?>user/package/activatePackage/<?php echo $package->id;?>" class="btn bg-success-400">Upgrade Now</a>
								</div>
							</div>
							<!-- /basic layout -->
						</div>
					  	<?php 	
					  		}
					  	}
					  	else 
					  	{
					  	?>
					  	<h4>No Package available for upgrade.</h4>
					  	<?php	
					  	}
					  	?>
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
