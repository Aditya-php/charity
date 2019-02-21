<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - Binary Commission Management</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>admin/package/manageCommission/<?php echo ID_encode($package_id); ?>" class="btn btn-success"><i class="icon-arrow-left52 position-left"></i> Back</a>
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="<?php echo site_url();?>admin/package/allPackages">All Packages</a></li>
            <li class="active"><a href="#">Commission Management(<?php echo $package_title;?>)</a></li>
            <li class="">Binary Commission Management</li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <?php echo $this->session->flashdata('flash_msg');?>
      <!-- Horizontal form options -->
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="panel panel-flat">
               <div class="panel-heading">
                  <h5 class="panel-title">Add Binary Commission for <?php echo $package_title;?> package </h5>
                  <div class="heading-elements">
                     <ul class="icons-list">
                        <li><a data-action="collapse"></a></li>
                        <li><a data-action="reload"></a></li>
                        <li><a data-action="close"></a></li>
                     </ul>
                  </div>
                  <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
               </div>
               <?php 
                  echo form_open(site_url()."admin/package/saveBinaryCommission",array('method'=>'post','class'=>'form-horizontal'));
                  //pr($rank);
                  ?>
               <!--<form method="post" class="form-horizontal">-->                        
               <input type="hidden" name="pkg_id" id="pkg_id" value="<?php echo $package_id;?>">
               <div class="panel-body">
                  <!--<div class="form-group">
                     <label class="col-lg-3 control-label">Commision Type:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input type="radio" id="type1" value="1" name="type" checked="checked"></span></div>
                           Percent
                        </label>
                        <label class="radio-inline">
                           <div><span
                           ><input type="radio" id="type2" value="2" name="type"></span></div>
                           Flat
                        </label>
                     </div>
                     </div>
                     -->
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Commision(%):</label>
                     <div class="col-lg-9">
                        <input type="number" min="0" value="<?php if(!empty($binary_commission->commission))echo $binary_commission->commission;?>" name="commission" id="commission" class="form-control" placeholder="Commission Amount">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Commision Level:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input class="level_type" type="radio" value="0" name="level_type" <?php if(empty($binary_commission->level_type))echo 'checked';?>></span></div>
                           Unlimited
                        </label>
                        <label class="radio-inline">
                           <div><span
                              ><input class="level_type" type="radio" value="1" name="level_type" <?php if(!empty($binary_commission->level_type) && $binary_commission->level_type=='1')echo 'checked';?>></span></div>
                           Limited
                        </label>
                     </div>
                  </div>
                  <div id="max_level_div">
                     <?php 
                        if(!empty($binary_commission->level_type) && $binary_commission->level_type=='1')
                        {
                        ?>
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Enter Max level</label>
                        <div class="col-lg-9">
                           <input type="number" min="0" name="max_level" value="<?php if(!empty($binary_commission->max_level))echo $binary_commission->max_level;?>" id="max_level" class="form-control" placeholder="Enter Max level">
                        </div>
                     </div>
                     <?php   
                        }
                        ?>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Capping:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input class="enabled_capping" type="radio" value="1" name="enabled_capping" <?php if(!empty($binary_commission->enabled_capping) && $binary_commission->enabled_capping=='1') echo 'checked';?>></span></div>
                           Enabled  
                        </label>
                        <label class="radio-inline">
                           <div><span
                              ><input class="enabled_capping" type="radio" value="0" name="enabled_capping" <?php if(empty($binary_commission->enabled_capping)) echo 'checked';?>></span></div>
                           Disabled
                        </label>
                     </div>
                  </div>
                  <div id="capping_amount_div">
                     <?php 
                        if(!empty($binary_commission->enabled_capping) && $binary_commission->enabled_capping=='1')
                        {
                        ?>
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Enter Capping Amount</label>
                        <div class="col-lg-9">
                           <input type="number" min="0" name="capping_amount" value="<?php if(!empty($binary_commission->capping_amount))echo $binary_commission->capping_amount;?>" id="capping_amount" class="form-control" placeholder="Enter Capping Amount">
                        </div>
                     </div>
                     <?php   
                        }
                        ?>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Carry Forward:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input class="enabled_carry_forward" type="radio" value="1" name="enabled_carry_forward" <?php if(!empty($binary_commission->enabled_carry_forward) && $binary_commission->enabled_carry_forward=='1') echo 'checked';?>></span></div>
                           Enabled  
                        </label>
                        <label class="radio-inline">
                           <div><span
                              ><input class="enabled_carry_forward" type="radio" value="0" name="enabled_carry_forward" <?php if(empty($binary_commission->enabled_carry_forward)) echo 'checked';?>></span></div>
                           Disabled
                        </label>
                     </div>
                  </div>
                  <div id="enabled_carry_forward_div">
                     <?php 
                        if(!empty($binary_commission->enabled_capping) && $binary_commission->enabled_capping=='1' && !empty($binary_commission->enabled_carry_forward) && $binary_commission->enabled_carry_forward=='1')
                        {
                        ?>
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Carry forward should be less than capping amount:</label>
                        <div class="col-lg-9">
                           <label class="radio-inline">
                              <div><span><input class="carry_forward_less_capping" type="radio" value="1" name="carry_forward_less_capping" <?php if(!empty($binary_commission->carry_forward_less_capping) && $binary_commission->carry_forward_less_capping=='1') echo 'checked';?>></span></div>
                              Yes
                           </label>
                           <label class="radio-inline">
                              <div><span>
                                 <input class="carry_forward_less_capping" type="radio" value="0" name="carry_forward_less_capping" <?php if(empty($binary_commission->carry_forward_less_capping))echo 'checked';?>></span>
                              </div>
                              No
                           </label>
                        </div>
                     </div>
                     <?php   
                        }
                        ?>
                  </div>
                  <div class="text-right">
                     <button type="submit" name="btn" value="addNewUnilevelCommission" class="btn btn-primary">Save<i class="icon-arrow-right14 position-right"></i></button>
                  </div>
               </div>
               <!--</form>-->
               <?php echo form_close();?>
            </div>
            <!-- /basic layout -->
         </div>
      </div>
      <!-- /Horizontal form options -->                 
      <!-- Footer -->
      <?php
         $this->load->view("common/footer-text");
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<script>
   $(document).ready(function(){
   $("input[class=level_type]").click(function(){
     var level_type=$(this).val();
     if(level_type==1)
     {
      var max_level_div='<div class="form-group">';
        max_level_div +='<label class="col-lg-3 control-label">Enter Max level</label>';
        max_level_div +='<div class="col-lg-9">';
        max_level_div +='<input type="number" min="0" name="max_level" id="max_level" class="form-control" placeholder="Enter Max level">';
        max_level_div +='</div>';
        max_level_div +='</div>';
        $("#max_level_div").html(max_level_div);
     }
     else if(level_type==0)
     {
       $("#max_level_div").children().remove();
     }
   });//end click
   /////////////
   $("input[class=enabled_capping]").click(function(){
   
     var enabled_carry_forward_select=$("input[class=enabled_carry_forward]");
     var enabled_carry_forward = enabled_carry_forward_select.filter(':checked').val();
     var enabled_capping=$(this).val();
     if(enabled_capping==1)
     {
     var capping_amount_div ='<div class="form-group">';
         capping_amount_div +='<label class="col-lg-3 control-label">Enter Capping Amount</label>'
         capping_amount_div +='<div class="col-lg-9">';
         capping_amount_div +='<input type="number" min="0" name="capping_amount" id="capping_amount" class="form-control" placeholder="Enter Capping Amount">';
         capping_amount_div +='</div>';
         capping_amount_div +='</div>';
         $("#capping_amount_div").html(capping_amount_div);
     }
     else if(enabled_capping==0)
     {
       $("#capping_amount_div").children().remove();
        $("#enabled_carry_forward_div").children().remove();
     }
     if(enabled_carry_forward==1 && enabled_capping==1)
     {
     //code for enabled
      var enabled_carry_forward_div='<div class="form-group">';
         enabled_carry_forward_div +='<label class="col-lg-3 control-label">Carry forward should be less than capping amount:</label>';
         enabled_carry_forward_div +='<div class="col-lg-9">';
         enabled_carry_forward_div +='<label class="radio-inline">';
         enabled_carry_forward_div +='<div><span><input class="carry_forward_less_capping" type="radio" value="1" name="carry_forward_less_capping" checked="checked"></span></div>';
         enabled_carry_forward_div +='Yes'
         enabled_carry_forward_div +='</label>'
         enabled_carry_forward_div +='<label class="radio-inline">';
         enabled_carry_forward_div +='<div><span>';
         enabled_carry_forward_div +='<input class="carry_forward_less_capping" type="radio" value="0" name="carry_forward_less_capping" ></span></div>';
         enabled_carry_forward_div +='No';
         enabled_carry_forward_div +='</label>';
         enabled_carry_forward_div +='</div>'
         enabled_carry_forward_div +='</div>';
         $("#enabled_carry_forward_div").html(enabled_carry_forward_div);
     }
   });//end click
   /////////////////
   $("input[class=enabled_carry_forward]").click(function(){
     
     var enabled_capping_select=$("input[class=enabled_capping]");
     var enabled_capping = enabled_capping_select.filter(':checked').val();
     var enabled_carry_forward=$(this).val();
     if(enabled_carry_forward==1 && enabled_capping==1)
     {
      //code for enabled
     var enabled_carry_forward_div='<div class="form-group">';
         enabled_carry_forward_div +='<label class="col-lg-3 control-label">Carry forward should be less than capping amount:</label>';
         enabled_carry_forward_div +='<div class="col-lg-9">';
         enabled_carry_forward_div +='<label class="radio-inline">';
         enabled_carry_forward_div +='<div><span><input class="carry_forward_less_capping" type="radio" value="1" name="carry_forward_less_capping" checked="checked"></span></div>';
         enabled_carry_forward_div +='Yes'
         enabled_carry_forward_div +='</label>'
         enabled_carry_forward_div +='<label class="radio-inline">';
         enabled_carry_forward_div +='<div><span>';
         enabled_carry_forward_div +='<input class="carry_forward_less_capping" type="radio" value="0" name="carry_forward_less_capping" ></span></div>';
         enabled_carry_forward_div +='No';
         enabled_carry_forward_div +='</label>';
         enabled_carry_forward_div +='</div>'
         enabled_carry_forward_div +='</div>';
         $("#enabled_carry_forward_div").html(enabled_carry_forward_div);
     }
     else if(enabled_carry_forward==0)
     {
      //code for disabled
      $("#enabled_carry_forward_div").children().remove();
     }
   })//end click
   //////////////////////////////////////
      
   /////////////////////////////////////////
   });//end ready
</script>   
<style>
   input[type="radio"]{
   border: 5px solid;
   border-color: grey;
   width: 20px;
   height: 20px;
   border-radius: 100%;
   }
</style>