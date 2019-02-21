<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Advertise Management</span> - All Approved Advertisement List</h4>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>Advertise Management</li>
            <li class='active'>All Approved Advertisement List</li>
         </ul>
         <ul class="breadcrumb">
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
         <!--
            <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
            -->
         <?php 
            echo $this->session->flashdata('flash_msg');
            ?>
      </div>
      <?php    
         }
         ?>
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">All Approved Advertisement List</h5>
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
                     <th>Category Title</th>
                     <th>Advertisement Title</th>
                     <th>status</th>
                     <th>View</th>
                     <th>Create Date</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                 <?php 
                 if(!empty($all_active_approved_adv) && count($all_active_approved_adv)>0)
                 {

                     $sno=0;
                     foreach ($all_active_approved_adv as $advertisement) 
                     {
                      $sno++;  
                      $status_label=($advertisement->approval_status=='1')?'label-success':'label-danger';
                      $status=($advertisement->approval_status=='1')?'Approved':'Unapproved'; 
                  ?>
                       <tr> 
                           <td><?php echo $sno;?></td>
                           <td><?php echo $advertisement->category_title;?></td>
                           <td><?php echo $advertisement->adv_title;?></td>
                           <td><span class="label <?php echo $status_label;?>"><?php echo $status;?></span></td>
                           <td><a href="#">View</a>
                           <td><?php echo date(date_formats(),strtotime($advertisement->create_date));?></td>
                           <td>
                              <ul class="icons-list">
                                 <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="icon-menu9"></i>
                                    </a>
                                    <ul class="dropdown-menu dropdown-menu-right">
                                       <li><a onclick="return confirmDelete();" href="<?php echo site_url()."admin/ManageAdv/deleteAdv"?>/<?php echo ID_encode($advertisement->id);?>"><i class="icon-file-excel"></i> Delete Advertisement</a></li>
                                       
                                       <li><a onclick="return confirmChangeStatus();" href="<?php echo site_url();?>admin/ManageAdv/changeAdvStatus/<?php echo ID_encode($advertisement->id);?>"><i class="icon-file-word"></i> Approved/Unapproved</a></li>
                                    </ul>
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
   function confirmDelete()
   {
   
      if(window.confirm("Are you sure, you want to delete the category"))
       return true;
     else 
       return false;
   }
   function confirmChangeStatus()
   {
   
      if(window.confirm("Are you sure, you want to chane the category status"))
       return true;
     else 
       return false;
   }
   
</script>