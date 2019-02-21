<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Wallet</span> - Ewallet Balance</h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">E-Wallet</a></li>
            <li class='active'>Ewallet Balance</li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Horizontal form options -->
      <div class="row">
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-body bg-danger-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo currency()." ".$ewallet_balance;?></h3>
                     <span class="text-uppercase text-size-mini">My Wallet Balance</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-wallet icon-3x opacity-75"></i>
                  </div>
               </div>
            </div>
            <!-- /basic layout -->
         </div>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-flat border-top-success">
               <div class="panel-body text-center">
                  <a href="<?php echo site_url();?>admin/UserWallet/manageUserWallet" class="btn bg-success-400">Manage E-Wallet Balance</a>
               </div>
            </div>
            <!-- /basic layout -->
         </div>
      </div>
      <!-- /vertical form options -->
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