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
                     <h1 class="color-primary text-center">Upload Bank Wire Proof Of payment</h1>
                     
                   <form action="<?php echo site_url();?>front/uploadBankWireProof" enctype="multipart/form-data" method="post" class="sky-form" style="width:100%">
        <header>Upload Bank Wire Proof Of payment</header>
        <br>
                              <?php echo $this->session->flashdata('flash_msg');?>
        
        <fieldset>
          <section>
            <div class="row">
                                    <label class="label col col-2">Username</label>
                                    <div class="col col-6">
                                       <label class="input">
                                       <i class="icon-append icon-user"></i>
                                       <?php 
                                       if(!empty($username))
                                       {
                                       ?>
                                       <input type="text" disabled value="<?php echo $username;?>">
                                       <input type="hidden" name="username" value="<?php echo $username;?>">
                                       <?php  
                                       }
                                       else
                                       {
                                       ?>
                                       <input type="text" name="username" required>
                                       <?php 
                                       }
                                       ?>
                                       </label>
                                    </div>
                                 </div>
                 <br>
                                  <div class="row">
                                    <label class="label col col-2">Proof</label>
                                    <div class="col col-6">
                                       <label class="input">
                                       <i class="icon-append icon-user"></i>
                                       <input type="file" name="proof" required>
                                       </label>
                                    </div>
                                 </div>
          </section>
          
      
        </fieldset>
        <footer>
                              <button type="submit" name="btn" value="submit" class="button">Upload</button>
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