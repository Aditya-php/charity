<div class="content-wrapper">
				<!-- Page header -->
               <div class="page-header">
                  <div class="page-header-content">
                     <div class="page-title">
                        <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Ewallet Management</span> - <?php echo $title;?></h4>
                     </div>
                     <div class="heading-elements">
                        <div class="heading-btn-group">
                         <a href="<?php echo site_url();?>user/ewallet/fundTransfer" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Fund Transfer</a>
                        </div>
                     </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
                  <div class="breadcrumb-line">
                     <ul class="breadcrumb">
                        <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
                        <li>Ewallet Management</li>
                        <li class='active'><?php echo $title;?></li>
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
										<th>Transaction No.</th>
										<th>UserId</th>
										<th>Username</th>
										<th>Amount</th>
										<th>Transfer Date</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<?php 
									//pr($all_statements);
									if(!empty($all_statements) && count($all_statements))
									{
									  $sno=0;	
									  foreach ($all_statements as $statement) 
									  {
									  $sno++;	
									?>
									<tr>
										<td><?php echo $sno;	?></td>
										<td><?php echo $statement->transaction_no;?></td>
										<td><?php echo $statement->receiver_id;?></td>
										<td><?php echo get_user_name($statement->receiver_id);?></td>
										<td><?php echo $statement->debit_amt;?></td>
										<td><?php echo date(date_formats(),strtotime($statement->receive_date));?></td>
										<td></td>
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