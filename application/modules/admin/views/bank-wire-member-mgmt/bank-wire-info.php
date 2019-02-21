<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Member Management</span> - Bank Wire Details</h4>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active">Member Management</li>
                        <li class="active">Bank Wire Details</li>
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
							<h5 class="panel-title">Bank Wire Details</h5>
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
										<th>Name</th>
										<th>Account No.</th>
										<th>Bank Name</th>
										<th>Branch Code</th>
										<th>Action</th>
									</tr>
								</thead>
								<?php 
								$name=(!empty($details->name))?$details->name:null;
								$account_no=(!empty($details->account_no))?$details->account_no:null;
								$bank_name=(!empty($details->bank_name))?$details->bank_name:null;
								$branch_code=(!empty($details->branch_code))?$details->branch_code:null;
								?>
								<tbody>
									<tr>
										<td><?php echo $name;?></td>
										<td><?php echo $account_no;?></td>
										<td><?php echo $bank_name;?></td>
										<td><?php echo $branch_code;?></td>
										
										<td>
					                      <a onclick="return editConfirm();" href="<?php echo site_url();?>admin/BankWireMemberReport/updateBankWireDetail/<?php echo ID_encode($details->id);?>">Edit</a>
					                    </td>
					                    <td></td>
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
function editConfirm()
  {
    if(window.confirm("Are you sure, you want to edit bank wire details"))
      return true;
    else 
      return false;
  }
</script>            