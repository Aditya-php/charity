<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Marketing Tools</span> - Referral Link</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Marketing Tools</a></li>
            <li class="active">Referral Link</li>
         </ul>
        
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!--
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
      </div>
      <div class="alert alert-warning alert-styled-right">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <span class="text-semibold">Warning!</span> Oh! Transaction Password is Wrong
      </div>
      -->
      <div class="panel panel-flat border-top-lg border-top-warning">
         <div class="panel-heading">
            <h6 class="panel-title"><span class="text-semibold">My Referral Link</span></h6>
         </div>
         <div class="panel-body">
            <button type="button" class="btn btn-primary btn-xlg"><?php echo $referral_link;?></button>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->