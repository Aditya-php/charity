<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Report</span> - Rank Achiver Report</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Report Manaement</a></li>
            <li class="active">Rank Achiver Report</li>
         </ul>
         
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Rank Achiver Report</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>User Name</th>
                     <th>User Id</th>
                     <th>Rank Name</th>
                     <th>Date of Achivement</th>
                     <th>Rank Amount</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($rank_achiever_report) && count($rank_achiever_report)>0)
                  {
                     $sno=0;
                     foreach($rank_achiever_report as $rank)
                     {
                     $sno++;
                     $label_class=(!empty($rank->active_status=='1'))?'label-success':'label-danger';
                     $label=(!empty($rank->active_status=='1'))?'Active':'Inactive';
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $rank->username;?></td>
                     <td><?php echo $rank->user_id;?></td>
                     <td><?php echo $rank->rank_name;?></td>
                     <td><?php echo $rank->updated_date;?></td>
                     <td><?php echo (!empty($rank->credit_amt))?$rank->credit_amt:'0';?></td>
                     <td><span class="label <?php echo $label_class;?>"><?php echo $label;?></span></td>
                  </tr>
                  <?php      
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->