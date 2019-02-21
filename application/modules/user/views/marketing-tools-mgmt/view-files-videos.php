<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/uploaders/fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/uploader_bootstrap.js"></script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Marketing Tools</span> - Files and Videos</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Marketing Tools</a></li>
            <li class="active">Files and Videos</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               Settings
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
               </ul>
            </li>
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
         <!--
         <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
         -->
         <?php 
         echo $this->session->flashdata('flash_msg');
         ?>
      </div>
      <?php    
      }
      ?>
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Files and Videos</h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Upload Your Files:</label>
                     <div class="col-lg-9">
                        <input type="file" class="file-styled file-input">
                        <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                     </div>
                  </div>
                  <div class="form-group">
                     <input type="text" class="form-control" placeholder="Enter You Tube Link Here">
                  </div>
                  <div class="form-group">
                     <button type="button" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Upload Files</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-lg-6">
            <div class="panel panel-flat blog-horizontal blog-horizontal-2">
               <div class="panel-body">
                  <div class="thumb">
                     <a href="#course_preview" data-toggle="modal">
                     <img src="http://demo.interface.club/limitless/layout_1/LTR/default/assets/images/demo/flat/1.png" class="img-responsive img-rounded" alt="">
                     <span class="zoom-image"><i class="icon-play3"></i></span>
                     </a>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="modal fade" id="course_preview" tabindex="-1">
         <div class="modal-dialog modal-lg">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h6 class="modal-title">Course preview</h6>
               </div>
               <div class="modal-body">
                  <div class="embed-responsive embed-responsive-16by9">
                     <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/vlDzYIIOYmM" frameborder="0" allowfullscreen></iframe>
                  </div>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary">Take this course</button>
               </div>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->