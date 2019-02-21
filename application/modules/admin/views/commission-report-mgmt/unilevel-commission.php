<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Commission Report</span> - Unilevel Commission</h4>
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
            <li><a href="#">Commission Report</a></li>
            <li class="active">Unilevel Commission</li>
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
      <!-- Daterange picker -->
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Unilevel Commission</h5>
         </div>
         
      </div>
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Unilevel Commission</h5>
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
                     <th>User Id</th>
                     <th>User Name</th>
                     <th>Member Name</th>
                     <th>Amount</th>
                     <th>Transaction Type</th>
                     <th>Remark</th>
                     <th>Date</th>
                     <!--<th>Status</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($unilevel_commission) && count($unilevel_commission)>0)
                  {
                     $total_no_of_unilevel_commission=count($unilevel_commission);
                     $total_unilevel_commission=0;
                     $sno=0;
                     foreach ($unilevel_commission as $commission) 
                     {
                        $sno++;
                        $total_unilevel_commission=$total_unilevel_commission+$commission->amount;
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $commission->user_id;?></td>
                     <td><?php echo $commission->username;?></td>
                     <td><?php echo get_user_name($commission->receiver_id);?></td>
                     <td><?php echo currency()." ".$commission->amount;?></td>
                     <td>Credit</td>
                     <td>Unilevel Commission</td>
                     <td><?php echo date(date_formats(),strtotime($commission->create_date));?></td>
                     <!--<td>Paid</td>-->
                  </tr>
                  <?php       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
      <div class="row">
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Unilevel commission</h6>
               </div>
               <div class="panel-body">
                  <?php 
                  echo currency()." ";
                  echo (!empty($total_unilevel_commission))?$total_unilevel_commission:0;
                  ?>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Unilevel commission transaction</h6>
               </div>
               <div class="panel-body">
                  <?php 
                  echo (!empty($total_no_of_unilevel_commission))?$total_no_of_unilevel_commission:0;
                  ?>
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-flat border-left-xlg border-left-success">
               <div class="panel-heading">
                  <h6 class="panel-title"><span class="text-semibold">Graph of the Direct Referral Commission</span> </h6>
               </div>
               <div class="panel-body">
                  Graph will be displayed here
               </div>
            </div>
         </div>
      </div>
      <!-- Pickadate picker -->
      <!-- /pickadate picker -->
      <!-- Pickatime picker -->
      <!-- /pickadate picker -->
      <!-- Anytime picker -->
      <!-- /anytime picker -->
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->