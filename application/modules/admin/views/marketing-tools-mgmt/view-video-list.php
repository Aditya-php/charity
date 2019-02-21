<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/media/fancybox.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/gallery_library.js"></script>
<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Marketing Tools</span> - View Video List</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>admin/MarketingTools/addMarketingVideo/" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add Marketing Video</a>
            </div>
         </div>          
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Marketing Tools</a></li>
            <li class="active">View Video List</li>
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
      <!-- Media library -->
      <div class="panel panel-white">
         <div class="panel-heading">
            <h6 class="panel-title text-semibold">View Video List</h6>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
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
         <table class="table table-striped media-library table-lg">
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th class="text-center">Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               if(!empty($all_videos) && count($all_videos)>0)
               {
                  $sno=0;
                  foreach ($all_videos as $video) 
                  {
                    $sno++; 
                    $status_label=($video->status=='0')?'Unpublished':'Published';
                    $status_label_class=($video->status=='0')?'label-danger':'label-success';
               ?>
               <tr>
                  <!--<td><input type="checkbox" class="styled"></td>-->
                  <td><?php echo $sno;?></td>
                  <td><a href="#"><?php echo $video->title;?></a></td>
                  <td><span class="label <?php echo $status_label_class;?>"><?php echo $status_label;?></span></td>
                  <td><?php echo date(date_formats(),strtotime($video->create_date));?></td>
                  <td class="text-center">
                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <!--<li><a href="#"><i class="icon-eye"></i> Publish</a></li>-->
                              <?php 
                              if($video->status=='0')
                              {
                              ?>
                              <li><a title="click to Publish" href="<?php echo site_url();?>admin/MarketingTools/changeVideoStatus/<?php echo ID_encode($video->id);?>/1"><i class="icon-eye"></i> Publish</a></li>
                              <?php    
                              }
                              else 
                              {
                              ?>
                              <li><a title="click to Unpublish" href="<?php echo site_url();?>admin/MarketingTools/changeVideoStatus/<?php echo ID_encode($video->id);?>/0"><i class="icon-eye-blocked"></i> Unpublished</a></li>
                              <?php    
                              }
                              ?>
                              <li><a href="<?php echo site_url();?>admin/MarketingTools/deleteVideo/<?php echo ID_encode($video->id);?>"><i class="icon-bin"></i> Delete</a></li>
                           </ul>
                        </li>
                     </ul>
                  </td>
               </tr>
               <?php       
                  }
               }
               ?>
            </tbody>
         </table>
      </div>
      <!-- /media library -->
      <!-- Footer -->
      <?php $this->load->view("common/footer-text");?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->