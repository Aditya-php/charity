<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sub Account Management</span> - All Sub Account Password</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">Sub Account Management</a></li>
            <li class="active">All Sub Account Password</li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">

               <div class="row">
                <?php echo $this->session->flashdata('flash_msg');?>
                 <div class="panel panel-flat">
                     <div class="panel-heading">
                        <h5 class="panel-title">All Sub Account Password</h5>
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
                             <th>Member Name</th>
                             <th>User Id</th>
                             <th>Joining Date</th>
                             <th>Password</th>
                             <th>Transaction Password</th>
                          </tr>
                       </thead>
                       <tbody>
                          <?php 
                          //pr($all_members);
                          if(!empty($all_members) && count($all_members)>0)
                          {
                             $sno=0;
                             foreach ($all_members as $member) 
                             {
                              if($member->sponsor_user_id==$user_id && $member->account_type=='2')
                              {
                             $sno++;  
                          ?>
                          <tr>
                             <td><?php echo $sno;?></td>
                             <td><?php echo $member->username;?></td>
                             <td><?php echo $member->user_id;?></td>
                             <td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
                             <td><?php echo $member->password;?></td>
                             <td><?php echo $member->transcation_password;?></td>
                          </tr>
                          <?php
                                }    
                             }
                          }
                          ?>
                       </tbody>
                    </table>
                  </div>
               </div>
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