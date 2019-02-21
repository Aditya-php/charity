<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Commission Report</span> - Matrix Stage Commission</h4>
         </div>

      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Commission Report</a></li>
            <li class="active">Matrix Stage Commission</li>
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
      
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Matrix Stage Commission</h5>
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
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php    
                  }
            ?>
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>User Id</th>
                     <th>User Name</th>
                     <th>Sender Username</th>
                     <th>Amount</th>
                     <th>Stage</th>
                     <th>Transaction Type</th>
                     <th>Remark</th>
                     <th>Date</th>
                     <!--<th>Status</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($matrix_stage_level_commission) && count($matrix_stage_level_commission)>0)
                  {
                    
                    
                     $sno=0;
                     foreach ($matrix_stage_level_commission as $commission) 
                     {
                        $sno++;
						
						 if($commission->unique_identity=='feeder_stage')
                      {
                          $stage="BEGINNER STAGE";
                      }
                      else if($commission->unique_identity=='stage_1')
                      {
                          $stage="SUPERVISOR STAGE";
                      }
                      else if($commission->unique_identity=='stage_2')
                      {
                          $stage="ADMINISTRATOR STAGE";
                      }
                      else if($commission->unique_identity=='stage_3')
                      {
                          $stage="MANAGER STAGE";
                      }
                      else if($commission->unique_identity=='stage_4')
                      {
                          $stage="SENIOR MANAGER STAGE";
                      }
                      else if($commission->unique_identity=='stage_5')
                      {
                          $stage="DIRECTOR STAGE";
                      }
                      else if($commission->unique_identity=='stage_6')
                      {
                          $stage="TITANIUM STAGE";
                      }
						
                        $total_direct_commission=$total_direct_commission+$commission->credit_amt;
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $commission->user_id;?></td>
                     <td><?php echo $commission->username;?></td>
                     <td><?php echo $commission->sender_username;?></td>
                     <td><?php echo currency()." ".$commission->credit_amt;?></td>
                     <td><?php echo $stage;?></td>
                     <td>Credit</td>
                     <td><?php echo $commission->Remark; ?></td>
                     <td><?php echo date(date_formats(),strtotime($commission->create_date));?></td>
                     
                  </tr>
                  <?php       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
     
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->