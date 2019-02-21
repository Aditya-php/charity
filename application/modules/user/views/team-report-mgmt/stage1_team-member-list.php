<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">My Team Report</span> - <?php echo $title;?></h4>
         </div>
         <!--
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>user/ewallet/depositWalletAmountRequest" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add New Deposit Request</a>
            </div>
         </div>
         -->
         <a class="heading-elements-toggle"><i class="icon-menu"></i></a>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>user"<i class="icon-home2 position-left"></i> Home</a></li>
            <li class="active"><a href="#">My Team Report</a></li>
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
                        <h5 class="panel-title">My Team Member Report</h5>
                        <div class="heading-elements">
                           <ul class="icons-list">
                              <li><a data-action="collapse"></a></li>
                              <li><a data-action="reload"></a></li>
                              <li><a data-action="close"></a></li>
                           </ul>
                        </div>
                     </div>
                    
                     <table class="table datatable-responsive" id="example">
					   <thead>
						  <tr>
							 <th>Sr.No</th>
							 <th>Member Name</th>
							 <th>User Id</th>
							 <th>Joining Date</th>
							 <th>Sponsor Id</th>
							 <th>Sponsor Name</th>
							 <th>Status</th>
							 <!--
							 <th>Action</th>
							 <th>View Genealogy</th>
							 <th>Referral Tree</th>
							 -->
						  </tr>
                        </thead>
                    </table>
                  </div>
               </div>
            
               <?php 
               $this->load->view('common/footer-text');
               ?>
               <!-- /footer -->

            </div>
   <!-- /content area -->
</div>
<script>
$(document).ready(function() {
    $('#example').DataTable( {
		"destroy":true,
        "processing": true,
        "serverSide": true,
        "ajax":"<?php echo site_url();?>user/TeamReport/get_stage_wise_team_member/matrix_stage1",
         "columnDefs"      : [{ 'className': 'control', 'orderable': false, 'targets':[]}, 
                    {'orderable': false, 'targets': [] }, 
                    {"targets": [ ],"visible": false,"searchable": false}
                ]
    } );
} );
</script>
<script>
   function deleteConfirm()
   {
   
   	if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>