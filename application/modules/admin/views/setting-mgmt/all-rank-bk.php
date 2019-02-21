<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Currency</span> - Settings</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Setings</a></li>
            <li class="active">Currency Settings</li>
         </ul>
        
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
         <div class="panel panel-flat">
            <div class="panel-heading">
               Rank Management               
               <?php 
                  if(!empty($this->session->flashdata('flash_msg')))
                  {
                  ?>
               <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php    
                  }
                  ?>
            </div>
         </div>
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Currency Setting</h5>
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
                              <th>Sr.</th>
                              <th>Rank Name</th>
                              <th>Direct Member</th>
                              <th>Team Member</th>
                              <th>Bonus Amount</th>
                              <th>Create Date</th>
                              <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
                           //pr($all_ranks);
                           $sno=0;
                           foreach ($all_ranks as $rowObj) 
                           {
                            $sno++; 
                           ?>
                           <tr>
                              <td><?php echo $sno;?></td>
                              <td><span class="rank-color"><?php echo $rowObj->rank_name; ?></span></td>
                              <td><?php echo $rowObj->direct_member; ?></td>
                              <td><?php echo $rowObj->team_member; ?></td>
                              <td><?php echo $rowObj->bonus_amount." ".currency(); ?></td>
                              <td><?php echo date(date_formats(),strtotime($rowObj->create_date)); ?></td>
                  <td>
                     <ul class="icons-list">
                        <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                           <i class="icon-menu9"></i>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-right">
                              <li><a  href="<?php echo site_url()."admin/rank/editRank"?>/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-pdf"></i> Edit Rank</a></li>
                              <li><a onclick="return confirmDelete();" href="<?php echo site_url()."admin/rank/deleteRank"?>/<?php echo ID_encode($rowObj->id);?>"><i class="icon-file-excel"></i> Delete Rank</a></li>
                           </ul>
                        </li>
                     </ul>
                  </td>
                           </tr>
                           <?php 
                           }
                           ?>
               <?php       
                  }
                  }
                  ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>
   function confirmChangeStatus()
   {
   
      if(window.confirm('Are you sure, you want to change the status!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
   function confirmDelete()
   {
   
      if(window.confirm('Are you sure, you want to delete the currency!'))
      {
         return true;
      }
      else
      {
         return false;
      }
   }
</script>