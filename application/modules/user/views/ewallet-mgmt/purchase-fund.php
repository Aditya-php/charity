<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Ewallet Management</span> - <?php echo $title;?></h4>
         </div>
        
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
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
      <!-- Horizontal form options -->
      <div class="row">
         <?php 
         if(!empty($this->session->flashdata('flash_msg')))
         {
         ?>
         <div class="col-md-12">
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <?php echo $this->session->flashdata('flash_msg');?>
            </div>
         </div>
         <?php    
         }
         ?>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-flat border-top-success">
               <!-- Subscription form -->
               <div class="panel panel-flat">
                  <div class="panel-heading">
                     <h6 class="panel-title">Purchase Wallet Fund </h6>
                  </div>
                  <?php 
                  echo form_open(site_url()."user/ewallet/purchaseFund",array('method'=>'post','class'=>'panel-body', 'enctype'=>'multipart/form-data'));
                  ?>
                     <div class="panel panel-flat">
                        <div class="panel-heading">
                           <h6 class="panel-title">Wallet Amount</h6>
                        </div>
                        <div class="panel-body">
                           <input id="wallet_amount" disabled type="text" value="<?php echo $current_balance;?>" class="form-control">
                        </div>
                        <div id="show_amount_div">
                        </div>
                     </div>

                     <div class="form-group has-feedback">
                        <input id="deposit_amount" name="deposit_amount" type="text"  class="form-control" placeholder="Enter Purchase Amount">
                        <span id="valid_deposit_amount" style="color:red;font-weight:bold"></span>
                     </div>
                     <div class="form-group has-feedback">
                        <input name="deposit_title" type="text"  class="form-control" placeholder="Enter Title">
                     </div>

                     <div class="panel panel-flat">
                        <div class="panel-heading">
                           <h6 class="panel-title">Upload image</h6>
                        </div>
                        <div class="panel-body">
                           <input id="deposit_proof" name='deposit_proof' type="file" class="file-styled">
                           <span class="help-block no-margin-bottom">Accepted formats: gif, png, jpg</span>
                           <span id="valid_deposit_proof" style="color:red;font-weight:bold"></span>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-xs-6">
                           <div class="checkbox disabled">
                              <label>
                              <input type="checkbox" class="styled" checked="checked" disabled="disabled">
                              Accept terms
                              </label>
                           </div>
                        </div>
                        <div class="col-xs-6 text-right">
                           <button id="submit_btn" type="submit" name="btn" value='submit' class="btn btn-info">Purchase Fund</button>
                        </div>
                     </div>
                  <?php echo form_close();?>
               </div>
               <!-- /subscription form -->
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
$(document).ready(function(){
   $("#deposit_amount").keyup(function()
   {
    $("#show_amount_div").html(null);
      var deposit_amount=parseInt($(this).val());
      var wallet_amount=parseInt($("#wallet_amount").val());
    if(isNaN($(this).val()))
    {
    $("#valid_deposit_amount").text("Please enter valid deposit amount!").css('display','');
    return false;
    }
    $("#valid_deposit_amount").text(null).css('display','none');
    var rem_amount=wallet_amount+deposit_amount;
    var rem_msg="Your Amount Will Be: "+rem_amount;
    $("#show_amount_div").html(rem_msg);
   });//end keyUp
   $("#submit_btn").click(function(){
         var deposit_amount=parseInt($("#deposit_amount").val());
         var wallet_amount=parseInt($("#wallet_amount").val());
       if($("#deposit_amount").val()=='' || $("#deposit_amount").val()==null)
       {
       $("#valid_deposit_amount").text("Please enter deposit amount!").css('display','');
       return false;
       }
       if($("#deposit_proof").val()=="" || $("#deposit_proof").val()==null)
       {
       $("#valid_deposit_proof").text("Please upload deposit proof!").css('display','');
       return false;
       }
       return true;


   });//end submit btn click here
});//end ready
</script>            