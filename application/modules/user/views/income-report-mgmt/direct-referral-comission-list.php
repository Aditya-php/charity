<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Wallet Management</span> - <?php echo $title;?></h4>
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
     
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Direct Income Report</h5>
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
                     <th>Sender User Id</th>
                     <th>Sender User Name</th>
                     <th>Amount</th>
                     <th>Transaction Type</th>
					
                     <th>Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  $total_direct_income=0;
                  if(!empty($direct_referral_income) && count($direct_referral_income)>0)
                  {
                     $sno=1;
                     foreach ($direct_referral_income as $income) 
                     {
                      $total_direct_income=$total_direct_income+$income->credit_amt;  
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
                        <td><?php echo $income->user_id;?></td>
                        <td><?php echo $income->username;?></td>
                        <td><?php echo $income->credit_amt.' '.currency();?></td>
                        <td><?php echo $income->ttype;?></td>
						
                        <td><?php echo date(date_formats(),strtotime($income->create_date));?></td>
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
      <div class="row">
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Direct Referral Income</h6>
               </div>
               <div class="panel-body">
                 <?php echo currency()." ".$total_direct_income;?>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Direct Referral Member</h6>
               </div>
               <div class="panel-body">
                  <?php echo (!empty($total_direct_member))?$total_direct_member:0;?>
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
      <?php 
         $this->load->view('common/footer-text');
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<script>
   function deleteConfirm()
   {
   
   	if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>