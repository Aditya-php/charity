<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Message Panel</span> - Compose Message</h4>
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
            <li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Message Panel</a></li>
            <li class="active">Compose Message</li>
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
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Compose Message</h5>
         </div>
         <?php 
            echo form_open(site_url()."user/MessagePanel/composeMessage",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
            ?>
         <div class="panel-body">
            <div class="row">
               <div class="col-md-10">
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Compose Message:</label>
                     <div class="col-lg-9">
                        <select name="users[]" id="users" multiple="multiple" data-placeholder="Select Users" class="select-icons">
                           <optgroup label="Users">
                              <option value="">-Select User-</option>
                              <?php 
                                 if(!empty($all_active_members) && count($all_active_members)>0)
                                 {
                                  foreach($all_active_members as $member)
                                  {
                                    if($user_id!=$member->user_id)
                                    {
                                ?>
                                  <option value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
                                <?php        
                                    }
                                  }//end foreach
                                 }//end if
                               ?>
                           </optgroup>
                        </select>
                        <span class="valid_users" style="color:red;font-weight:bold"></style>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Subject:</label>
                     <div class="col-lg-9">
                        <input type="text" name="subject" id="subject" class="form-control" placeholder="Enter Subject Here">
                        <span class="valid_subject" style="color:red;font-weight:bold"></style>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Message</label>
                     <div class="col-lg-9">
                        <textarea name="message" id="message" class="col-lg-3 control-label"></textarea>
                     </div>
                  </div>
                  <div class="form-group">
                     <label class="col-lg-3 control-label">Attach File:</label>
                     <div class="col-lg-9">
                        <input type="file" name="attachment" id="attachment" class="form-control">
                     </div>
                  </div>
                  <div class="text-right">
                     <button type="submit" name="btn" id="btn" value="send" class="btn btn-primary">Send<i class="icon-arrow-right14 position-right"></i></button>
                  </div>
               </div>
            </div>
         </div>
         <?php echo form_close();?>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
   CKEDITOR.replace('message');
</script>
<script>
$(document).ready(function(){
  $("#btn").click(function(){
    if($("#users").val()=="" || $("#users").val()==null)
    {
      $(".valid_users").text("Please select atleast any user!");
      return false;
    }
    if($("#subject").val()=="")
    {
      $(".valid_subject").text("Please enter subject!");
      return false;
    }
    return true;
  });//end click
  $("#users").change(function(){
      if($(this).val()!='')
      {
         $(".valid_users").text('');
      }
  });
  $("#subject").keyup(function(){
       if($(this).val().length>0)
       {
         $(".valid_subject").text('');
       }
  });
});//end ready
</script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/form_select2.js"></script>