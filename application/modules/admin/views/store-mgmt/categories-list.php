<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Shop</span> - Manage Product Categories</h4>
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
            <li><a href="#">Store Management</a></li>
            <li class="active">Manage Product Categories</li>
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
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Manage Product Categories</h5>
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
            <!--<span class="text-semibold">Well done!</span> Message is sent successfully-->
            <?php echo $this->session->flashdata('flash_msg');?>
         </div>
         <?php    
         }
         ?>
         <table class="table datatable-responsive">
            <thead>
               <tr>
                  <th>Sr.No</th>
                  <th>Categories Name</th>
                  <th>Add Sub Category</th>
                  <th>Parent Breadcrumb</th>
                  <th>Add Product</th>
                  <th>Status</th>
                  <th>Date of Creation</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               if(!empty($all_shop_category) && count($all_shop_category)>0)
               {
                  $sno=0;
                  foreach ($all_shop_category as $category) 
                  {
                     $sno++;
                     $status_label=($category->status=='1')?'Active':'Inactive';
                     $status_label_class=($category->status=='1')?'label-success':'label-danger';
                     $bread_crumb=getParentBreadCrumb($category->id);
                     if(!empty($bread_crumb))
                     {
                        $bread_crumb=$bread_crumb.$category->category_name;
                     }
                     else 
                     {
                        $bread_crumb="---";
                     }
               ?>
               <tr>
                  <td><?php echo $sno;?></td>
                  <td><?php echo $category->category_name;?></td>
                  <td><a title="Add Subcategory" href="<?php echo site_url();?>admin/StoreManagement/addProductCategory/<?php echo ID_encode($category->id);?>">Add Sub Category</a></td>
                  <td><?php echo $bread_crumb;?></td>
                  <td><a title="Add Product" href="<?php echo site_url();?>admin/StoreManagement/addNewProduct/<?php echo ID_encode($category->id);?>">Add Product</a></td>
                  <td><span class="label <?php echo $status_label_class;?>"><?php echo $status_label;?></span></td>
                  <td><?php echo date(date_formats(),strtotime($category->create_date));?></td>
                  <td>
                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              
                              <li><a onclick="return confirmEdit();" href="<?php echo site_url();?>admin/StoreManagement/editProductCategory/<?php echo ID_encode($category->id);?>"><i class="icon-file-pdf"></i> Edit Categories</a></li>
                              
                              <li><a onclick="return confirmDelete();" href="<?php echo site_url();?>admin/StoreManagement/deleteProductCategory/<?php echo ID_encode($category->id);?>"><i class="icon-file-excel"></i> Delete Categories</a></li>
                           </ul>
                        </li>
                     </ul>
                  </td>
               </tr>
               <?php       
                  }//end foreach
               }//end if
               ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
function confirmEdit()
{
   if(window.confirm('Are you sure, you want to edit category'))
      return true;
   else 
      return false;
}
function confirmDelete()
{
   if(window.confirm('Are you sure, you want to delete category'))
      return true;
   else 
      return false;
}
</script>