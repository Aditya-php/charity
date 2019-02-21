<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payout </span> - Mode Settings</h4>
         </div>
       
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Settings</a></li>
            <li class="active">Payout Mode Settings</li>
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
      <form action="<?php echo site_url();?>admin/setting/payoutSetting" method="post">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Payout Settings</h5>
            </div>
            <div class="panel-body">
               <div class="row">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-md-2">
                           <div class="radio">
                              <label>
                              <input type="radio" name="request_type" value="0" class="control-primary" <?php if($setting->request_type=='0')echo 'checked';?>>
                              On User Request
                              </label>
                           </div>
                        </div>
                        <div class="col-md-2">
                           <div class="radio">
                              <label>
                              <input type="radio" name="request_type" value="1" class="control-danger" <?php if($setting->request_type=='1')echo 'checked';?>>
                              By Admin
                              </label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-2">
                     <button type="submit" name="btn" value="add" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Set Payout</button>
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