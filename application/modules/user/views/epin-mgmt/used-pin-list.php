<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Pin Management</span> - <?php echo $title;?></h4>
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
            <li>E-Pin Management</li>
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
                     <th>Pin Code</th>
                     <th>Pkg Title</th>
                     <th>Pin Amount</th>
                     <th>Register Username</th>
                     <th>Create Date</th>
                     <th>Used Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_used_epin) && count($all_used_epin)>0)
                  {
                     $sno=0;
                     foreach ($all_used_epin as $epin) 
                     {
                     $sno++;   
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $epin->epin_code;?></td>
                     <td><?php echo $epin->title;?></td>
                     <td><?php echo $epin->pkg_amount;?></td>
                     <td><?php echo $epin->register_username;?></td>
                     <td><?php echo date(date_formats(),strtotime($epin->create_date));?></td>
                     <td><?php echo date(date_formats(),strtotime($epin->used_date));?></td>
                  </tr>
                  <?php      
                     }
                  }//end if
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