<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">E-Pin Management</span> - <?php echo $title;?></h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>user/epin/purchasePin" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add New Purchase Pin Request</a>
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>E-Pin Management</li>
            <li class='active'><?php echo $title;?></li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Horizontal form options -->
      <div class="row">
         <div class="col-md-12">
            <?php 
            if(!empty($this->session->flashdata('flash_msg')))
            {
            ?>
            <div class="alert alert-success alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <?php echo $this->session->flashdata('flash_msg');?>
            </div>
            <?php     
            }
            ?>
         </div>
         <div class="col-md-6">
            <!-- Basic layout-->
            <div class="panel panel-flat border-top-success">
               <!-- Subscription form -->
               <div class="panel panel-flat">
                  <div class="panel-heading">
                     <h6 class="panel-title">Transfer Wallet Fund </h6>
                  </div>
                  <?php 
                  $username=(!empty($username))?$username:Null;
                  $epin_code=(!empty($epin_code))?$epin_code:Null;
                  echo form_open(site_url()."user/epin/transferEpin",array('method'=>'post','class'=>'panel-body', 'enctype'=>'multipart/form-data'));
                  ?>
                  <!--<form class="panel-body" action="#">-->
                     <!--
					 <div class="form-group has-feedback">
                        <input type="text" value="<?php //echo set_value('username',$username);?>" name='username' class="form-control" placeholder="Receiver Id OR Username">
                        <span style="color:red;font-weight:bold"><?php //echo form_error('username');?></span>
                     </div>
					 -->
					 <div class="form-group">
                              <label class="display-block">Select User</label>
                              <select name='username' class="select-menu-color">
                                 <optgroup label="Receiver Id OR Username">
									<?php 
									if(!empty($all_active_members) && count($all_active_members)>0)
									{
										foreach($all_active_members as $member)
										{
									?>
									    <option <?php echo set_select('username', $member->user_id);?> value="<?php echo $member->user_id;?>"><?php echo $member->username;?></option>
									<?php 
										}
									}
									?>
                                 </optgroup>
                              </select>
							  <span style="color:red;font-weight:bold"><?php echo form_error('username');?></span>
                    </div>
                     <div class="form-group has-feedback">
                        <input type="text" value="<?php echo set_value('epin_code',$epin_code);?>" name='epin_code' class="form-control" placeholder="Enter Pin No">
                        <span style="color:red;font-weight:bold"><?php echo form_error('epin_code');?></span>
                     </div>
                     <div class="row">
                        <div class="col-xs-6">
                           <div class="checkbox disabled">
                              <label>
                              <input type="checkbox" class="styled" checked="checked" disabled="disabled">
                              Accept terms
                              </label>
                           </div>
                        </div>
                        <div class="col-xs-6 text-right">
                           <button type="submit" name="btn" value="submit" id="btn" class="btn btn-info">Transfer  Pin</button>
                        </div>
                     </div>
                  <!--</form>-->
                  <?php 
                  echo form_close();
                  ?>
               </div>
               <!-- /subscription form -->
            </div>
            <!-- /basic layout -->
         </div>
      </div>
      <!-- /vertical form options -->
      <!-- Footer -->
      <?php 
         $this->load->view('common/footer-text');
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<script>
   function deleteConfirm()
   {
   
      if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>