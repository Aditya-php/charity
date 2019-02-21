<!DOCTYPE html>
<html lang="en-US" class="no-js">
	<?php 
	$this->load->view('common/header');
	?>
	<link rel='stylesheet' id='bootstrap-css'  href='<?php echo base_url();?>front_assets/css/sky-forms.css' type='text/css' media='all' />
	<body class="home page-template page-template-page-templates page-template-template-page-vc page-template-page-templatestemplate-page-vc-php page page-id-34 woocommerce-no-js wpb-js-composer js-comp-ver-5.4.7 vc_responsive">
      <div class="over-loader loader-live">
         <div class="loader">
            <div class="loader-item style5">
               <div class="bounce1"></div>
               <div class="bounce2"></div>
               <div class="bounce3"></div>
            </div>
         </div>
      </div>
      <div class="wrapper-boxed">
         <div class="site-wrapper">
            <!-- ================================ -->
            <!-- ============ HEADER ============ -->
           <?php 
		   $this->load->view('top-nav');
		   ?>
            <!-- ========== END OF HEADER  ========== -->
            <!-- ==================================== -->
            <!---------- Sub Header ---------->
            <!---------- Sub Header ---------->
           
           
            <div class="vc_row wpb_row vc_row-fluid sec-padding section-light">
               <div class="container">
         <div class="row justify-content-md-center">
            <div class="col-lg-12">
               <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                  <div class="card-body">
                     <h1 class="color-primary text-center">E-Wallet Payment</h1>
                   
				 
                 
                     
				   <?php 
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                 <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
                  ?>  
                   <form action="#" method="post" class="sky-form" style="width: 100%" id="form">
                                    
                                    
            <header>Pay via Sponsor Wallet</header>
			<h5 style="color:red" id="error_msg"></h5>
			<fieldset>
               <section>
                  <div class="row">
                     <label class="label col col-2">Sponsor Id</label>
                     <div class="col col-6">
                        <label class="input">
                           <i class="icon-append icon-user"></i>
                           <input type="text" name="sponsor_user_name" id="sponsor_user_name">
                        </label>
                     </div>
                  </div>
               </section>
                  <section>
                  <div class="row">
                     <label class="label col col-2">Transaction Password</label>
                     <div class="col col-6">
                        <label class="input">
                           <i class="icon-append icon-lock"></i>
                           <input type="password" name="sponsor_transaction_password" id="sponsor_transaction_password">
                        </label>
                     </div>
                     
                  
                  </div>
                  
               
               </section>
               
         
            </fieldset>
            <footer>
                <button type="submit" name="btn" id="btns" value="submit" class="button">Pay Now</button>
            
            </footer>
         </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
            </div>
            <!-- =================================== -->
            <!-- ========== START FOOTER  ========== -->
            <!-- =================================== -->
            <?php 
			$this->load->view('common/footer');
			?>
            <!-- ================================= -->
            <!-- ========== END FOOTER  ========== -->
            <!-- ================================= -->
         </div>
      </div>
      <?php 
	  $this->load->view('common/footer-script');
	  ?>
   </body>
</html>
<style>
.label
{
  color:black;
  font-size: 14px;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/jquery.loading.block.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/loader.function.js"></script>
<script>
$(document).ready(function(){
      $("#btns").click(function(){
	  $("#error_msg").text('');
	  jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>front/registerUserViaEwallet/',
				  data:$('#form').serialize(),
                  //async:false,
                  beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
				  success:function(res){
					  if(res.status=='1')
					  {
					  
					 window.location.href='<?php echo site_url();?>user/auth/login/'+res.username+"/"+res.password;
					  }
					  else 
					  {
						  $("#error_msg").text(res.message);
					  }
					
                  },//end success
                  complete: function () {
                       $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
			 return false;
   });//end click
});//end ready
</script>