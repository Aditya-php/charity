<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Rank Management</span> - All Ranks</h4>
                     </div>
                     <div class="heading-elements">
                        <div class="heading-btn-group">
                         <a href="<?php echo site_url();?>admin/rank/addNewRank" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Rank</a>
                        </div>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Manage Rank</li>
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
							<h5 class="panel-title">Rank Management</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
						<div class="table-responsive">
							<table class="table datatable-html">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Rank Name</th>
										<th>Direct Member</th>
										<th>Team Member</th>
										<th>Bonus Amount</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>Sr.</td>
										<td>Rank Name</td>
										<td>Direct Member</td>
										<td>Team Member</td>
										<td>Bonus Amount</td>
										<td> 
											<ul class="icons-list">
										         <li>
										         <a href="add-rank.php?rid=1" data-popup="tooltip" title="" data-original-title="Edit Package"><i class="icon-pencil7"></i></a>
										         </li>
											</ul>
										</td>
									</tr>
							
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

  function deleteConfirm()
  {

  	if(window.confirm("Are you sure, you want to delete"))
      return true;
    else 
      return false;
  }
</script>            