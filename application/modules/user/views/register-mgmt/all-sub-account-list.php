<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Sub Account Management</span> - All Sub Account</h4>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">Sub Account Management</a></li>
            <li class="active">All Sub Account</li>
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
                        <h5 class="panel-title">All Sub Account</h5>
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
                              <th>User Id</th>
                              <th>User Name</th>
                              <th>Full Name</th>
                              <th>Contact No.</th>
                              <th>Rank</th>
                              <th>Status</th>
                              <th>Registration Method</th>
                              <th>Registration Date</th>
                           </tr>
                        </thead>
                        <tbody>
                           <?php
                           //pr($direct_member); 
                           if(!empty($direct_member) && count($direct_member)>0)
                           {
                              $sno=1;
                              foreach($direct_member as $member)
                              {
                                if($member->account_type=='2')
                                {
                                  
                                $status=($member->active_status=='1')?'Active':'Inactive'; 

                           ?>
                           <tr>
                              <td><?php echo $sno;?></td>
                              <td><?php echo $member->user_id;?></td>
                              <td><?php echo $member->username;?></td>
                              <td><?php echo $member->first_name." ".$member->last_name;;?></td>
                              <td><?php echo $member->contact_no;?></td>
                              <td><?php echo $member->rank_name;?></td>
                              <td><?php echo $status;?></td>
                              <td><?php echo $member->registration_method_name;?></td>
                              <td><?php echo date(date_formats(),strtotime($member->registration_date));?></td>
                           </tr>
                           <?php       
                               $sno++;  
                                }
                              }
                           }
                           ?>
                        </tbody>
                     </table>
                  </div>
               </div>
               <!-- Pickadate picker -->
            
               <!-- /pickadate picker -->


               <!-- Pickatime picker -->
               
               <!-- /pickadate picker -->


               <!-- Anytime picker -->
            
               <!-- /anytime picker -->
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