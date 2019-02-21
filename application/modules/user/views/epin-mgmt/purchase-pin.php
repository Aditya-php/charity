<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Pin Management</span> - <?php echo $title;?></h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>E-Pin Management</li>
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
         <div class="col-md-12">
            <!--
             <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <span class="text-semibold">Well done!</span> You successfully read <a href="#" class="alert-link">this important</a> alert message.
            </div>
             -->
         </div>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-flat border-top-success">
               <!-- Subscription form -->
               <div class="panel panel-flat">
                  <div class="panel-heading">
                     <h6 class="panel-title">Purchase Epin </h6>
                  </div>
                  <form class="panel-body" action="<?php echo site_url();?>user/epin/purchasePin" method="post" enctype="multipart/form-data">
                     <div class="form-group">
                        <select id="pkg_id_1" onchange="getPinAmount(this,1)" name="pkg_id[]"  data-placeholder="Select Package" class="select">
                           <option value="">Select Package</option>
                           <?php 
                           foreach ($all_active_package as $package) 
                           {
                           ?>
                           <option value="<?php echo $package->id."_".$package->amount ?>"><?php echo $package->title."(". $package->amount. currency().")";?></option>
                           <?php 
                           }
                           ?>
                        </select>
                        <span style="color:red;display:none;font-weight:bold" id="valid_pkg_id_1">Please select package!</span>
                     </div>
                     <div class="form-group has-feedback">
                        <input id="epin_amount_1" name="epin_amount[]" type="hidden">
                        <input id="pin_amount_1" disabled type="text" class="form-control pin_amount" placeholder="Pin Amount">
                     </div>
                     <div class="form-group has-feedback">
                        <input id="no_of_epin_1" min='1' onClick="getPinAmountOnQtyChange(this.value,1)" onChange="getPinAmountOnQtyChange(this.value,1)" onKeyUp="getPinAmountOnQtyChange(this.value,1)" value="1" name="no_of_epin[]" type="number" class="form-control" placeholder="No of Pins">
                     </div>
                     <div id='more_epin'>
                     </div><!--end more epin div here-->   
                     <div class="form-group has-feedback">
                        <a href="#" id="add_more_epin">Add More Epin</a>
                     </div>
                     <div class="form-group">
                        <select id="select_payment_method" name="select_payment_method" data-placeholder="Select Payment Method" class="select">
                           <option value="">-Select Payment Method-</option>
                           <option value="ewallet">Ewallet Method</option>
                           <option value="bank_wire">Bank Wire Method</option>
                        </select>
                        <span style="color:red;display:none;font-weight:bold" id="valid_select_payment_method">Please select payment method!</span>
                     </div>
                     <div id="payment_method">
                     </div><!--end payment method div here-->
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
                           <button type="submit" name='btn' id="btn" value='submit' class="btn btn-info">Purchase Pin</button>
                        </div>
                     </div>
                  </form>
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
         $("#select_payment_method").change(function(){
           var transaction_password_field ='<div class="form-group has-feedback">';
               transaction_password_field +='<input name="transaction_password" id="transaction_password" type="password" class="form-control" placeholder="Transaction Password">';
               transaction_password_field +='<span style="color:red;display:none;font-weight:bold" id="valid_transaction_password">Please enter transaction password!</span>';
               transaction_password_field +='</div>';
           var bank_wire_proof_field  ='<div class="panel panel-flat">';
                bank_wire_proof_field +='<div class="panel-heading">';
                bank_wire_proof_field +='<h6 class="panel-title">Upload image</h6>';
                bank_wire_proof_field +='</div>';
                bank_wire_proof_field +='<div class="panel-body">';
                bank_wire_proof_field +='<input type="file" class="file-styled" name="bank_wire_proof_image" id="bank_wire_proof_image">';
                bank_wire_proof_field +='<span style="color:red;display:none;font-weight:bold" id="valid_bank_wire_proof_image">Please select bank wire proof image!</span>';
                bank_wire_proof_field +='<span class="help-block no-margin-bottom">Accepted formats: gif, png, jpg</span>';
                bank_wire_proof_field +='</div>';
                bank_wire_proof_field +='</div>';   
           var method_name=$(this).val();    
                if(method_name=='ewallet')
                {
                  $("#payment_method").children().remove();
                  if($("#payment_method").append(transaction_password_field))
                  {
                     $("#transaction_password").keyup(function(){
                          if($(this).val().length>0)
                          {
                            $("#valid_transaction_password").css('display','none');
                          }
                        });                    
                  }
                } 
                else if(method_name=='bank_wire')
                {
                  $("#payment_method").children().remove();
                  if($("#payment_method").append(bank_wire_proof_field))
                  {
                     $("#bank_wire_proof_image").change(function(){
                          if($(this).val().length>0)
                          {
                            $("#valid_bank_wire_proof_image").css('display','none');
                          }
                        });                    
                   }
                }
         });//end change function here!
      var epin_no=1;
      $("#add_more_epin").click(function(){
         epin_no++;
         var more_epin ='<div id="epin_group_'+epin_no+'">';
             more_epin +='<div class="form-group">';
             more_epin +='<select id="pkg_id_'+epin_no+'" onchange="getPinAmount(this,'+epin_no+')" name="pkg_id[]" data-placeholder="Select Package" class="select selected_pkg">';
             more_epin +='<option value="">-Select Package-</option>';
             <?php 
             foreach ($all_active_package as $package) 
             {
             ?>
             more_epin +='<option value="<?php echo $package->id."_".$package->amount ?>"><?php echo $package->title."(". $package->amount. currency().")";?></option>';
             <?php 
             }
             ?>
             more_epin +='</select><br><span style="color:red;font-weight:bold;" class="pkg_id_'+epin_no+'"></span>';
             more_epin +='</div>';
             more_epin +='<div class="form-group has-feedback">';
             more_epin +='<input id="epin_amount_'+epin_no+'" name="epin_amount[]" type="hidden">';
             more_epin +='<input id="pin_amount_'+epin_no+'" disabled type="text" class="form-control pin_amount" placeholder="Pin Amount">';
             more_epin +='</div>';
             more_epin +='<div class="form-group has-feedback">';
             more_epin +='<input id="no_of_epin_'+epin_no+'" value="1" min="1" name="no_of_epin[]" onClick="getPinAmountOnQtyChange(this.value,'+epin_no+')" onChange="getPinAmountOnQtyChange(this.value,'+epin_no+')" onKeyUp="getPinAmountOnQtyChange(this.value,'+epin_no+')" type="number" class="form-control" placeholder="No of Pins">';
             more_epin +='<span>';
             more_epin +='<a href="#" onclick="return removeEpin('+epin_no+')">Remove Epin</a>';
             more_epin +='</span>';
             more_epin +='</div>';
             more_epin +='</div>';
             $("#more_epin").append(more_epin);
         return false;
      }) 
   })//end ready function!
function removeEpin(no)
{
   $("#epin_group_"+no).remove();
   return false;
}
function getPinAmount(th,no)
{
    var arr=th.value.split('_');
    var pkg_amount=arr[1];
    var no_of_epin=parseInt($("#no_of_epin_"+no).val());
    var total_amount=pkg_amount*no_of_epin;
    if(!isNaN(total_amount))
    {
      $("#epin_amount_"+no).val(total_amount);
      $("#pin_amount_"+no).val(total_amount);
    }
}
function getPinAmountOnQtyChange(pin_qty,no)
{
  if(pin_qty=='' || pin_qty==null)
  {
    pin_qty=1;
    $("#no_of_epin_"+no).val(1);
  }
  var arr=$("#pkg_id_"+no).val().split('_');
  var pkg_amount=parseInt(arr[1]);
  var total_amount=pkg_amount*parseInt(pin_qty);
  if(!isNaN(total_amount))
  {
    $("#epin_amount_"+no).val(total_amount);
    $("#pin_amount_"+no).val(total_amount);
  }
}
////////Validation on btn click start from here//////////
//form validation script
function isPkgSelected()
{
    var flag=true;
    $(".selected_pkg").each(function(){
          if($(this).val()=='')
          {
            var id=$(this).attr('id');
            $("."+id).text("Please select anyone package");
            flag=false;
             return 1;
          }
    });//end each
    if(!flag)
    {
      return false;
    }
}
///
$(document).ready(function(){
    $("#btn").click(function(){
      var total_epin_amount=0;
      var current_wallet_balance=<?php echo $ewallet_balance;?>;
      $(".pin_amount").each(function(){
        total_epin_amount=total_epin_amount+parseInt($(this).val());
      });
      var select_payment_method=$("#select_payment_method").val();
      if($("#pkg_id_1").val()=='')
      {
        $("#valid_pkg_id_1").css('display','');
        return false;
      }
      var selected=isPkgSelected();
      if(!selected && typeof selected!='undefined')
      {
        return false;
      }
      if(select_payment_method=='')
      {
        $("#valid_select_payment_method").text('Please select payment method!').css('display','');
        return false;
      }
      if(select_payment_method=='ewallet')
      {
        if($("#transaction_password").val()=='')
        {
         $("#valid_transaction_password").text('Please enter transaction password!')
         $("#valid_transaction_password").css('display','');
          return false;
        }
        if($("#transaction_password").val()!=<?php echo $tran_code;?>) 
        {
         $("#valid_transaction_password").text('Please enter valid transaction password!').css('display','');
          return false;
        } 
        if(total_epin_amount>current_wallet_balance)
        {
            $("#valid_select_payment_method").text('Sorry your wallet balance is '+current_wallet_balance+' which is less than to total epin amount '+total_epin_amount).css('display','');
            return false;
        }
      }
      if(select_payment_method=='bank_wire')
      {
        if($("#bank_wire_proof_image").val()=='')
        {
         $("#valid_bank_wire_proof_image").css('display','');
          return false;
        }
      }

    });//end submit btn click here!
    //////////managing validation messsage
    $("#pkg_id_1").change(function(){
      if($(this).val()!='')
      {
       $("#valid_pkg_id_1").css('display','none');
      }
    });//end change

    $("#select_payment_method").change(function(){
      if($(this).val()!='')
      {
        $("#valid_select_payment_method").css('display','none');
      }
    });//end change
   $("body").on("change",".selected_pkg",function(){
      var id=$(this).attr('id');
      $("."+id).text('');
   });

});//end ready!
////////Validation on btn click end over here//////////
</script>