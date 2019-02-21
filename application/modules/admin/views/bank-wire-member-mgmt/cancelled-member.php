<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Member Management</span> - Cancelled Members</h4>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Member Management</li>
                        <li class="active">Cancelled Members</li>
                     </ul>
					 <ul class="breadcrumb">
                     </ul>
                  </div>
               </div>
               <!-- /page header -->
               <!-- Content area -->
               <div class="content">
				<?php 
				 if(!empty($this->session->flashdata('flash_msg')))
				 {
			     ?>
					 <h4>
						 <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
									  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									  <?php 
									  echo $this->session->flashdata('flash_msg');
									  ?>
						  </div>
					 </h4>
				 <?php 
				 }
				 if(!empty($this->session->flashdata('error_msg')))
				 {
			     ?>
					 <h4>
						 <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
									  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
									  <?php 
									  echo $this->session->flashdata('error_msg');
									  ?>
						  </div>
					 </h4>
				 <?php 
				 }
				 ?>
                 <div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">All Cancelled Members</h5>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						<a class="heading-elements-toggle"><i class="icon-menu"></i></a><a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
						<div class="table-responsive">
							<?php 
							$payment_method_array=array(
								'1'=>'Bank Wire',
								'2'=>'Bit Coin',
								'3'=>'Mobile Money Provider'
								);
							?>
							<table class="table datatable-responsive">
								<thead>
									<tr>
										<th>Sr.</th>
										<th>Username</th>
										<th>First</th>
										<th>Last Name</th>
										<th>Email</th>
										<th>Contact No.</th>
										<th>View Proof</th>
										<th>Payment Method</th>
										<th>Cancelled Date</th>
										<th>Registration Date</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(!empty($all_cancelled_member) && count($all_cancelled_member)>0) 
									{
										$sno=0;
										foreach($all_cancelled_member as $member)
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
										<td>
										<?php 
										 echo $payment_method_array[$member->payment_method];
										?>
										</td>
										<td>
										  <?php 
										  if(!empty($member->proof))
										  {
										  ?>
										   <a href="<?php echo site_url();?>images/<?php echo $member->proof; ?>" target="_blank">View Proof</a>
										  <?php
										  }
										  else 
										  {
										  ?>
										   not uploaded
										  <?php 
										  }
										  ?>  
										</td>
										<td><?php echo date(date_formats(),strtotime($member->action_date));?></td>
										<td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
										
										<td>
					                      <ul class="icons-list">
					                        <li class="dropdown">
					                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
					                            <i class="icon-menu9"></i>
					                          </a>

					                          <ul class="dropdown-menu dropdown-menu-right">
											  
											 
					                           
												 <li><a onclick="return approveConfirm();" href="<?php echo site_url();?>admin/BankWireMemberReport/approveCancelledMember/<?php echo ID_encode($member->id);?>">Approve Member</a>
					                            </li>
					                          </ul>
					                        </li>
					                      </ul>
					                    </td>
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