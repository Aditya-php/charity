<body>
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
      <div class="ms-hero-page-override ms-hero-img-city ms-hero-bg-dark-light">
        <div class="container">
          
        </div>
      </div>
      <div class="container">
        <div class="row justify-content-md-center">
          <div class="col-lg-12">
            <div class="card card-hero card-royal animated fadeInUp animation-delay-7">
            
                      <div class="card-header">
                        <h1 class="card-title">Notice:</h1>
                      </div>
                      <div class="card-body">
                        <div class="row">
                          <?php 
                          if(!empty($registration) && $registration=="success")
                          {
                          ?>
                          <p>Dear User Thanks showing your interest with Care Givers. Your Email is Verified Successfully. Please Click here to <b><a href="<?php echo site_url();?>login">LOGIN</a></b> to Get the Best Experience with Care Givers Donation Platform. Thanks for Joining Care Givers Family.</p>
                          <?php   
                          }
                          else if(!empty($registration) && $registration=="fail")
                          {
                            
                          ?>
                          <p>Dear User Sorry your email verification link has expired, please click here to <b><a href="<?php echo site_url();?>join-us">Join Us</a></b></p>
                          <?php   
                          }
                          ?>
                           
                        </div>
                      </div>
            </div>
          </div>
        </div>
      </div>
      <!-- container -->
      <aside class="ms-footbar">
        <div class="container">
          <div class="row">
            <div class="col-lg-4 ms-footer-col">
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
                      <input type="email" id="ms-subscribe" class="form-control"> </div>
                  </div>
                  <button class="ms-subscribre-btn" type="button">Subscribe</button>
                </form>
              </div>
            </div>
            <div class="col-lg-5 col-md-7 ms-footer-col ms-footer-alt-color">
              <div class="ms-footbar-block">
                <h3 class="ms-footbar-title text-center mb-2">Last Articles</h3>
                <div class="ms-footer-media">
                  <div class="media">
                    <div class="media-left media-middle">
                      <a href="javascript:void(0)">
                        <img class="media-object media-object-circle" src="assets/img/demo/p75.jpg" alt="..."> </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a href="javascript:void(0)">Lorem ipsum dolor sit expedita cumque amet consectetur adipisicing repellat</a>
                      </h4>
                      <div class="media-footer">
                        <span>
                          <i class="zmdi zmdi-time color-info-light"></i> August 18, 2016</span>
                        <span>
                          <i class="zmdi zmdi-folder-outline color-warning-light"></i>
                          <a href="javascript:void(0)">Design</a>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="media">
                    <div class="media-left media-middle">
                      <a href="javascript:void(0)">
                        <img class="media-object media-object-circle" src="assets/img/demo/p75.jpg" alt="..."> </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a href="javascript:void(0)">Labore ut esse Duis consectetur expedita cumque ullamco ad dolor veniam velit</a>
                      </h4>
                      <div class="media-footer">
                        <span>
                          <i class="zmdi zmdi-time color-info-light"></i> August 18, 2016</span>
                        <span>
                          <i class="zmdi zmdi-folder-outline color-warning-light"></i>
                          <a href="javascript:void(0)">News</a>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="media">
                    <div class="media-left media-middle">
                      <a href="javascript:void(0)">
                        <img class="media-object media-object-circle" src="assets/img/demo/p75.jpg" alt="..."> </a>
                    </div>
                    <div class="media-body">
                      <h4 class="media-heading">
                        <a href="javascript:void(0)">voluptates deserunt ducimus expedita cumque quaerat molestiae labore</a>
                      </h4>
                      <div class="media-footer">
                        <span>
                          <i class="zmdi zmdi-time color-info-light"></i> August 18, 2016</span>
                        <span>
                          <i class="zmdi zmdi-folder-outline color-warning-light"></i>
                          <a href="javascript:void(0)">Productivity</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-5 ms-footer-col ms-footer-text-right">
              <div class="ms-footbar-block">
                <div class="ms-footbar-title">
                  <span class="ms-logo ms-logo-white ms-logo-sm mr-1">C</span>
                  <h3 class="no-m ms-site-title">Care
                    <span>Givers</span>
                  </h3>
                </div>
                <address class="no-mb">
                  <p>
                    <i class="color-danger-light zmdi zmdi-pin mr-1"></i> Accra, Ghana</p>
                 
                  <p>
                    <i class="color-info-light zmdi zmdi-email mr-1"></i>
                    <a href="mailto:info@caregivers.com">info@caregivers.com</a>
                  </p>
                  <p>
                    <i class="color-royal-light zmdi zmdi-phone mr-1"></i>+233 266098560 </p>
                  <p>
                    <i class="color-success-light fa fa-fax mr-1"></i>+233 206524733 </p>
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