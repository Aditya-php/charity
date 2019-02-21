<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Rank</span> - Management</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li class="#">Rank Management</li>
            <li class="active">Add New Rank</li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Horizontal form options -->
      <div class="row">
         <div class="col-md-12">
            <!-- Basic layout-->
            <div class="panel panel-flat">
               <div class="panel-heading">
                  <h5 class="panel-title">Add New Rank</h5>
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
                  echo form_open(site_url()."admin/rank/addNewRank",array('method'=>'post','class'=>'form-horizontal'));
                  ?>
               <!--<form method="post" class="form-horizontal">-->								
               <div class="panel-body">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Rank Name:</label>
                     <div class="col-lg-9">
                        <input type="text" name="rank_name" class="form-control" placeholder="Rank Name">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Direct Member:</label>
                     <div class="col-lg-9">
                        <input type="text" name="direct_member" class="form-control" placeholder="Direct Member">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Team Member:</label>
                     <div class="col-lg-9">
                        <input type="text" name="team_member" class="form-control" placeholder="Team Member">
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Rank Achiver Bonus (<?php echo currency();?>):</label>
                     <div class="col-lg-9">
                        <input type="text" name="bonus_amount" class="form-control" placeholder="Rank Achiver Bonus">
                     </div>
                  </div>
                  <div class="text-right">
                     <button type="submit" name="btn" value="addNewRank" class="btn btn-primary">Add <i class="icon-arrow-right14 position-right"></i></button>
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