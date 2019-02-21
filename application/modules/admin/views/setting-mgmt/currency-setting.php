<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Currency</span> - Settings</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Setings</a></li>
            <li class="active">Currency Settings</li>
         </ul>
        
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <form action="<?php echo site_url();?>admin/setting/addNewCurrency" method="post">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <?php 
                  if(!empty($currency))
                  {
                  ?>
               <h5 class="panel-title">Edit Currency</h5>
               <?php   
                  }
                  else 
                  {
                  ?>
               <h5 class="panel-title">Add New Currency</h5>
               <?php   
                  }
                  ?>
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
            <?php 
               if(!empty($currency))
               {
               ?>
            <div class="panel-body">
               <div class="row">
                  <div class="col-lg-10">
                     <input type="text" name="currency" value="<?php echo $currency->currency;?>" required="true" class="form-control" placeholder="Put Currency Symbol Here">
                     <input type="hidden" name="id" value="<?php echo $currency->id;?>">
                  </div>
                  <div class="col-md-2">
                     <button type="submit" name="btn" value="add" class="btn btn-primary"><i class="icon-cog3 position-left"></i>Edit Currency</button>
                  </div>
               </div>
            </div>
            <?php    
               }
               else 
               {
               ?>
            <div class="panel-body">
               <div class="row">
                  <div class="col-lg-10">
                     <input type="text" name="currency" required="true" class="form-control" placeholder="Put Currency Symbol Here">
                  </div>
                  <div class="col-md-2">
                     <button type="submit" name="btn" value="add" class="btn btn-primary"><i class="icon-cog3 position-left"></i> Add Currency</button>
                  </div>
               </div>
            </div>
            <?php    
               }
               ?>
         </div>
      </form>
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Currency Setting</h5>
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
                  <th>Currency Name</th>
                  <th>Status</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
                  if(!empty($all_currency) && count($all_currency)>0)
                  {
                     $sno=0;
                     foreach ($all_currency as $currency) 
                     {
                     $sno++;
                     $status_label=($currency->active_status=='1')?'label-success':'label-danger';
                     $status=($currency->active_status=='1')?'Active':'Inactive';
                  
                  ?>
               <tr>
                  <td><?php echo $sno; ?></td>
                  <td><?php echo $currency->currency;?></td>
                  <td><span class="label <?php echo $status_label;?>"><?php echo $status;?></span></td>
                  <td>
                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <li><a  href="<?php echo site_url();?>admin/setting/currencySetting/<?php echo ID_encode($currency->id);?>"><i class="icon-file-pdf"></i> Edit Currency</a></li>
                              <li><a onclick="return confirmDelete();" href="<?php echo site_url();?>admin/setting/deleteCurrency/<?php echo ID_encode($currency->id);?>"><i class="icon-file-excel"></i> Delete Currency</a></li>
                              <li><a onclick="return confirmChangeStatus();" href="<?php echo  site_url();?>admin/setting/changeCurrencyStatus/<?php echo ID_encode($currency->id);?>"><i class="icon-file-word"></i> Activate/Deactivate</a></li>
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
   
      if(window.confirm('Are you sure, you want to delete the currency!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
</script>