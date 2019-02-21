<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - Direct Commission Management</h4>
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
            <li class="">Direct Commission Management</li>
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
                  <h5 class="panel-title">Add Direct Commission for <?php echo $package_title;?> package </h5>
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
                  echo form_open(site_url()."admin/package/saveDirectCommission",array('method'=>'post','class'=>'form-horizontal'));
                  
                  ?>
               <!--<form method="post" class="form-horizontal">-->                        
               <input type="hidden" name="pkg_id" id="pkg_id" value="<?php echo $package_id;?>">
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Commision Type:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input type="radio" id="type1" value="1" name="type" <?php if(!empty($direct_commission->type) && $direct_commission->type=='1') echo 'checked';?>></span></div>
                           Percent
                        </label>
                        <label class="radio-inline">
                           <div><span
                              ><input type="radio" id="type2" value="2" name="type" <?php if(!empty($direct_commission->type) && $direct_commission->type=='2') echo 'checked';?>></span></div>
                           Flat
                        </label>
                     </div>
                     <span id="valid_type" style="color:red;font-weight:bold"></span>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Commision Amount:</label>
                     <div class="col-lg-9">
                        <input type="number" min="0" value="<?php if(!empty($direct_commission->commission)) echo $direct_commission->commission;?>" name="commission" id="commission" class="form-control" placeholder="Commission Amount">
                        <span id="valid_commission" style="color:red;font-weight:bold"></span>
                     </div>
                  </div>
                  <div class="text-right">
                     <button type="submit" name="btn" id="btn" value="addNewDirectCommission" class="btn btn-primary">Save<i class="icon-arrow-right14 position-right"></i></button>
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
  $("#btn").click(function(){
     var checked=false;
     $("input[name=type]").each(function(){
      if($(this).is(":checked"))
      {
         checked=true
      }
     })//end each
     if(!checked)
     {
      $("#valid_type").text("Please select any one commision type");
      return false;
     }
     if($("#commission").val()=="")
     {
      $("#valid_commission").text("Please enter commision amount");
      return false;
     }
     return true;
  });//end btn click

  $("input[name=type]").click(function(){
     $("#valid_type").text("");
  });
  $("#commission").keyup(function(){
   var commission=$(this).val();
   if(commission.length>0)
   {
      if(commission<0)
      {
         $(this).val(0);
      }
      $("#valid_commission").text("");
   }
  })//end keyup
});//end ready
</script>