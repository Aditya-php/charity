<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Order Management</span> - View All Order</h4>
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
            <li><a href="#">Order Management</a></li>
            <li class="active">View All Order</li>
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
               <h5 class="panel-title">View All Order</h5>
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
                     <th>Product Name</th>
                     <th>Product Image</th>
                     <th>User Name</th>
                     <th>User Id</th>
                     <th>Order Id</th>
                     <th>Order Date</th>
                     <th>Order Amount</th>
                     <th>Discount</th>
                     <th>Order Status</th>
                  </tr>
               </thead>
               <tbody>
                  <tr>
                     <td>1</td>
                     <td>P Name</td>
                     <td>Image</td>
                     <td>User Name </td>
                     <td>14565</td>
                     <td>25648</td>
                     <td>23/01/2018</td>
                     <td>$10</td>
                     <td>$2</td>
                     <td><span class="label label-success">Success</span>										</td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Vertical form modal -->
      <div id="modal_form_vertical" class="modal fade">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title">Manage Product Stock</h5>
               </div>
               <form action="#">
                  <div class="modal-body">
                     <p class="modal-title">Product Name : </p>
                     <p class="modal-title">Product Id : </p>
                     <div class="form-group">
                        <div class="row">
                           <input type="text" class="form-control" data-popup="tooltip" data-trigger="focus" title="" placeholder="20" data-original-title="Enter No of Product to Stock">
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Submit Stock</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- /vertical form modal -->
      <!-- Footer -->
      <?php $this->load->view('common/footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->