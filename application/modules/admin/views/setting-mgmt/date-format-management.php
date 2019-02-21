<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Date Format </span> -Settings</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Settings</a></li>
            <li class="active">Date Format Settings</li>
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
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php  
         }
         ?>
      <form action="<?php echo site_url();?>admin/setting/dateFormatManagement" method="post">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Date Format Settings</h5>
            </div>
            <div class="panel-body">
               <div class="row">
                  <?php
                     $date=array('d'=>'d','m'=>'m','y'=>'y');
                      ?>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Select Date Format:</label>
                     <div class="col-lg-1">
                        <select name="date_format[]" class="form-control">
                           <?php 
                              foreach ($date as $key => $value) 
                              {
                                 if($value==strtolower($date_format[0]))
                                 {
                              ?>
                           <option selected value='<?php echo $value;?>'><?php echo $key;?></option>
                           <?php    
                              }
                              else 
                              {
                              ?>
                           <option value='<?php echo $key;?>'><?php echo $key;?></option>
                           <?php    
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <div class="col-lg-2">
                        <input value="<?php echo $date_format[1];?>" name="date_format[]" type="text" class="form-control" placeholder="Delimiter">
                     </div>
                     <div class="col-lg-1">
                        <select name="date_format[]" class="form-control">
                           <?php 
                              foreach ($date as $key => $value) 
                              {
                                 if($value==strtolower($date_format[2]))
                                 {
                              ?>
                           <option selected value='<?php echo $value;?>'><?php echo $key;?></option>
                           <?php    
                              }
                              else 
                              {
                              ?>
                           <option value='<?php echo $key;?>'><?php echo $key;?></option>
                           <?php    
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <div class="col-lg-2">
                        <input value="<?php echo $date_format[3];?>" name="date_format[]" type="text" name="currency" class="form-control" placeholder="Delimiter">
                     </div>
                     <div class="col-lg-1">
                        <select name="date_format[]" class="form-control">
                           <?php 
                              foreach ($date as $key => $value) 
                              {
                                 if($value==strtolower($date_format[4]))
                                 {
                              ?>
                           <option selected value='<?php echo $value;?>'><?php echo $key;?></option>
                           <?php    
                              }
                              else 
                              {
                              ?>
                           <option value='<?php echo $key;?>'><?php echo $key;?></option>
                           <?php    
                              }
                              }
                              ?>
                        </select>
                     </div>
                     <div class="col-md-2">
                        <button type="submit" name="btn" value="add" class="btn btn-primary"><i class="icon-cog3 position-left"></i>Add</button>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </form>
   </div>
   <div class="panel panel-flat" style="visibility:hidden;">
      <div class="panel-heading">
         <h5 class="panel-title">Switchery toggles</h5>
         <div class="heading-elements">
            <ul class="icons-list">
               <li><a data-action="collapse"></a></li>
               <li><a data-action="reload"></a></li>
               <li><a data-action="close"></a></li>
            </ul>
         </div>
      </div>
      <div class="panel-body">
         <div class="row">
            <div class="col-md-6">
               <div class="content-group-lg">
                  <h6 class="text-semibold">Switcher colors</h6>
                  <p class="content-group">You can change the default color of the switch to fit your design perfectly. According to the color system, any of its color can be applied to the switchery. Custom colors are also supported.</p>
                  <div class="checkbox checkbox-switchery">
                     <label>
                     <input type="checkbox" class="switchery-primary" checked="checked">
                     Switch in <span class="text-semibold">primary</span> context
                     </label>
                  </div>
                  <div class="checkbox checkbox-switchery">
                     <label>
                     <input type="checkbox" class="switchery-danger" checked="checked">
                     Switch in <span class="text-semibold">danger</span> context
                     </label>
                  </div>
                  <div class="checkbox checkbox-switchery">
                     <label>
                     <input type="checkbox" class="switchery-info" checked="checked">
                     Switch in <span class="text-semibold">info</span> context
                     </label>
                  </div>
                  <div class="checkbox checkbox-switchery">
                     <label>
                     <input type="checkbox" class="switchery-warning" checked="checked">
                     Switch in <span class="text-semibold">warning</span> context
                     </label>
                  </div>
               </div>
            </div>
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