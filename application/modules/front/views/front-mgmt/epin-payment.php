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
                     <h1 class="color-primary text-center">E-Pin Payment</h1>
                     
                   <form action="<?php echo site_url();?>front/registerUserViaEpin" method="post" class="sky-form" style="width: 100%">
                                       <header>Epin Payment</header>
                                       <fieldset>
                                          <section>
                                             <div class="row">
                                                <label class="label col col-2">Epin</label>
                                                <div class="col col-6">
                                                   <label class="input">
                                                   <i class="icon-append icon-user"></i>
                                                   <input type="text" required="" name="epin_code" id="epin_code" placeholder="Please enter your epin">
                                                   <span id="valid_epin_code" style="color:red;font-weight:bold;"></span>
                                                   </label>
                                                </div>
                                             </div>
                                          </section>
                                       </fieldset>
                                       <footer>
                                          <button type="submit" name="btn" id="btns" value="send" class="button">Submit</button>
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

<!-- loader-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/jquery.loading.block.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/loader.function.js"></script>
<!-----loader---->   
<script>
$(document).ready(function(){
  
   $("#btns").click(function(){
         if($("#epin_code").val()=='')
         {
          $("#valid_epin_code").text('Please enter epin');
          return false;
         }
         var bool=true;
         jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>front/isEpinValid',
                  ///cache: false, // To unable request pages to be cached
                  data:{'epin_code':$("#epin_code").val()},
                   async: false,
                  //processData: false,
                  beforeSend: function () {
                    //$("#load").css("display", "block");
                    $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                  },
                  success:function(res){
                     if(!res)
                     {
                         $("#valid_epin_code").text('Please enter vaild epin');
                         bool=false;
                     }
                  },//end success
                  complete: function () {
                    //$("#load").css("display", "none");
                    $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                }
             });//end ajax
      return bool;
   });//end btn click here
   $("#epin_code").keyup(function(){
      $("#valid_epin_code").text('');
   });//end keyup
});
</script>