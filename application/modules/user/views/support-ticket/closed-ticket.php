<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Support Ticket</span> - Closed Ticket</h4>
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
            <li><a href="<?php echo site_url(); ?>user"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Support Ticket</a></li>
            <li class="active">Closed Ticket</li>
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
               <h5 class="panel-title">Closed Ticket</h5>
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
                     <th>User Name</th>
                     <th>Ticket Id</th>
                     <th>Date of Creation</th>
                     <th>Date of Close</th>
                     <th>Subject</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if (isset($ticket_obj) && !empty($ticket_obj) && is_array($ticket_obj)) {
                         $i = 1;
                         foreach ($ticket_obj as $ticket) {
                             ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? get_user_name($ticket->user_id) : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->ticket_no : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? date('d/m/Y h:i:s A', strtotime($ticket->created_at)) : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? date('d/m/Y h:i:s A', strtotime($ticket->updated_at)) : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->subject : 'N/A') ?></td>
                     <td><span class="label label-danger"><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->status : 'N/A') ?></span></td>
                     <td>
                        <ul class="icons-list">
                           <li>
                              <a href="#" data-popup="tooltip" title="" data-original-title="Reply Ticket" data-toggle="modal" data-target="#modal_form_vertical"><i class="icon-pencil7"></i></a>
                           </li>
                           <li>
                              <a onclick="return deleteConfirm();" href="#" data-popup="tooltip" title="" data-original-title="Close Ticket"><i class="icon-trash"></i></a>
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <?php
                     $i++;
                     }
                     }
                     ?>
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
                  <h5 class="modal-title">Ticket Id No</h5>
               </div>
               <form action="#">
                  <div class="modal-body">
                     <div class="form-group">
                        <div class="row">
                           <textarea rows="5" cols="5" class="form-control" placeholder="Reply Ticket"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Submit Reply</button>
                  </div>
               </form>
            </div>
         </div>
      </div>
      <!-- /vertical form modal -->
      <!-- Footer -->
      <?php $this->load->view("common/footer-text");?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->