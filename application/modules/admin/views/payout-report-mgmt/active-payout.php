<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Payout</span> - Active Payout</h4>
         </div>
        
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php
echo site_url();
?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Payout Management</a></li>
            <li class="active">Active Payout</li>
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
               <h5 class="panel-title">Active Payout</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <?php
if (!empty($this->session->flashdata('flash_msg'))) {
?>
              <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php
    echo $this->session->flashdata('flash_msg');
?>
              </div>
               <?php
}
?>                        <?php
if (!empty($this->session->flashdata('error_msg'))) {
?>               <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>                  <?php
    echo $this->session->flashdata('error_msg');
?>               </div>               <?php
}

?>           <?php echo form_open(site_url() . "admin/PayoutReport/allpayout/", array('method' => 'post','class' => 'panel-body'));?>
           <table class="table datatable-responsive">
               <thead>
                  <tr>                     
				  <th>Multiple </th>                     
                     <th>Sr.No</th>
                     <th>Request Id</th>
                     <th>Member Name</th>
                     <th>User Id</th>
                     <th>Request Date</th>
                     <th>Requested Amount</th>
                     <th>Status</th>          
					 <th>Payment Method</th>
                     <th>Action</th>
                  </tr>
               </thead>                
               <tbody>
                  <?php
if (!empty($all_active_payout) && count($all_active_payout) > 0) {
    $sno                       = 0;
    $total_payout_amount       = 0;
    $total_no_of_active_payout = count($all_active_payout);
    foreach ($all_active_payout as $payout) {
        $sno++;
        $total_payout_amount = $total_payout_amount + $payout->request_amount;
?>
                 <tr>                     <td>                     <input type='checkbox' id="list[]" name='alldata[]' value="<?php
        echo $payout->id;
?>" />                                          </td>                     
                     <td><?php
        echo $sno;
?></td>
                     <td><?php
        echo $payout->request_id;
?></td>
                     <td><?php
        echo $payout->username;
?></td>
                     <td><?php
        echo $payout->user_id;
?></td>
                     <td><?php
        echo date(date_formats(), strtotime($payout->request_date));
?></td>
                     <td><?php
        echo currency() . "" . $payout->request_amount;
?></td>
                     <td><span class="label label-danger">Not Released</span></td>                                          
					 <td>                     <b>                     <?php
        if ($payout->payment_method == 1) {
            echo "Bank Wire";
        } 
?>                     </b>                     </td>
                     <td>
                        <ul class="icons-list">
						<li>
         <a href="javascript:void();" onclick="get_detail('<?php echo ID_encode($payout->user_id);?>')" data-popup="tooltip" data-original-title="View Payout"><i class="icon-eye"></i></a>
                           </li>
                           <li>
                              <a onclick="return cancelPayoutConfirm();" href="<?php echo site_url(); ?>admin/PayoutReport/cancelPayoutRequest/<?php echo ID_encode($payout->id); ?>" data-popup="tooltip" title="" data-original-title="Cancel Payout"><i class="icon-blocked"></i></a>
                           </li>
                           <li>
                              <a onclick="return releasePayoutConfirm();" href="<?php echo site_url(); ?>admin/PayoutReport/approvePayoutRequest/<?php echo ID_encode($payout->id);?>/<?php echo ID_encode($payout->user_id);?>" data-popup="tooltip" title="" data-original-title="Release Payout"><i class="icon-checkmark"></i></a>
                           </li>
                        </ul>
                     </td>
                  </tr>
                  <?php
    } //end foreach
} //end if
?>
              </tbody>                
            </table>                        <input name="Show" type="submit" class="btn btn-primary" id="Show" value="Payall" onClick="setTimeout('window.location.reload()',2000);">            <?php
echo form_close();
?>
        </div>
      </div>
      <div class="row">
         <div class="panel panel-body bg-green-400 has-bg-image">
            <div class="media no-margin-top content-group">
               <div class="media-body">
                  <h6 class="no-margin text-semibold">Payout Request</h6>
                  <span class="text-muted"><?php
echo (!empty($total_no_of_active_payout)) ? $total_no_of_active_payout : 0;
?> Requests</span>
               </div>
               <div class="media-right media-middle">
                  <i class="icon-coins icon-2x"></i>
               </div>
            </div>
            <div class="progress progress-micro bg-blue mb-10">
               <div class="progress-bar bg-white" style="width: 100%">
                  <span class="sr-only">67% Complete</span>
               </div>
            </div>
            <?php
echo currency() . " ";
echo (!empty($total_payout_amount)) ? $total_payout_amount : 0;
?>
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
<!-- /main content -->

<div id="view_booking_details_modal" class="modal fade">
						<div class="modal-dialog modal-lg" >
							<div class="modal-content">
								<div class="modal-header bg-success">
									<button type="button" class="close" data-dismiss="modal">&times;</button>
									<h6 class="modal-title" id="view_booking_product_name"></h6>
								</div>
								<div class="modal-body">
								<!------------------------>
									<div id="booking_details_modal_body" class="table-responsive">
										
									</div>
								<!------------------------->
								
								</div>
								<div class="modal-footer">
									<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
								</div>
							</div>
						</div>
					</div>
					<!-- /success modal -->
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/jquery.loading.block.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/loader.function.js"></script>

<script>
function get_detail(userid)
{

$("#view_booking_details_modal").modal('show');

request_url='<?php echo site_url();?>admin/PayoutReport/getAjaxpayoutDetails/'+userid;
	
	var xhttp=new XMLHttpRequest();
	
	xhttp.onreadystatechange=function(){
		
if(this.readyState==4 && this.status==200)
{	
document.getElementById("booking_details_modal_body").innerHTML=this.responseText;
}

};
xhttp.open("GET",request_url,true);
xhttp.send();	
}	
</script>
<script>
function cancelPayoutConfirm()
{
   if(window.confirm('Are you sure, you want to cancel the payout'))
   {
      return true;    
   }
   else 
   {
      return false;
   }
}//end function
function releasePayoutConfirm()
{
   if(window.confirm('Are you sure, you want to release the payout'))
   {         setTimeout('window.location.reload()',2000);
        return true;      
   }
   else 
   {
      return false;
   }
}
</script>