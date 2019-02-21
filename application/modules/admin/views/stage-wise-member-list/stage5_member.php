<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Stage Wise Member List</span> - Director Stage Member</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Stage Wise Member List</a></li>
            <li class="active">Director Stage Member</li>
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

               <h5 class="panel-title">Director Stage Member</h5>
              
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
                  <?php echo $this->session->flashdata('flash_msg');?>
               </div>
               <?php    
                  }
                  ?>
            <?php 
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-warning alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
                  ?> 
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
					 <th>View Genealogy</th>
      				 <th>Referral Tree</th>
					 -->
                  </tr>
               </thead>
            </table>
         </div>
      </div>
	   <div class="row">
         <div class="col-md-6">
            <div class="panel bg-primary">
               <div class="panel-heading">
                  <h6 class="panel-title">Total Member in Director Stage</h6>
               </div>
               <div class="panel-body">
                   <?php echo $sno;?>
               </div>
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>
$(document).ready(function() {
    $('#example').DataTable( {
		"destroy":true,
        "processing": true,
        "serverSide": true,
        "ajax":"<?php echo site_url();?>admin/stage_wise_member/stage5_member_list_ajax",
         "columnDefs"      : [{ 'className': 'control', 'orderable': false, 'targets':[]}, 
                    {'orderable': false, 'targets': [] }, 
                    {"targets": [ ],"visible": false,"searchable": false}
                ]
    } );
} );
</script>
<script>
function confirmExportData()
{
	if(window.confirm('Are you sure? you want to export data'))
	{
		var oTable = $('#table').dataTable({
        retrieve: true
		});
		var allPages = oTable.fnGetNodes(); 
		var check_box=$('.check_member:checked', allPages);
		var member_id;
		check_box.each(function(){
			member_id=$(this).val();
			$("#member_form").append("<input type='hidden' name='all_member[]' value='"+member_id+"'>");
			
		});
		if(check_box.length>0 && check_box.length<3000)
		{
			setTimeout('window.location.reload()',3000*2);	
		}
		else if(check_box.length>=3000)
		{
			setTimeout('window.location.reload()',check_box.length*3);	
		}
		return true;
	}
	else 
	{
		return false;
	}
}
////////////
$(window).load(function () { 
    var oTable = $('#table').dataTable({
        retrieve: true
    });
    var allPages = oTable.fnGetNodes();
	
	$(".check_all_member_th").css('display','');
	$(".check_member_td", allPages).css('display','');
	
    $('body').on('click', '.check_all_member', function () {
        if ($(this).hasClass('check_member')) {
            $('input[type="checkbox"]', allPages).prop('checked', false);
        } 
		else 
		{
			$('input[type="checkbox"]', allPages).prop('checked', true);
        }//end else 
        $(this).toggleClass('check_member');
    })
});

</script>