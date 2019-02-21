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
                     <h1 class="color-primary text-center">Member login</h1>
                     
                   <form action="<?php echo site_url();?>user/auth/frontUserLogin" class="sky-form" method="post" autocomplete="off">
                        <!--<h5 style="color:red;font-weight:bold;">Sorry enterd/username or password is wrong</h5>-->
                        <?php echo $this->session->flashdata('res');?>
								<fieldset>
                                 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
                                       <label class="control-label" for="ms-form-user">Username</label>
										 <input type="text" required="" name="username" id="usernamee" class="form-control"> 
										 <span id="valid_usernamee" style="color:red;font-weight:bold;"></span>
                                       </label>
                                    </section>
									<input type='hidden' name='SHOP' value="SHOP" />
                                    
                                 </div>
								 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
										 <label class="control-label" for="ms-form-pass">Password</label>
										 <input required="" type="password" name="password" id="passwordd" class="form-control">
										 <span id="valid_passwordd" style="color:red;font-weight:bold;"></span> 
                                       </label>
                                    </section>
                                 </div>
                              </fieldset>
							  <footer>
					<a href="<?php echo site_url();?>front/shop/checkguest" class="button">Checkout As Guest</a>	
                                 <button type="submit" name="btn" id="btn1" class="button">Login</button>
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
<script>
$(document).ready(function(){
  $("#btn1").click(function(){

        if($("#usernamee").val()=="")
         {

            $("#valid_usernamee").text('Please enter username!');
            return false;
         }
         if($("#passwordd").val()=="")
         {
            $("#valid_passwordd").text('Please enter password!');
            return false;
         }

      return true;    
  });
  $("#usernamee").keyup(function(){
    $("#valid_usernamee").text(''); 
  });
  $("#passwordd").keyup(function(){
    $("#valid_passwordd").text(''); 
  });
});
</script>
