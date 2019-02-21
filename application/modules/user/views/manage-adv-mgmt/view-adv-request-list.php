<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Advertise Management</span> - Advertisement Request List</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>user/ManageAdv/addNewAdv" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add New Advertisement</a>
            </div>
         </div>
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"<i class="icon-home2 position-left"></i> Home</a></li>
            <li>Advertise Management</li>
            <li class='active'>Advertisement Request List</li>
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
               <h5 class="panel-title">Advertisement Request List</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <!--<table class="table datatable-responsive">-->
            <table class="table datatable-responsive">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Category Title</th>
                     <th>Adv Title</th>
                     <th>Req. Name</th>
                     <th>Req. Email</th>
                     <th>Req. Contact</th>
                     <th>Req. Message</th>
                     <th>Req. Date</th>
                  </tr>
               </thead>
               <tbody>
                 <?php 
                 if(!empty($all_request) && count($all_request)>0)
                 {

                     $sno=0;
                     foreach ($all_request as $request) 
                     {
                      $sno++;  
                  ?>
                       <tr> 
                          <td><?php echo $sno;?></td>
                          <td><?php echo $request->category_title;?></td>
                          <td><?php echo $request->adv_title;?></td>
                          <td><?php echo $request->name;?></td>
                          <td><?php echo (!empty($request->email))?$request->email:'';?></td>
                          <td><?php echo $request->contact_no;?></td>
                          <td><?php echo (!empty($request->message))?$request->message:'';?></td>
                          <td><?php echo date(date_formats(),strtotime($request->create_date));?></td>
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