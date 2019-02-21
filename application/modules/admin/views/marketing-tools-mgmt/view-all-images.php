<!-- Theme JS files -->
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/gallery.js"></script>
<!-- /theme JS files -->
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Marketing Tools</span> - View Image Gallery</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>admin/MarketingTools/addMarketingImage/" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add Marketing Image</a>
            </div>
         </div>          
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Marketing Tools</a></li>
            <li class="active">View Image Gallery</li>
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
      <!-- Image grid -->
      <h6 class="content-group text-semibold">
         View Image Gallery
      </h6>
      <?php 
      if(!empty($all_images) && count($all_images)>0)
      {
         $total_row=ceil(count($all_images)/4);
         $count=0;
         for($row=1;$row<=$total_row;$row++)
         {
      ?>
         <div class="row">
            <?php 
            for($col=1;$col<=4;$col++)
            {
               $count++;
               list($k,$image)=each($all_images);

            ?>
               <div class="col-lg-3 col-sm-6">
                  <div class="thumbnail">
                     <div class="thumb">
                        <img src="<?php echo site_url();?>images/<?php echo $image->image_path;?>" alt="">
                        <div class="caption-overflow">
                           <span>
                           <a href="<?php echo site_url();?>images/<?php echo $image->image_path;?>" data-popup="lightbox" class="btn border-white text-white btn-flat btn-icon btn-rounded"><i class="icon-plus3"></i></a>
                           <a href="#" class="btn border-white text-white btn-flat btn-icon btn-rounded ml-5"><i class="icon-link2"></i></a>
                           </span>
                        </div>
                     </div>
                     <div class="caption">
                        <h6 class="no-margin-top text-semibold"><a href="#" class="text-default"><?php echo (!empty($image->title))?$image->title:''; ?></a> <a href="#" class="text-muted"><i class="icon-download pull-right"></i></a></h6>
                        <?php echo (!empty($image->description))?$image->description:''; ?>
                     </div>
                  </div>
               </div>
            <?php    
             if($count==count($all_images))break;
            }//end inner for loop
            ?>
      </div>
      <?php       
         }//end outer for loop
      }//end empty if
      ?>


      <!-- /image grid -->
      <!-- Footer -->
      <?php $this->load->view("common/footer-text");?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->