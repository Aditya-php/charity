	<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - Commission Management</h4>
                     </div>
                     <div class="heading-elements">
                        
                        <div class="heading-btn-group">
                         <a href="<?php echo site_url();?>admin/package/allPackages" class="btn btn-success"><i class="icon-arrow-left52 position-left"></i> Back</a>
                        </div>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active"><a href="<?php echo site_url();?>admin/package/allPackages">All Packages</a></li>
                        <li class="">Commission Management (<?php echo $package_title;?>)</li>
                     </ul>
					 <ul class="breadcrumb">
                     </ul>
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
               <div class="content">
				<?php echo $this->session->flashdata('flash_msg');?>
                 <div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Commission Management (<?php echo $package_title;?>)</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
						<div class="table-responsive">
							<table class="table">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Commission Type</th>
										<th>Status</th>
										<th>Configure</th>
									</tr>
								</thead>
								<tbody>
									<!--
									<tr>
										<td>1</td>
										<td>Manager</td>
										<td>10</td>
										<td>100</td>
										<td>$ 50</td>
										<td> 
											<ul class="icons-list">
										         <li>
										         <a href="add-rank.php?rid=1" data-popup="tooltip" title="" data-original-title="Edit Package"><i class="icon-pencil7"></i></a>
										         </li>
											</ul>
										</td>
									</tr>
									-->
									<?php 
                                    $sno=0;
                                    foreach ($data as $rowObj) 
                                    {
                                    	# code...
                                    	$sno++;
                                    	$permission_status=($rowObj->perm_status==1)?'on':'off';
                                    	$tooltip_title=($permission_status=='on')?'off':'on';
                                    	$url=$rowObj->url;

                                    ?>
                                    <tr>
										<td><?php echo $sno;?></td>
										<td><?php echo $rowObj->ctype_title;?></td>
										<td>
											<a onclick="return changeCommissionPermissionStatus();" href="<?php echo site_url();?>admin/package/changePackageCommissionTypeStatus/<?php echo ID_encode($rowObj->perm_id);?>" data-popup="tooltip" title="<?php echo $tooltip_title;?>" data-original-title=""><?php echo $permission_status;?></a>
										</td>
										<td><a href="<?php echo site_url();?>admin/<?php echo $url;?>/<?php echo ID_encode($rowObj->pkg_id);?>">Configure</a></td>
									</tr>
                                    <?php
                                    }
									?>
									
								</tbody>
							</table>
						</div>
					</div>
                  <!-- Footer -->
	                  <?php
	                  $this->load->view("common/footer-text");
	                  ?>
                  <!-- /footer -->
               </div>
               <!-- /content area -->
            </div>
<script>

  function changeCommissionPermissionStatus()
  {

  	if(window.confirm("Are you sure, you want to change the permission status"))
      return true;
    else 
      return false;
  }
</script>            