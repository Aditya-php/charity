<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Shop</span> - View All/Edit Products</h4>
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
            <li class="active">View All/Edit Products</li>
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
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">View All/Edit Products</h5>
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
                     <th>Product Id</th>
                     <th>Product Name</th>
                     <th>Category Breadcrumb</th>
                     <th>Product Price</th>
                     <th>Discount</th>
                     <th>Stock Detail</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>Sr.No</td>
                     <td>P1454</td>
                     <td>Product Name</td>
                     <td>Category Breadcrumb</td>
                     <td>Product Price</td>
                     <td>Discount</td>
                     <td>Stock Detail</td>
                     <td><span class="label label-success">Active</span></td>
                     <td>
                        <ul class="icons-list">
                           <li>
                              <a href="#" data-popup="tooltip" title="" data-original-title="View Product"><i class="icon-eye"></i></a>
                           </li>
                           <li>
                              <a href="#" data-popup="tooltip" title="" data-original-title="Edit Product"><i class="icon-pencil7"></i></a>
                           </li>
                           <li>
                              <a onclick="return deleteConfirm();" href="#" data-popup="tooltip" title="" data-original-title="Delete Product"><i class="icon-trash"></i></a>
                           </li>
                        </ul>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->