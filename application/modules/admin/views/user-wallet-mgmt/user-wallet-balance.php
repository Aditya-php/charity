<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User E-Wallet</span> - User Wallet Balance</h4>
         </div>
         
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">User E-Wallet</a></li>
            <li class="active">User Wallet Balance</li>
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
               <h5 class="panel-title">User Wallet Balance</h5>
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
                     <th>User Name</th>
                     <th>User Id</th>
                     <th>Rank Name</th>
                     <th>Wallet Balance</th>
                     <th>Registration Date</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_user_wallet_balance) && count($all_user_wallet_balance)>0)
                  {
                     $sno=0;
                     foreach($all_user_wallet_balance as $wallet)
                     {
                     $sno++;
                     $label_class=(!empty($wallet->active_status=='1'))?'label-success':'label-danger';
                     $label=(!empty($wallet->active_status=='1'))?'Active':'Inactive';
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $wallet->username;?></td>
                     <td><?php echo $wallet->user_id;?></td>
                     <td><?php echo (!empty($wallet->rank_name))?$wallet->rank_name:'No Rank achieve';?></td>
                     <td><?php echo $wallet->balance." ".currency();?></td>
                     <td><?php echo date(date_formats(),strtotime($wallet->registration_date));?></td>
                     <td><span class="label <?php echo $label_class;?>"><?php echo $label;?></span></td>
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
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->