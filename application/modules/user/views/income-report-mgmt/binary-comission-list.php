<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Wallet Management</span> - <?php echo $title;?></h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>user/ewallet/depositWalletAmountRequest" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add New Deposit Request</a>
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">Income Report</a></li>
            <li class="active"><?php echo $title; ?></li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title"><?php echo $title; ?></h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="panel-heading">
                     <p>Please Select the Date Range to View Your Commission Report</p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="display-block">Please Select the Date Rane </label>
                     <button type="button" class="btn btn-success daterange-ranges">
                     <i class="icon-calendar22 position-left"></i> <span></span> <b class="caret"></b>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Binary Income Report</h5>
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
                     <th>Sr.No</th>
                     <th>User Id</th>
                     <th>User Name</th>
                     <th>Amount</th>
                     <th>Transaction Type</th>
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_binary_income=0;
                  if(!empty($binary_income) && count($binary_income)>0)
                  {
                     $sno=1;
                     foreach ($binary_income as $income) 
                     {
                      $total_binary_income=$total_binary_income+$income->credit_amt;  
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $income->user_id;?></td>
                        <td><?php echo $income->username;?></td>
                        <td><?php echo $income->credit_amt.currency();?></td>
                        <td><?php echo $income->ttype;?></td>
                        <td><?php echo date(date_formats(),strtotime($income->create_date));?></td>
                     </tr>
                  <?php
                     $sno++;       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Binary Income</h6>
               </div>
               <div class="panel-body">
                  <?php echo currency()." ".$total_binary_income;?>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-flat border-left-xlg border-left-success">
               <div class="panel-heading">
                  <h6 class="panel-title"><span class="text-semibold">Graph of the Level Income Report</span> </h6>
               </div>
               <div class="panel-body">
                  Graph will be displayed here
               </div>
            </div>
         </div>
      </div>
      <!-- Pickadate picker -->
      <!-- /pickadate picker -->
      <!-- Pickatime picker -->
      <!-- /pickadate picker -->
      <!-- Anytime picker -->
      <!-- /anytime picker -->
      <!-- Footer -->
      <?php 
         $this->load->view('common/footer-text');
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