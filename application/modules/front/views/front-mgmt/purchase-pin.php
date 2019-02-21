<link rel='stylesheet' id='contact-form-7-css'  href='<?php echo base_url();?>front_assets/css/form.css' type='text/css' media='all' />
<body class="home page-template page-template-page-home page-template-page-home-php page page-id-862 logged-in wpb-js-composer js-comp-ver-5.4.5 vc_responsive">
   <div class="loading" id="sb_loading">&#8230;</div>
   <div class="sb-top-bar_notification">
      <a href="javascript:void(0);">
      For a better experience please change your browser to CHROME, FIREFOX, OPERA or Internet Explorer.</a>
   </div>
   <!-- =-=-=-=-=-=-= Light Header =-=-=-=-=-=-= -->
   <?php
      $this->load->view('common/top-nav');
      ?>
   <div class="vc_row wpb_row vc_row-fluid">
      <!-- Ads Archive 7 -->
      <div class="wpb_column vc_column_container vc_col-sm-12">
         <div class="vc_column-inner ">
            <div class="wpb_wrapper">
               <section class="custom-padding  " >
                  <!-- Main Container -->
                  <div class="container">
                     <!-- Row -->
                     <div class="row">
                        <div class="heading-panel">
                           <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                              <!-- Main Title -->
                              <h1>  Purchase E-Pin</h1>

                              <!-- Short Description -->
                              <p class="heading-text">Dear esteemed Customer, in order to complete the business registration process, kindly contact our sales department for e-pin. iRent e-pin is 25$ only. Our sales Representative is available 24/7 on +2348156548484 or submit your request on Info@iRentonline.biz. You Can Send your Proof of payment to Info_dominas@iRentonline.biz. Thank you for your patronage!!!!</p>
                           </div>
                        </div>
                        <div class="" style="box-shadow: 0px 0px 0px 0px;" >
                           <!-- Ads Archive 6 -->
                           <div class="col-md-6 col-xs-6 col-sm-12">
                              <div class="row">
                                 <div class="posts-masonry">
                                    <form action="<?php echo site_url();?>front/purchasePinRequest" method="post" enctype="multipart/form-data" class="sky-form" style="width: 100%;">
                                       <header>Purchase E-Pin
                                          <?php 
                                          if(!empty($this->session->flashdata('flash_msg')))
                                          {
                                          ?>
                                           <h4 style="color:green;font-weight:bold;"><?php echo $this->session->flashdata('flash_msg');?></h4>
                                          <?php    
                                          }
                                          ?>
                                         

                                       </header>

                                       <fieldset>
                                          <section>
                                             <div class="row">
                                                <label class="label col col-4">Full Name</label>
                                                <div class="col col-8">
                                                   <label class="input">
                                                   <i class="icon-append icon-user"></i>
                                                   <input type="text" name="full_name" required>
                                                   </label>
                                                </div>
                                             </div>
                                          </section>
                                          <section>
                                             <div class="row">
                                                <label class="label col col-4">Email Id</label>
                                                <div class="col col-8">
                                                   <label class="input">
                                                   <i class="icon-append icon-lock"></i>
                                                   <input type="email" name="email" required>
                                                   </label>
                                                   <div class="note">
                                                      <!--<a href="forgot.html">Forgot password?</a>-->
                                                   </div>
                                                </div>
                                             </div>
                                          </section>
                                          <section>
                                             <div class="row">
                                                <label class="label col col-4">Mobile No.</label>
                                                <div class="col col-8">
                                                   <label class="input">
                                                   <i class="icon-append icon-lock"></i>
                                                   <input type="text" name="mobile_no" required>
                                                   </label>
                                                   <div class="note">
                                                      <!--<a href="forgot.html">Forgot password?</a>-->
                                                   </div>
                                                </div>
                                             </div>
                                          </section>
                                          <section>
                                             <div class="row">
                                                <label class="label col col-4">Payment Proof</label>
                                                <div class="col col-8">
                                                   <label class="input">
                                                   <i class="icon-append icon-lock"></i>
                                                   <input type="file" name="proof" required>
                                                   </label>
                                                   <div class="note">
                                                      <!--<a href="forgot.html">Forgot password?</a>-->
                                                   </div>
                                                </div>
                                             </div>
                                          </section>
                                       </fieldset>
                                       <footer>
                                          <button name="btn" value="send" type="submit" class="button">Submit</button>
                                       </footer>
                                    </form>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6 col-xs-6 col-sm-12">
                              <div class="row">
                                 <div style="padding:50px; visibility:hidden">
                                    <h1>Bank Detail</h1>
                                    <p>Account No :-  0039875305</p>
                                    <p>Account Name :- Ogbu Jokine Chienyem</p>
                                    <p>Bank Name :- GT Bank Nigeria PLC</p>
                                    <p>Account Type :- Savings account</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </section>
            </div>
         </div>
      </div>
   </div>
   <?php
      $this->load->view("common/footer");
      ?>
</body>
</html>
<style type="text/css">
   label.label.col.col-4 {
   color: black;
   font-size: 13px;
   }
</style>