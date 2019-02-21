<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payment Mode Management</span> - Bit Coin Payment Details</h4>
         </div>
		 <?php 
		 if(empty($payment_details))
		 {
		 ?>
		 <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url().$module_name;?>/payment_mode_setting/addBitCoinPaymentDetails" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Bit Coin Payment Details</a>
            </div>
         </div>
		 <?php 
		 }
		 ?>
		 
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url().$module_name;?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Payment Mode Management</a></li>
            <li class="active">Bit Coin Payment Details</li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Bit Coin Payment Details</h5>
            <h3 style="color:green"><?php echo $this->session->flashdata('flash_msg');?></h3>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
         <table class="table">
            <thead>
               <tr>
                  <th>Bit Coin Id</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               if(!empty($payment_details) && count($payment_details)>0)
               {
                  $sno=0;
                  foreach ($payment_details as $details) 
                  {
                     $sno++;
               ?>
               <tr>
                  <td><?php echo $details->bit_coin_id;?></td>
                  <td>
                     <a href="<?php echo site_url().$module_name;?>/payment_mode_setting/editBitCoinPaymentDetails/<?php echo ID_encode($details->id);?>">Edit</a>
                     &nbsp;&nbsp;&nbsp;

                     <a onclick="return confirmDelete();" href="<?php echo site_url().$module_name;?>/payment_mode_setting/deleteBitCoinPaymentDetails/<?php echo ID_encode($details->id);?>">Delete</a>

                  </td>
                  </td>
               </tr>
               <?php       
                  }
               }
               ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
   function confirmChangeStatus()
   {
   
      if(window.confirm('Are you sure, you want to change the status!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   function confirmDelete()
   {
   
      if(window.confirm('Are you sure, you want to delete!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
</script>