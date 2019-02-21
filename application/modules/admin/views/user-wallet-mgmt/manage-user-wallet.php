<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">User E-Wallet</span> - Manage User Wallet</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">User Ewallet</a></li>
            <li class="active">Manage User Wallet</li>
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
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <!--<span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet-->
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php   
         }
         ?>
     <?php 
         if(!empty($this->session->flashdata('error_msg')))
         {
         ?>
      <div class="alert alert-warning alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <?php echo $this->session->flashdata('error_msg');?>
      </div>
      <?php   
         }
         ?>
      <div class="panel panel-flat col-md-5">
         <div class="panel-heading">
            <h5 class="panel-title">Add Fund in User Wallet</h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <form action="<?php echo site_url();?>admin/UserWallet/addFundToUserWallet" method="post">
                  <div class="">
                      <div class="form-group">
					    <i>Enter Username/UserId*</i>
                        <input type="text" name="username" id="add_username" class="form-control" placeholder="Enter Username/UserId">
						<span id="add_available_amount"></span>
                     </div>
                     <div class="form-group">
					    <i>Enter Amount*</i>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                     </div>
					 <i>Enter Description</i>
                     <div class="form-group">
                        <input type="text" name="desciption" id="desciption" class="form-control" placeholder="Enter Description">
                     </div>
					 <i>Enter Transaction Password*</i>
                     <div class="form-group">
                        <input type="password" name="transaction_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class="valid_transaction_password" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="btn" value="add" id="addFundBtn" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Add Fund</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
	  
	  <div class="col-md-2"></div>
      <div class="panel panel-flat col-md-5">
         <div class="panel-heading">
            <h5 class="panel-title">Deduct Fund from User Wallet</h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <form action="<?php echo site_url();?>admin/UserWallet/deductFundFromUserWallet" method="post">
                  <div class="">
                      <div class="form-group">
					    <i>Enter Username/UserId*</i>
                        <input type="text" name="username" id="deduct_username" class="form-control" placeholder="Enter Username/UserId">
						<span id="deduct_available_amount"></span>
                     </div>
                     <div class="form-group">
					    <i>Enter Amount*</i>
                        <input type="text" name="amount" id="amount" class="form-control" placeholder="Enter Amount">
                     </div>
					 <i>Enter Description</i>
                     <div class="form-group">
                        <input type="text" name="desciption" id="desciption" class="form-control" placeholder="Enter Description">
                     </div>
					 <i>Enter Transaction Password*</i>
                     <div class="form-group">
                        <input type="password" name="transaction_password" class="form-control" placeholder="Enter Transaction Password">
                        <span class="valid_transaction_password" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group">
                        <button type="submit" name="btn" value="add" id="addFundBtn" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Deduct Fund</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
$(document).ready(function(){
         $("#add_username").change(function(){
            var username=$(this).val();
            $.ajax({
                  url: "<?php echo site_url();?>admin/UserWallet/getUserEwalletBalance/"+username,
                  method: "GET",
				  beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
                         if(res.user=='1')
                         {
						   $("#add_available_amount").text("available balance: "+res.balance+"R").css({'color':'green','font-weight':'bold'});
                         }
                         else 
                         {
                           $("#add_available_amount").text('Sorry username does not exists').css({'color':'red','font-weight':'bold'});
                         }
                  },
				  complete: function () {
                       $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
            });
         }); //end change
		 
		 
		 $("#deduct_username").change(function(){
            var username=$(this).val();
            $.ajax({
                  url: "<?php echo site_url();?>admin/UserWallet/getUserEwalletBalance/"+username,
                  method: "GET",
				  beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
                         if(res.user=='1')
                         {
						   $("#deduct_available_amount").text("available balance: "+res.balance+"R").css({'color':'green','font-weight':'bold'});
                         }
                         else 
                         {
                           $("#deduct_available_amount").text('Sorry username does not exists').css({'color':'red','font-weight':'bold'});
                         }
                  },
				  complete: function () {
                       $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
            });
         }); //end change
});//end ready
</script>