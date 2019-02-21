<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Package Management</span> - All Packages</h4>
         </div>
         <div class="heading-elements">
                        <div class="heading-btn-group">
                         <a href="<?php echo site_url();?>admin/package/addNewPackage" class="btn btn-success"><i class="icon-comment-discussion position-left"></i> Add New Package</a>
                        </div>
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
            <li><a href="#">Package Management</a></li>
            <li class="active">All Packages</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               All Packages
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All Packages</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">All Packages</h5>
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
            </div>
         </div>
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">All Packages</h5>
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
                              <th>Sr.</th>
                              <th>Title</th>
                              <th>Package Image</th>
                              <th>Amount</th>
                              <th>Status</th>
                              <th>Description</th>
                              <th>Manage Commission</th>
                              <th>Created Date</th>
                              <th>Action</th>
                           </tr>
            </thead>
            <tbody>
               <?php 
                  if(!empty($all_packages) && count($all_packages)>0)
                  {
                     $sno=0;
                     foreach ($all_packages as $rowObj) 
                     {
                     $sno++;
                     $status_label=($rowObj->status=='1')?'label-success':'label-danger';
                     $status=($rowObj->status=='1')?'Active':'Inactive';
                  ?>
               <tr>
                              <td><?php echo $sno;?></td>
                              <td><?php echo $rowObj->title;?></td>
                              <td><img width="50" src="<?php echo base_url()."images/".$rowObj->pkg_image;?>"></td>
                              <td><?php echo $rowObj->amount." ".currency();?></td>
                   <td><span class="label <?php echo $status_label;?>"><?php echo $status;?></span></td>
                     <td><?php echo $rowObj->description;?></td>
                              <td><a href="<?php echo site_url();?>admin/package/manageCommission/<?php echo ID_encode($rowObj->id);?>">Manage Commission</td>
                              <td><?php echo date(date_formats(),strtotime($rowObj->created_date));?></td>

                                       <td>

                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <li><a  href="<?php echo site_url()."admin/package/editPackage"?>/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-pdf"></i>Edit Package</a></li>
                              
                              <li><a onclick="return confirmDelete();" href="<?php echo site_url()."admin/package/deletePackage"?>/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-excel"></i> Delete Package</a></li>
                              
                              <li><a onclick="return confirmChangeStatus();" href="<?php echo site_url();?>admin/package/changePackageStatus/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-word"></i> Activate/Deactivate</a></li>
                           </ul>
                        </li>
                     </ul>
                  </td>
               </tr>
               <?php       
                  }
                  }
                  ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
   function confirmChangeStatus()
   {
   
      if(window.confirm('Are you sure, you want to change the status!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   function confirmDelete()
   {
   
      if(window.confirm('Are you sure, you want to delete the Package!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
</script>