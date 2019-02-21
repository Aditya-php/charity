<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Support Ticket</span> - Open Ticket</h4>
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
            <li class="active">Open Ticket</li>
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
               <h5 class="panel-title">Open Ticket</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a href="javasccript:void(0)" class="btn btn-primary" style="color:white" data-toggle="modal" data-target="#modal_form_vertical"> Create Ticket</a></li>
                  </ul>
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
                     <th>Subject</th>
                     <th>Status</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     if(isset($ticket_obj) && !empty($ticket_obj) && is_array($ticket_obj)){
                         $i = 1;
                         foreach($ticket_obj as $ticket){ ?>
                  <tr>
                     <td><?php echo $i; ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? get_user_name($ticket->user_id) : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->ticket_no : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? date('d/m/Y h:i:s A', strtotime($ticket->created_at)) : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->subject : 'N/A') ?></td>
                     <td><span class="label label-success"><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->status : 'N/A') ?></span></td>
                     <td>
                        <ul class="icons-list">
                           <li>
                              <a href="<?php echo base_url('user/SupportTicket/viewTicket/'.(isset($ticket) && !empty($ticket) && is_object($ticket) ? base64_encode($ticket->ticket_no) : 'N/A')) ?>" data-popup="tooltip" title="" data-original-title="View Response"><i class="icon-pencil7"></i></a>
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <?php
                     $i++;   }
                     
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
                  <h5 class="modal-title">Support Ticket</h5>
               </div>
               <div class="alert alert-danger profile-error-msg" style="display:none"></div>
               <?php
                  $form_attr = array('class' => 'form-horizontal', 'id' => 'open_ticket', 'method' => 'post');
                  echo form_open(site_url()."user/SupportTicket/openTicket/", $form_attr);
                  ?> 
               <div class="modal-body">
                  <table class="table table-bordered table-hover">
                     <tbody>
                        <tr>
                           <td><b>Subject :</b></td>
                           <td>
                              <?php
                                 $field_attr = array(
                                     'name' => 'subject',
                                     'class' => 'form-control',
                                     'placeholder' => 'Enter Subject *',
                                     'id' => 'subject',
                                     'value' => set_value('subject', (isset($obj_profile) && !empty($obj_profile) ? $obj_profile->subject : ''))
                                 );
                                 
                                 echo form_input($field_attr);
                                 ?>
                           </td>
                        </tr>
                        <tr>
                           <td><b>Query :</b></td>
                           <td>
                              <?php
                                 $field_attr = array(
                                     'name' => 'description',
                                     'class' => 'form-control',
                                     'id' => 'description',
                                     'placeholder' => 'Enter Description *',
                                     'value' => set_value('description', (isset($obj_profile) && !empty($obj_profile) ? $obj_profile->description : '')),
                                     'rows' => '7',
                                     'cols' => '10'
                                 );
                                 
                                 echo form_textarea($field_attr);
                                 ?>
                           </td>
                        </tr>
                        <tr>
                           <td><b>Attachment :</b></td>
                           <td>
                              <?php
                                 $field_attr = array(
                                     'name' => 'attachment',
                                     'type' => 'file',
                                     'class' => 'form-control',
                                     'id' => 'attachment'
                                 );
                                 
                                 echo form_input($field_attr);
                                 ?>
                           </td>
                        </tr>
                     </tbody>
                  </table>
                  <?php
                     $field_attr = array(
                         'name' => 'ticket_url',
                         'type' => 'hidden',
                         'class' => 'form-control',
                         'id' => 'ticket_url',
                         'value' => base_url('user/SupportTicket/openTicket')
                     );
                     
                     echo form_input($field_attr);
                     ?>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
               </div>
               <?php echo form_close(); ?>
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