<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/uploader_bootstrap.js"></script>
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">CMS Management</span> - <?php echo $title; ?></h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="#">CMS Management</li>
            <li class="active"> <?php echo $title; ?></li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="panel panel-flat">
               <div class="panel-heading">
                  <h5 class="panel-title"></h5>
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
                  echo form_open(site_url()."admin/cms/editstagetext",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
                  ?>
				  
				  <input type='hidden' name="hidid" value="<?php echo $fetch_data['id']; ?>" />
				  
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Title:</label>
                     <div class="col-lg-9">
                        <input type="text" name="title" required value="<?php echo $fetch_data['title']; ?>" placeholder='Enter Title' class="form-control">
                     </div>
                  </div>
				  
				  <div class="form-group">
                     <label class="col-lg-3 control-label">Bottom Text:</label>
                     <div class="col-lg-9">
                        <input type="text" name="bottom_text" required value="<?php echo $fetch_data['bottom_text']; ?>" placeholder='Enter Text' class="form-control">
                     </div>
                  </div>
                  
                  <div class="text-right">
                     <button type="submit" name="btn" value="update" class="btn btn-primary">Update<i class="icon-arrow-right14 position-right"></i></button>
                  </div>
               </div>
               <!--</form>-->
               <?php echo form_close();?>
            </div>
            <!-- /basic layout -->
         </div>
      </div>
      <!-- /vertical form options -->
      <!-- Footer -->
      <?php
         $this->load->view("common/footer-text");
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>