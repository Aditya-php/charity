<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Privacy Policy Section</span> - <?php echo $title;?></h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>Privacy Policy Section</li>
            <li class='active'><?php echo $title;?></li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title"><?php echo $title;?></h5>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
            <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
         </div>
         <div class="panel-body">
            <!---->
            <?php 
            if(!empty($terms_and_condition))
               echo $terms_and_condition;
            ?>
            <!---->
         </div>
      </div>
      <?php 
         $this->load->view('common/footer-text');
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>