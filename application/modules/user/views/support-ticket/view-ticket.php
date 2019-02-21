<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Support Ticket</span> - View Ticket</h4>
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
            <li class="active">View Ticket</li>
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
               <h5 class="panel-title">View Ticket</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <div class="alert alert-danger ticket-error-msg" style="display:none"></div>
            <table class="table table-bordered table-hover">
               <tbody>
                  <tr>
                     <td><b>Responser</b></td>
                     <td colspan="2"><b>Response</b></td>
                     <td><b>Date</b></td>
                  </tr>
                  <?php
                     if (isset($ticket_obj) && !empty($ticket_obj) && is_array($ticket_obj)) {
                         foreach ($ticket_obj as $ticket) {
                             ?>
                  <tr>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->responser : 'N/A') ?></td>
                     <td colspan="2"><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? $ticket->response : 'N/A') ?></td>
                     <td><?php echo (isset($ticket) && !empty($ticket) && is_object($ticket) ? date('d/m/Y h:i:s A', strtotime($ticket->created_at)) : 'N/A') ?></td>
                  </tr>
                  <?php
                     }
                     }
                     ?>
                  <tr>
                     <td colspan="2">
                        <?php
                           $form_attr = array('class' => 'form-horizontal', 'id' => 'view_ticket', 'method' => 'post');
                           echo form_open('', $form_attr);
                           ?>                  
                        <table class="table table-bordered table-hover">
                           <tbody>
                              <tr>
                                 <td><b>Reply :</b></td>
                                 <td>
                                    <?php
                                       $field_attr = array(
                                           'name' => 'response',
                                           'class' => 'form-control',
                                           'id' => 'response',
                                           'placeholder' => 'Enter Description *',
                                           'value' => set_value('response', (isset($obj_profile) && !empty($obj_profile) ? $obj_profile->response : '')),
                                           'rows' => '7',
                                       );
                                       
                                       echo form_textarea($field_attr);
                                       ?>
                                 </td>
                              </tr>
                           </tbody>
                        </table>
                        <br>
                        <div class="modal-footer">
                           <?php
                              $field_attr = array(
                                  'name' => 'ticket_no',
                                  'type' => 'hidden',
                                  'class' => 'form-control',
                                  'id' => 'support_id',
                                  'value' => (isset($ticket_no) && !empty($ticket_no)  ? $ticket_no : '')
                              );
                              
                              echo form_input($field_attr);
                              $field_attr = array(
                                  'name' => 'ticket_url',
                                  'type' => 'hidden',
                                  'class' => 'form-control',
                                  'id' => 'ticket_url',
                                  'value' => base_url('user/SupportTicket/responseTicket')
                              );
                              
                              echo form_input($field_attr);
                              ?>
                           <button type="submit" name="submit" class="btn btn-primary">Reply</button>
                        </div>
                        <?php echo form_close(); ?>
                        <?php
                           $form_attr = array('class' => 'form-horizontal', 'id' => 'close_ticket', 'method' => 'post');
                           echo form_open('', $form_attr);
                           ?> 
                        <?php
                           $field_attr = array(
                               'name' => 'ticket_no',
                               'type' => 'hidden',
                               'class' => 'form-control',
                               'id' => 'ticket_no',
                               'value' => (isset($ticket_no) && !empty($ticket_no)  ? $ticket_no : '')
                           );
                           echo form_input($field_attr);
                           
                           $field_attr = array(
                               'name' => 'ticket_listing',
                               'type' => 'hidden',
                               'class' => 'form-control',
                               'id' => 'ticket_listing',
                               'value' => site_url().'user/SupportTicket/closedTicket'
                           );
                           
                           
                           echo form_input($field_attr);
                           $field_attr = array(
                               'name' => 'url_close',
                               'type' => 'hidden',
                               'class' => 'form-control',
                               'id' => 'url_close',
                               'value' => base_url('user/SupportTicket/closeTicket')
                           );
                           
                           echo form_input($field_attr);
                           ?>
                        <button type="submit" name="submit" class="btn btn-primary">Close Ticket</button>
                        <?php echo form_close(); ?>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view("common/footer-text");?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->