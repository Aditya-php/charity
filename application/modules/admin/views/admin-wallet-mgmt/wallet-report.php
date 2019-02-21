<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Wallet</span> - Admin Wallet Report</h4>
         </div>
         
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">E-Wallet</a></li>
            <li class="active">Admin Wallet Report</li>
         </ul>
         
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Admin Wallet Report</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.</th>
                     <th>Transaction No.</th>
                     <th>Title</th>
                     <th>Balance</th>
                     <th>Amount</th>
                     <th>Status</th>
                     <th>Description</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     //pr($data);
                     if(!empty($all_statements) && count($all_statements)>0)
                     {
                        $sno=1;
                        foreach ($all_statements as $statementObj) 
                        {
                        # code...
                        $status=($statementObj->status==1)?"Credit":"Debit";
                        $amount=($statementObj->status==1)?$statementObj->credit_amt:$statementObj->debit_amt;
                        $sign=($statementObj->status==1)?"+":"-";
                        
						if($statementObj->reason=='11')
						{
							$statementObj->description=$statementObj->description." to ".get_user_name($statementObj->receiver_id);
						}
						else if($statementObj->reason=='19')
						{
							$statementObj->description=$statementObj->description." to ".get_user_name($statementObj->receiver_id);
						}
						else if($statementObj->reason=='21')
						{
							$statementObj->description=$statementObj->description." by ".get_user_name($statementObj->sender_id);
						}
						?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $statementObj->transaction_no;?></td>
                     <td><?php echo $statementObj->title;?></td>
                     <td><?php echo $statementObj->balance." ".currency();?></td>
                     <td><?php echo $sign.$amount." ".currency();?></td>
                     <td><?php echo $status;?></td>
                     <td><?php echo $statementObj->description;?></td>
                     <td><?php echo date(date_formats(),strtotime($statementObj->date));?></td>
                  </tr>
                  <?php
                     $sno++;     
                     }//end foreach!
                     }//end empty if!
                     ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->