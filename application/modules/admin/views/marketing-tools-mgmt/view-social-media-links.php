<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Marketing Tools</span> - Social Media Links</h4>
         </div>
         
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Marketing Tools</a></li>
            <li class="active">Social Media Links</li>
         </ul>
        
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <div class="panel panel-flat border-top-lg border-top-warning">
         <div class="panel-heading">
            <h6 class="panel-title"><span class="text-semibold">Social Media Links</span></h6>
         </div>
         <?php 
         $facebook_link=(!empty($user->facebook_link))?$user->facebook_link:"#";
         $google_plus_link=(!empty($user->google_plus_link))?$user->google_plus_link:"#";
         $linkedin_link=(!empty($user->linkedin_link))?$user->linkedin_link:"#";
         ?>
         <div class="panel-body">
           <a target="_blank" href="<?php echo $facebook_link;?>"><button type="button" class="btn btn-primary btn-xlg"><i class="icon-facebook2"></i> My Facebook Link</button></a>
            <a target="_blank" href="<?php echo $google_plus_link;?>"><button type="button" class="btn btn-primary btn-xlg"><i class="icon-google-plus2"></i> My Google+ Link</button></a>
            <a target="_blank" href="<?php echo $linkedin_link;?>"><button type="button" class="btn btn-primary btn-xlg"><i class="icon-linkedin"></i> My linkedin Link</button></a>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->