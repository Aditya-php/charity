<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Message</span> - Sent Message</h4>
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
            <li><a href="#">Message Panel</a></li>
            <li class="active">Sent Message</li>
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
               <h5 class="panel-title">Sent Message</h5>
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
                     <th>Message Id</th>
                     <th>Date </th>
                     <th>Subject</th>
                     <th>Sent To</th>
                     <th>Attachment</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  //pr($all_sent_msg);
                  if(!empty($all_sent_msg) && count($all_sent_msg)>0)
                  {
                     $sno=0;
                     foreach ($all_sent_msg as $msg) 
                     {
                        $sno++;
                  ?>
                     <tr>
                        <td><?php echo $sno;?></td>
                        <td><?php echo $msg->message_id;?></td>
                        <td><?php echo date(date_formats(),strtotime($msg->ts));?></td>
                        <td><?php echo $msg->subject;?></td>
                        <td><?php echo $msg->receiver_name;?></td>
                        <td>
                           <?php
                           if(!empty($msg->attachment))
                           {
                           ?>
                           <a href="<?php echo site_url();?>images/<?php echo $msg->attachment;?>" target="_blank">View Attachment</a>
                           <?php    
                           } 
                           else 
                           {
                           ?>
                           ---
                           <?php    
                           }
                           ?>
                        </td>
                        <td>
                           <ul class="icons-list">
                              <li>
                                 <a href="#" msg-id="<?php echo ID_encode($msg->id);?>" class="read_msg" data-popup="tooltip" title="" data-original-title="Read Message" data-toggle="modal" data-target="#modal_form_vertical"><i class="icon-eye"></i></a>
                              </li>
                              <li>
                                 <a onclick="return deleteConfirm();" href="<?php echo site_url();?>admin/MessagePanel/deleteSentMessage/<?php echo ID_encode($msg->id);?>" data-popup="tooltip" title="" data-original-title="Close Message"><i class="icon-trash"></i></a>
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
      </div>
      <!-- Vertical form modal -->
      <div id="modal_form_vertical" class="modal fade">
         <div class="modal-dialog">
            <div class="modal-content">
               <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h5 class="modal-title" id="msg_subject"></h5>
               </div>
               <form action="#">
                  <div class="modal-body">
                     <p id="msg"></p>
                     <!--
                     <div class="form-group">
                        <div class="row">
                           <textarea rows="5" cols="5" class="form-control" placeholder="Reply Message"></textarea>
                        </div>
                     </div>
                    -->
                  </div>
                  <!--
                  <div class="modal-footer">
                     <button type="submit" class="btn btn-primary">Reply Message</button>
                  </div>
                  -->
               </form>
            </div>
         </div>
      </div>
      <!-- /vertical form modal -->
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->  
<script>
function deleteConfirm()
{

   if(window.confirm("Are you sure, you want to delete the message"))
      return true;
   else 
      return false;
}

$(document).ready(function(){
  $(".read_msg").click(function(){
     var msg_id=$(this).attr("msg-id");
     //alert(msg_id);
     $.ajax({
                   url: "<?php echo site_url();?>admin/MessagePanel/readMessage/", // Url to which the request is send
                   type: "POST", // Type of request to be send, called as method
                   data: {'msg_id':msg_id}, 
                   beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>/images/default.svg');
                   }, 
                   success: function (msg)  
                   {
                     $("#msg_subject").html('Subject :'+msg.subject);
                     $("#msg").html('<h5>Message :</h5>'+msg.message);
                   },
                   complete: function () {
                       $.loader("off", '<?php echo site_url();?>/images/default.svg');
                   }
               });//end $.ajax


  });//end read msg click here
});//end ready
</script>