<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Income Report Management</span> - <?php echo $title;?></h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">Income Report</a></li>
            <li class="active"><?php echo $title; ?></li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!--
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title"><?php //echo $title; ?></h5>
         </div>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-6">
                  <div class="panel-heading">
                     <p>Please Select the Date Range to View Your Commission Report</p>
                  </div>
               </div>
               <div class="col-md-6">
                  <div class="form-group">
                     <label class="display-block">Please Select the Date Rane </label>
                     <button type="button" class="btn btn-success daterange-ranges">
                     <i class="icon-calendar22 position-left"></i> <span></span> <b class="caret"></b>
                     </button>
                  </div>
               </div>
            </div>
         </div>
      </div>
  	  -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Matrix Income Report</h5>
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
                     <th>Sender User ID</th>
                     <th>Sender Username</th>
                     <th>Amount</th>
                     <th>Transaction Type</th>
					 
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_matrix_income=0;
                  if(!empty($matrix_commission) && count($matrix_commission)>0)
                  {
                     $sno=1;
                     foreach ($matrix_commission as $income) 
                     {
                      $total_direct_income=$total_matrix_income+$income->credit_amt; 
                      if($income->unique_identity=='feeder_stage')
                      {
                          $stage="BEGINNER STAGE";
                      }
                      else if($income->unique_identity=='stage_1')
                      {
                          $stage="SUPERVISOR STAGE";
                      }
                      else if($income->unique_identity=='stage_2')
                      {
                          $stage="ADMINISTRATOR STAGE";
                      }
                      else if($income->unique_identity=='stage_3')
                      {
                          $stage="MANAGER STAGE";
                      }
                      else if($income->unique_identity=='stage_4')
                      {
                          $stage="SENIOR MANAGER STAGE";
                      }
                      else if($income->unique_identity=='stage_5')
                      {
                          $stage="DIRECTOR STAGE";
                      }
                      else if($income->unique_identity=='stage_6')
                      {
                          $stage="TITANIUM STAGE";
                      }
                    
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $income->sender_id;?></td>
                        <td><?php echo $income->sender_username;?></td>
                        <td><?php echo $income->credit_amt.' '.currency();?></td>
                        <td><?php echo $income->ttype;?></td>
                      
                        <td><?php echo date(date_formats(),strtotime($income->receive_date));?></td>
                     </tr>
                  <?php
                     $sno++;       
                     }//end foreach
                  }//end if
                  ?>
               </tbody>
            </table>
         </div>
      </div>

      <?php 
         $this->load->view('common/footer-text');
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
