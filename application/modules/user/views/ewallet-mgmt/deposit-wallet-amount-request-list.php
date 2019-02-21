<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Wallet Management</span> - <?php echo $title;?></h4>
                     </div>
                    
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li class="active"><a href="#">Wallet Management</a></li>
                        <li class="active"><?php echo $title; ?></li>
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
							<h5 class="panel-title"><?php echo $title;?></h5>
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
										<th>Deposit ID</th>
										<th>Deposit Amount</th>
										<th>View Proof</th>
										<th>Status</th>
										<th>Request Date</th>
										<th>Response Date</th>	
									</tr>
								</thead>
								<tbody>
									<?php 
									if(!empty($deposit_request) && count($deposit_request)>0)
									{
										$sno=0;
										foreach ($deposit_request as $request) 
										{
										$sno++;
									    if($request->status=='0')
									        $status="<b style='color:red'>Pending</b>";
									    elseif($request->status=='1')
									        $status="<b style='color:green'>Approved</b>";
									    elseif($request->status=='2')
									        $status="<b style='color:red'>Cancelled</b>";
									    $response_date=(!empty($request->response_date))?date(date_formats(),strtotime($request->response_date)):'---';

									?>
									<tr>
										<td><?php echo $sno;?></td>
										<td><?php echo $request->deposit_id;?></td>
										<td><?php echo $request->amount." ".currency();?></td>
										<td><a target="_blank" href="<?php echo base_url();?>images/<?php echo $request->file_proof;?>">View Proof</a></td>
										<td><?php echo $status;?></td>
										<td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
										<td><?php echo $response_date;?></td>	
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