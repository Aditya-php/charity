<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Marketing Tools</span> - Referral Link</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-bars-alt text-primary"></i><span>Statistics</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calculator text-primary"></i> <span>Invoices</span></a>
               <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar5 text-primary"></i> <span>Schedule</span></a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Marketing Tools</a></li>
            <li class="active">Referral Link</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               Settings
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> All settings</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!--
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
      </div>
      <div class="alert alert-warning alert-styled-right">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <span class="text-semibold">Warning!</span> Oh! Transaction Password is Wrong
      </div>
      -->
      <div class="panel panel-flat border-top-lg border-top-warning">
         <div class="panel-heading">
            <h6 class="panel-title"><span class="text-semibold">My Referral Link</span></h6>
         </div>
         <div class="panel-body">
            
			
			<input type='text' style='width:35%'  value='<?php echo $referral_link;?>' class='form-control btn btn-primary' id='ref'/>
			
			<a href="javascript:void();" id='copyy' onclick='myFunction()' class='btn btn-success'>Copy Referral Link</a>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('footer-text');?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->
<script>

function myFunction() 
{
  /* Get the text field */
  var copyText = document.getElementById("ref");

 
  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Your Referral Link is copied");
}
$(document).ready(function(){
    $("#ref").click(function()
	{
        var url=$(this).val();
		window.open(url,'_blank');
    });
});

</script>