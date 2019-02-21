<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Report</span> - Top Recruiter Report</h4>
         </div>
         
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Report Manaement</a></li>
            <li class="active">Top Recruiter Report</li>
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
               <h5 class="panel-title">Top Recruiter Report</h5>
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
                     <th>Total Direct Member</th>
                     <th>Team Member</th>
                     <th>Date</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($top_recruiter_report) && count($top_recruiter_report)>0)
                  {
                     $sno=0;
                     foreach ($top_recruiter_report as $report) 
                     {
                     $sno++;
                     $label_class=(!empty($report['active_status']=='1'))?'label-success':'label-danger';
                     $label=(!empty($report['active_status']=='1'))?'Active':'Inactive';
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $report['username'];?></td>
                     <td><?php echo $report['user_id'];?></td>
                     <td><?php echo $report['total_direct_member'];?></td>
                     <td><?php echo $report['total_team_member'];?></td>
                     <td><?php echo $report['create_date'];?></td>
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