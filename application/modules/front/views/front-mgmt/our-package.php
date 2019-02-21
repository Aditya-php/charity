<body>
    <a href="javascript:void(0)" class="ms-conf-btn ms-configurator-btn btn-circle btn-circle-raised btn-circle-primary animated rubberBand">
      <i class="fa fa-gears"></i>
    </a>
    
    <div id="ms-preload" class="ms-preload">
      <div id="status">
        <div class="spinner">
          <div class="dot1"></div>
          <div class="dot2"></div>
        </div>
      </div>
    </div>
    <div class="ms-site-container">
      <?php 
         $this->load->view("common/nav");
      ?>
      <div class="material-background"></div>
      <div class="container">
        <div class="text-center mb-4">
          <h2 class="uppercase color-white animated fadeInUp animation-delay-7">See our subscription plans</h2>
          <p class="lead uppercase color-medium animated fadeInUp animation-delay-7">Surprise with our unique features</p>
        </div>
        <div class="row no-gutters">
          <div class="col-lg-6">
            <div class="price-table price-table-info wow zoomInUp animation-delay-2">
              <header class="price-table-header">
                <span class="price-table-category">STANDARD PACKAGE</span>
                <h3>
                  100-1000 GHC
                </h3>
              </header>
              <div class="price-table-body">
                <ul class="price-table-list">
                  <li>
                    <i class="zmdi zmdi-code"></i> But limited to 500 cedis in the first three months</li>
                 
                </ul>
                <div class="text-center">
                  <a href="javascript:void(0)" class="btn btn-info btn-raised">
                    <i class="zmdi zmdi-cloud-download"></i> Get Now</a>
                </div>
              </div>
            </div>
          </div>
          <div class="col-lg-6">
            <div class="price-table price-table-success prominent wow zoomInDown animation-delay-2">
              <header class="price-table-header">
                <span class="price-table-category">DELUXE PACKAGE</span>
                <h3>
                  1000-2000 GHC
                </h3>
              </header>
              <div class="price-table-body">
                <ul class="price-table-list">
                  <li>
                    <i class="zmdi zmdi-code"></i> Not available now. </li>
                 
                </ul>
                <div class="text-center">
                  <a href="javascript:void(0)" class="btn btn-success btn-raised" >
                    <i class="zmdi zmdi-cloud-download"></i> Get Now</a>
                </div>
              </div>
            </div>
          </div>
          
        </div>
      </div>
      <!-- container -->
      
      
      <!-- container -->
        <aside class="ms-footbar">
         <div class="container">
            <div class="row">
               <div class="col-lg-6 ms-footer-col">
                  <div class="ms-footbar-block">
                     <h3 class="ms-footbar-title">Sitemap</h3>
                     <ul class="list-unstyled ms-icon-list three_cols">
                        <li>
                           <a href="index.html">
                           <i class="zmdi zmdi-home"></i> Home</a>
                        </li>
                        <li>
                           <a href="about-us.html">
                           <i class="zmdi zmdi-edit"></i> About Us</a>
                        </li>
                        <li>
                           <a href="how-it-works.html">
                           <i class="zmdi zmdi-image-o"></i> How it Works</a>
                        </li>
                        <li>
                           <a href="package.html">
                           <i class="zmdi zmdi-case"></i> Package</a>
                        </li>
                        <li>
                           <a href="faq.html">
                           <i class="zmdi zmdi-time"></i> FAQ</a>
                        </li>
                        <li>
                           <a href="<?php echo site_url();?>login">
                           <i class="zmdi zmdi-money"></i> Login</a>
                        </li>
                        <li>
                           <a href="<?php echo site_url();?>join-us">
                           <i class="zmdi zmdi-favorite-outline"></i> Join Us</a>
                        </li>
                        <li>
                           <a href="disclaimer.html">
                           <i class="zmdi zmdi-accounts"></i> Disclaimer</a>
                        </li>
                        <li>
                           <a href="toc.html">
                           <i class="zmdi zmdi-face"></i> Terms & Conditions</a>
                        </li>
                        <li>
                           <a href="privacy.html">
                           <i class="zmdi zmdi-help"></i> Privacy Policy</a>
                        </li>
                        <li>
                           <a href="page-contact.html">
                           <i class="zmdi zmdi-email"></i> Contact</a>
                        </li>
                     </ul>
                  </div>
                  <div class="ms-footbar-block">
                     <h3 class="ms-footbar-title">Subscribe</h3>
                     <p class="">Subscribe for Care Givers Newsletter</p>
                     <form>
                        <div class="form-group label-floating mt-2 mb-1">
                           <div class="input-group ms-input-subscribe">
                              <label class="control-label" for="ms-subscribe">
                              <i class="zmdi zmdi-email"></i> Email Adress</label>
                              <input type="email" id="ms-subscribe" class="form-control"> 
                           </div>
                        </div>
                        <button class="ms-subscribre-btn" type="button">Subscribe</button>
                     </form>
                  </div>
               </div>
               
               <div class="col-lg-3 col-md-5 ms-footer-col ms-footer">
                  <div class="ms-footbar-block">
                     <div class="ms-footbar-title">
                        <span class="ms-logo ms-logo-white ms-logo-sm mr-1">C</span>
                        <h3 class="no-m ms-site-title">Care
                           <span>Givers</span>
                        </h3>
                     </div>
                     <address class="no-mb">
                        <p>
                           <i class="color-danger-light zmdi zmdi-pin mr-1"></i> Accra, Ghana
                        </p>
                        <p>
                           <i class="color-info-light zmdi zmdi-email mr-1"></i>
                           <a href="mailto:info@caregivers.com">info@caregivers.com</a>
                        </p>
                        <p>
                           <i class="color-royal-light zmdi zmdi-phone mr-1"></i>+233 266098560 
                        </p>
                        <p>
                           <i class="color-success-light fa fa-fax mr-1"></i>+233 206524733 
                        </p>
                     </address>
                  </div>
                  <div class="ms-footbar-block">
                     <h3 class="ms-footbar-title">Social Media</h3>
                     <div class="ms-footbar-social">
                        <a href="javascript:void(0)" class="btn-circle btn-facebook">
                        <i class="zmdi zmdi-facebook"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-circle btn-twitter">
                        <i class="zmdi zmdi-twitter"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-circle btn-youtube">
                        <i class="zmdi zmdi-youtube-play"></i>
                        </a>
                        <br>
                        <a href="javascript:void(0)" class="btn-circle btn-google">
                        <i class="zmdi zmdi-google"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-circle btn-instagram">
                        <i class="zmdi zmdi-instagram"></i>
                        </a>
                        <a href="javascript:void(0)" class="btn-circle btn-github">
                        <i class="zmdi zmdi-github"></i>
                        </a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </aside>
      <footer class="ms-footer">
        <div class="container">
          <p>Copyright &copy; Caregivers 2018</p>
        </div>
      </footer>
      <div class="btn-back-top">
        <a href="#" data-scroll id="back-top" class="btn-circle btn-circle-primary btn-circle-sm btn-circle-raised ">
          <i class="zmdi zmdi-long-arrow-up"></i>
        </a>
      </div>
    </div>
    <!-- ms-site-container -->
    <?php 
      $this->load->view('common/footer');
    ?>
  </body>
</html>