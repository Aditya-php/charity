<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payout Management</span> - <?php echo $title;?></h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>Payout Management</li>
            <li class='active'><?php echo $title;?></li>
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
               <h5 class="panel-title">Used Pin</h5>
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
                     <th>Transaction No</th>
                     <th>Request Date</th>
                     <th>Amount</th>
                     <th>Status</th>
                     <th>Approval Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_completed_request) && count($all_completed_request)>0)
                  {
                     $sno=0;
                     foreach ($all_completed_request as $request) 
                     {
                        $sno++;   
                  ?>
                        <tr>
                           <td><?php echo $sno;?></td>
                           <td><?php echo $request->request_id;?></td>
                           <td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
                           <td><?php echo $request->amount;?></td>
                           <td>Credit</td>
                           <td><?php echo date(date_formats(),strtotime($request->response_date));?></td>
                        </tr>
                     <?php
                     }
                  }
                  ?>
               </tbody>
            </table>
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