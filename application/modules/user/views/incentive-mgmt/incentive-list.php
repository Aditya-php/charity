<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Report Management</span> - <?php echo $title;?></h4>
         </div>
         
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">Report</a></li>
            <li class="active"><?php echo $title; ?></li>
         </ul>
         <ul class="breadcrumb">
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
     
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title">Report</h5>
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
                     <th></th>
                     <th>Sr.No</th>
                     <th>User Id</th>
                 
                     <th>Incentive</th>
                     <th>Stage</th>
                    
                     <th>Date</th>
                    
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_list) && count($all_list)>0)
                  {
                   
                     $sno=0;
					 foreach ($all_list as $all) 
                     {
						 $sno++;
                   
                  ?>
                  <tr>
                     <td></td>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $all['user_id'];?></td>
                    
                     <td><?php echo $all['name'];?></td>
                     <td><?php echo $all['summary'];?></td>
                     <td><?php echo date('d-F-Y',strtotime($all['create_date']));?></td>
                   
                  </tr>
                  <?php       
                     }
                  }
                  ?>
               </tbody>
            </table>
         </div>
    
      <?php 
         $this->load->view('common/footer-text');
         ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
