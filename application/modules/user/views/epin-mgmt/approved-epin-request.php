<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-pin Management</span> - <?php echo $title;?></h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>user/epin/purchasePin" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add New Purchase Pin Request</a>
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">E-pin Management</a></li>
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
               <h5 class="panel-title">Approved E-pin request</h5>
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
                     <th>Request Id</th>
                     <th>Package Title</th>
                     <th>Package Amount</th>
                     <th>Number of E-pin</th>
                     <th>Epin Amount</th>
                     <th>Payment Method</th>
                     <th>View Proof</th>
                     <th>Request Date</th>
                     <th>Reponse Date</th>
                  </tr>
               </thead>
               <tbody>
                     <?php 
                     if(!empty($all_approved_request) && count($all_approved_request)>0)
                     {
                        $sno=0;
                        $payment_method=array('E-Wallet','Bank Wire');
                        foreach ($all_approved_request as $request) 
                        {
                         $sno++;  
                     ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $request->request_id;?></td>
                        <td><?php echo $request->title;?></td>
                        <td><?php echo $request->pkg_amount;?></td>
                        <td><?php echo $request->no_of_epin;?></td>
                        <td><?php echo $request->epin_amount;?></td>
                        <td><?php echo $payment_method[$request->payment_method];?></td>
                        <td>
                        <?php 
                        if($request->payment_method=='1' && !empty($request->bank_wire_proof_image))
                        {
                        ?>
                        <a href="<?php echo base_url();?>images/<?php echo $request->bank_wire_proof_image;?>" target="_blank">View Proof</a>
                        <?php    
                        }
                        ?>
                        </td>
                        <td><?php echo date(date_formats(),strtotime($request->request_date));?></td>
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
      <div class="row">
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Approved E-pin request</h6>
               </div>
               <div class="panel-body">
                 1
               </div>
            </div>
         </div>
      </div>
      <div class="row">
         <div class="col-md-12">
            <div class="panel panel-flat border-left-xlg border-left-success">
               <div class="panel-heading">
                  <h6 class="panel-title"><span class="text-semibold">Graph of the Level Income Report</span> </h6>
               </div>
               <div class="panel-body">
                  Graph will be displayed here
               </div>
            </div>
         </div>
      </div>
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
