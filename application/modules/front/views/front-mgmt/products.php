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
   <div class="card card-hero animated slideInUp animation-delay-8 mb-6">
      <div class="card-body">
        
               <div class="row">
                           <div class="heading-panel">
                              <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                 <!-- Main Title -->
                                 <h1>  Products</h1>
                                 <!-- Short Description -->
                                 <!--<p class="heading-text">Eu delicata rationibus usu. Vix te putant utroque, ludus fabellas duo eu, his dico ut debet consectetuer.</p>-->
                              </div>
                           </div>
                           <div class="wpb_column vc_column_container vc_col-sm-12">
                        <div class="vc_column-inner ">
                           <div class="wpb_wrapper">
                              <?php 
                                 if(!empty($all_product) && count($all_product)>0)
                                 {
									 foreach($all_product as $product)
									 {
                                 ?>
									  <div class="col-md-3 post-2614 product type-product status-publish has-post-thumbnail product_cat-shop product_tag-casual last instock featured shipping-taxable purchasable product-type-simple">
										 <div class="sp-feature-box-3 margin-bottom-4">
											<div class="img-box">
											   <a href="#" class="view-btn uppercase">
											   View    	</a>
											   <img src="<?php echo base_url();?>product_images/<?php echo $product['product_image']; ?>" class="attachment- size- wp-post-image" alt="" />    
											</div>
											<div class="clearfix"></div>
											<br />
											<div class="product_desc">
											   <h5 class="less-mar-1"><?php echo $product['title'];?></h5>
											   <h5 class="less-mar-1"><?php echo $product['product_code'];?></h5>
											   <h5 class="text-primary">
												
							
												
		<span class="woocommerce-Price-amount amount"><span class="woocommerce-Price-currencySymbol"></span><?php echo currency().' '.$product['new_price'];?></span>
											  </h5>
											   <a href="javascript:void()" class="btn btn-success" >Add to cart</a>    
											</div>
										 </div>
									  </div>
                              <?php 
									}//end foreach!								
                                }//end empty if!
                              ?>
                           </div>
                        </div>
                     </div>
                        </div>
         <hr class="dotted">
         
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
