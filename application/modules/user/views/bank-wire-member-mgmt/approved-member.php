<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Member Management</span> - Approved Members</h4>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Member Management</li>
                        <li class="active">Approved Members</li>
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
							<h5 class="panel-title">All Approved Members</h5>
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
										<th>Username</th>
										<th>First</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Contact No.</th>
										<th>View Proof</th>
										<th>Approved Date</th>
										<th>Registration Date</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(!empty($all_approved_member) && count($all_approved_member)>0) 
									{
										$sno=0;
										foreach($all_approved_member as $member)
										{
										$sno++;	
									?>
									<tr>
										<td><?php echo $sno;?></td>
										<td><?php echo $member->username;?></td>
										<td><?php echo $member->first_name;?></td>
										<td><?php echo $member->last_name;?></td>
										<td><?php echo $member->email;?></td>
										<td><?php echo $member->contact_no;?></td>
										<td><a href="<?php echo site_url();?>images/<?php echo $member->proof; ?>" target="_blank">View Proof</a></td>
										<td><?php echo date(date_formats(),strtotime($member->action_date));?></td>
										<td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
									</tr>
									<?php 		
										}
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

  function deleteConfirm()
  {

  	if(window.confirm("Are you sure, you want to delete"))
      return true;
    else 
      return false;
  }
</script>            