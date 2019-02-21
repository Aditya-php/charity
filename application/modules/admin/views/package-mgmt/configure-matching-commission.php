<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - Matching Commission Management</h4>
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
            <li class="">Matching Commission Management</li>
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
                  <h5 class="panel-title">Add Matching Commission for <?php echo $package_title;?> package </h5>
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
                  //pr($matching_commission);
                  echo form_open(site_url()."admin/package/saveMatchingCommission",array('method'=>'post','class'=>'form-horizontal'));
                  //pr($rank);
                  ?>
               <!--<form method="post" class="form-horizontal">-->                        
               <input type="hidden" name="pkg_id" id="pkg_id" value="<?php echo $package_id;?>">
               <div class="panel-body">
                  
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Commision Type:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input class="commission_type" type="radio" value="1" name="commission_type" <?php if(!empty($matching_commission->commission_type) && $matching_commission->commission_type=='1')echo "checked";?>></span></div>
                           Percent
                        </label>
                        <label class="radio-inline">
                           <div><span
                              ><input class="commission_type" type="radio" value="2" name="commission_type" <?php if(!empty($matching_commission->commission_type) && $matching_commission->commission_type=='2')echo "checked";?>></span></div>
                           Flat
                        </label>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Level Type:</label>
                     <div class="col-lg-9">
                        <label class="radio-inline">
                           <div><span><input class="level_type" type="radio" value="1" name="level_type" <?php if(!empty($matching_commission->level_type) && $matching_commission->level_type=='1')echo "checked";?>></span></div>
                           Limited
                        </label>
                        <label class="radio-inline">
                           <div><span
                              ><input class="level_type" type="radio" value="0" name="level_type" <?php if(empty($matching_commission->level_type))echo "checked";?>></span></div>
                           Unlimited
                        </label>
                     </div>
                  </div>
                  <div id="unlimited_level_div">
                     <?php 
                        if(empty($matching_commission->level_type))
                        {
                        ?>
                     <div class="form-group">
                        <label class="col-lg-3 control-label">Commission:</label>
                        <div class="col-lg-9">
                           <input type="number" min="0" name="commission" value="<?php if(!empty($matching_commission->commission)) echo $matching_commission->commission;?>" id="commission" class="form-control" placeholder="Commission">
                        </div>
                     </div>
                     <?php   
                        }
                        ?>
                  </div>
                  <div id="limited_level_div">
                     <?php 
                        if(!empty($matching_commission->level_type) && $matching_commission->level_type=='1')
                        {
                          $level=0;
                          //pr($matching_commission_meta);
                          foreach ($matching_commission_meta as $level_commission_info) 
                          {
                            $level++;
                            if($level==1)
                            {
                        ?>
                     <div class="form-group" id="level_<?php echo $level;?>">
                        <label class="col-lg-3 control-label">Level <?php echo $level;?>:</label>
                        <div class="col-lg-9">
                           <input type="number" min="0" name="level_commission[]" value="<?php if(!empty($level_commission_info->level_commission))echo $level_commission_info->level_commission;?>" class="form-control" placeholder="Level <?php echo $level;?> Commission">
                        </div>
                     </div>
                     <?php       
                        }
                        else 
                        {
                        ?>
                     <div class="form-group" id="level_<?php echo $level;?>">
                        <label class="col-lg-3 control-label level_label">Level <?php echo $level;?>:</label>
                        <div class="col-lg-9">
                           <input type="number" min="0" name="level_commission[]" value="<?php if(!empty($level_commission_info->level_commission))echo $level_commission_info->level_commission;?>" class="form-control" placeholder="Level <?php echo $level;?> Commission">
                           <a href="#" class="remove_level_click" onclick="return remove_level('<?php echo $level;?>')">Remove</a>
                        </div>
                     </div>
                     <?php       
                        }//end level if
                        }//end foreach
                        }//end if
                        ?>
                  </div>
                  <!--end of limited level div here-->
                  <div class="form-group" id="add_more_group" <?php if(!empty($matching_commission->level_type) && $matching_commission->level_type=='1');else echo "style=display:none;"?>>
                     <label class="col-lg-3 control-label"></label>
                     <div class="col-lg-9"><a href="#" id="add_more_level">Add More Level Commission</a></div>
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
   <?php 
      if(!empty($matching_commission_meta) && count($matching_commission_meta)>0)
      {
      ?>
   var level=<?php echo count($matching_commission_meta);?>;
   
   <?php
      }
      else 
      {
      ?>
   var level=1;
   <?php   
      }
      ?>
   
   
   function remove_level(levels)
   {
     $("#level_"+levels).remove();
     /////////////////
     level=1; 
     $('.level_label').each(function(){
       level++;
       $(this).html("level"+level+":");
     });
     ////////////////
     level=1;
     $(".level_group").each(function(){
       level++;
       $(this).attr('id',"level_"+level);
     });
     //////////////////
     level=1;
     $(".level_input").each(function(){
        level++;
        $(this).attr("placeholder","Level "+level+" Commission");
     });
     ////////////////////
     level=1;
     $(".remove_level_click").each(function(){
      level++;
      $(this).attr('onclick',"return remove_level("+level+")");
     });
     return false;
   }
   $(document).ready(function(){
      /////////Level type code start from here/////////////////////
      $("input[class=level_type]").click(function(){
         var level_type=$(this).val();
         //level_type==0=>unlimited, level_type==1=>limited 
         if(level_type==0)
         {
            var unlimited_level_div='<div class="form-group">';
            unlimited_level_div +='<label class="col-lg-3 control-label">Commission:</label>';
            unlimited_level_div +='<div class="col-lg-9">';
            unlimited_level_div +='<input type="number" min="0" name="commission" id="commission" class="form-control" placeholder="Commission">';
            unlimited_level_div +='</div>';
            unlimited_level_div +='</div>';
            $("#unlimited_level_div").html(unlimited_level_div);
            $("#add_more_group").css('display','none');
            $("#limited_level_div").children().remove();
            level=1;
         }
         else 
         {
            var limited_level_div='<div class="form-group">';
            limited_level_div +='<label class="col-lg-3 control-label">Level1:</label>';
            limited_level_div +='<div class="col-lg-9">';
            limited_level_div +='<input type="number" min="0" name="level_commission[]" class="form-control" placeholder="Level 1 Commission">';
            limited_level_div +='</div>';
            limited_level_div +='</div>';
            $("#limited_level_div").html(limited_level_div);
            $("#add_more_group").css('display','');
            $("#unlimited_level_div").children().remove();
         }
      })//end of level type click 
      
      $("#add_more_level").click(function(){
            level++;
            var limited_level_div='<div class="form-group level_group" id="level_'+level+'">';
            limited_level_div +='<label class="col-lg-3 control-label level_label">Level '+level+':</label>';
            limited_level_div +='<div class="col-lg-9">';
            limited_level_div +='<input type="number" min="0" name="level_commission[]" class="form-control level_input" placeholder="Level '+level+' Commission">';
            limited_level_div +='<a href="#" class="remove_level_click" onclick="return remove_level('+level+')">Remove</a></div>';
            limited_level_div +='</div>';
            $("#limited_level_div").append(limited_level_div);
            return false;
      });//end add more level click here
      /////////////////////////////////////////////////////////////
      function formReset()
      {
       
   
      }//end function
      
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