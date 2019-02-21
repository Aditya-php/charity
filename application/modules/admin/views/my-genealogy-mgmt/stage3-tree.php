<!DOCTYPE html>
<html lang="en">
   <head profile="http://www.w3.org/1999/xhtml/vocab">
      <!-- Global stylesheets -->
      <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>/admin_assets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>/admin_assets/assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>/admin_assets/assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>/admin_assets/assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
      <link href="<?php echo base_url();?>/admin_assets/assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
      <!-- Core JS files -->
      <!-- Core JS files -->
      <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/libraries/jquery.min.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
      <!-- /core JS files -->
      <!-- Theme JS files -->
      <!--ckeditor-->
      <!--ckeditor-->
      <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/app.js"></script>
      <!-- /theme JS files -->
      <!-- color picker js start from here -->
      <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/pickers/color/spectrum.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/picker_color.js"></script>
      <!-- color picker js end over here -->
      <!----Matrix css and js start from here---->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>matrix-tree-assets/css/font-awesome.min.css" media="all">
      <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>matrix-tree-assets/css/css_4RRBgc5XjkRtFyI2KCCSDa_SNLMDDBPEzKaFapafOaU.css" media="all" />
      <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>matrix-tree-assets/css/css_Jk7rlzsJZTm_2CAYMKKSwzfvzNa4YOR8VsOnku2O92g.css" media="all" />
      <script type="text/javascript" src="<?php echo base_url();?>matrix-tree-assets/js/js_2hoh0v0y6B2TInaEIHI3XwA7E31uiNqpq69BJ97pODY.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>matrix-tree-assets/js/js_aczm2rRgH_slWBPnvD3KMrK7rwa1i99HOq8IUAb99Co.js"></script>
      <script type="text/javascript" src="<?php echo base_url();?>matrix-tree-assets/js/main.js?ow3xdo"></script>
      <!----Matrix css and js end over here---->
      <style type="text/css">
         .row {
         margin-left: -15px !important;
         margin-right: -20px !important;
         }
         .navi ul.nav li a
         {
         font-size: 13px !important;
         font-weight: bold;
         }
      </style>
   </head>
   <body>
      <?php 
         $admin=getProfileInfo();
         //pr($admin);
         ?>
      <!-- Main navbar -->
      <div class="navbar navbar-inverse">
         <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo site_url();?>admin"><?php echo $admin->panel_title;?></a>
            <ul class="nav navbar-nav visible-xs-block">
               <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
               <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
         </div>
         <div class="navbar-collapse collapse" id="navbar-mobile">
            <ul class="nav navbar-nav">
               <li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-users4"></i>
                  <span class="visible-xs-inline-block position-right">New Member</span>
                  <span class="badge bg-warning-400">9</span>
                  </a>
                  <div class="dropdown-menu dropdown-content">
                     <div class="dropdown-content-heading">
                        New Member
                        <ul class="icons-list">
                           <li><a href="#"><i class="icon-sync"></i></a></li>
                        </ul>
                     </div>
                     <ul class="media-list dropdown-content-body width-350">
                        <li class="media">
                           <div class="media-left">
                              <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-user-check"></i></a>
                           </div>
                           <div class="media-body">
                              User Name
                              <div class="media-annotation">4 minutes ago</div>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-left">
                              <a href="#" class="btn border-warning text-warning btn-flat btn-rounded btn-icon btn-sm"><i class="icon-user-check"></i></a>
                           </div>
                           <div class="media-body">
                              User Name
                              <div class="media-annotation">36 minutes ago</div>
                           </div>
                        </li>
                     </ul>
                     <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="View All Registered Member"><i class="icon-menu display-block"></i></a>
                     </div>
                  </div>
               </li>
            </ul>
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown language-switch">
                  <a class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>admin_assetsimages/gb.png" class="position-left" alt="">
                  English
                  <span class="caret"></span>
                  </a>
                  <ul class="dropdown-menu">
                     <li><a class="deutsch"><img src="<?php echo base_url();?>admin_assets/images/de.png" alt=""> Deutsch</a></li>
                     <li><a class="ukrainian"><img src="<?php echo base_url();?>admin_assets/images/ua.png" alt=""> Українська</a></li>
                     <li><a class="english"><img src="<?php echo base_url();?>admin_assets/images/gb.png" alt=""> English</a></li>
                     <li><a class="espana"><img src="<?php echo base_url();?>admin_assets/images/es.png" alt=""> España</a></li>
                     <li><a class="russian"><img src="<?php echo base_url();?>admin_assets/images/ru.png" alt=""> Русский</a></li>
                  </ul>
               </li>
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-bubbles4"></i>
                  <span class="visible-xs-inline-block position-right">Support Ticket </span>
                  <span class="badge bg-warning-400">2</span>
                  </a>
                  <div class="dropdown-menu dropdown-content width-350">
                     <div class="dropdown-content-heading">
                        Support Ticket
                        <ul class="icons-list">
                           <li><a href="#"><i class="icon-compose"></i></a></li>
                        </ul>
                     </div>
                     <ul class="media-list dropdown-content-body">
                        <li class="media">
                           <div class="media-left">
                              <img src="<?php echo base_url();?>admin_assets/images/face10.jpg" class="img-circle img-sm" alt="">
                              <span class="badge bg-danger-400 media-badge">5</span>
                           </div>
                           <div class="media-body">
                              <a href="#" class="media-heading">
                              <span class="text-semibold">James Alexander</span>
                              <span class="media-annotation pull-right">04:58</span>
                              </a>
                              <span class="text-muted">who knows, maybe that would be the best thing for me...</span>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-left">
                              <img src="<?php echo base_url();?>admin_assets/images/face3.jpg" class="img-circle img-sm" alt="">
                              <span class="badge bg-danger-400 media-badge">4</span>
                           </div>
                           <div class="media-body">
                              <a href="#" class="media-heading">
                              <span class="text-semibold">Margo Baker</span>
                              <span class="media-annotation pull-right">12:16</span>
                              </a>
                              <span class="text-muted">That was something he was unable to do because...</span>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-left"><img src="<?php echo base_url();?>admin_assets/images/face24.jpg" class="img-circle img-sm" alt=""></div>
                           <div class="media-body">
                              <a href="#" class="media-heading">
                              <span class="text-semibold">Jeremy Victorino</span>
                              <span class="media-annotation pull-right">22:48</span>
                              </a>
                              <span class="text-muted">But that would be extremely strained and suspicious...</span>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-left"><img src="<?php echo base_url();?>admin_assets/images/face4.jpg" class="img-circle img-sm" alt=""></div>
                           <div class="media-body">
                              <a href="#" class="media-heading">
                              <span class="text-semibold">Beatrix Diaz</span>
                              <span class="media-annotation pull-right">Tue</span>
                              </a>
                              <span class="text-muted">What a strenuous career it is that I've chosen...</span>
                           </div>
                        </li>
                        <li class="media">
                           <div class="media-left"><img src="<?php echo base_url();?>admin_assets/images/face25.jpg" class="img-circle img-sm" alt=""></div>
                           <div class="media-body">
                              <a href="#" class="media-heading">
                              <span class="text-semibold">Richard Vango</span>
                              <span class="media-annotation pull-right">Mon</span>
                              </a>
                              <span class="text-muted">Other travelling salesmen live a life of luxury...</span>
                           </div>
                        </li>
                     </ul>
                     <div class="dropdown-content-footer">
                        <a href="#" data-popup="tooltip" title="View All Ticket"><i class="icon-menu display-block"></i></a>
                     </div>
                  </div>
               </li>
               <li class="dropdown dropdown-user">
                  <a class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>images/<?php echo $admin->image;?>" alt="">
                  <span><?php echo $admin->username;?></span>
                  <i class="caret"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                     <li><a href="<?php echo site_url();?>admin/account/profileManagement"><i class="icon-user-plus"></i> My profile</a></li>
                     <li><a href="<?php echo site_url();?>admin/AdminWallet/viewEwalletBalance"><i class="icon-coins"></i> My Wallet balance</a></li>
                     <li><a href="#"><span class="badge bg-teal-400 pull-right">58</span> <i class="icon-comment-discussion"></i> Messages</a></li>
                     <li class="divider"></li>
                     <li><a href="<?php echo site_url();?>admin/account/changePassword"><i class="icon-loop"></i> Change Password</a></li>
                     <li><a href="<?php echo site_url();?>admin/auth/logout"><i class="icon-switch2"></i> Logout</a></li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
      <!-- /main navbar -->
      <!-- Main sidebar -->
      <div class="app  aside-lg">
         <aside id="aside" class="app-aside hidden-xs bg-black">
            <?php 
               $this->load->view('common/sidebar');
               ?>
         </aside>
         <!-- /main sidebar -->
         <!-- / aside -->
         <!-- content -->
         <div id="content" class="app-content" role="main">
            <div class="app-content-body ">
               <!-- main header -->
               <div class="bg-light lter b-b wrapper-md">
                  <div class="row">
                     <div class="col-sm-12 col-xs-12">
                        <h1 class="m-n h3">Genealogy Tree</h1>
                     </div>
                     <!-- sreeram -->
                  </div>
               </div>
               <!-- / main header -->
               <!-- main content -->
               <div class="wrapper-md ">
            <!-- Horizontal form options -->
            <!-- content -->
            <div class="row">
               <div class="col-md-12">
                  <div class="region region-content">
                     <div id="block-system-main" class="block block-system clearfix">
                        <div class="binary-genealogy-tree stright-line">
                           <div class="binary-genealogy-level-0 clearfix">
                              <div class="parent-wrapper new_wrapper clearfix">
                                 <div class="node-centere-item binary-level-width-100">
                                    <div class="node-item-root main-member " >
                                       <div data-gid="2" class="binary-node-single-item user-block " id="user_block_12">
                                          <div class="images_wrapper">
                                             <a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($main_user_id);?>" width="70" height="70" alt="<?php echo $main_username;?>" title="<?php echo $main_username;?>" /></a>
                                          </div>
                                          <span class="wrap_content"> <a href="#"><?php echo $main_username;?></a></span>
                                       </div>
                                    </div>
                                    <div class="scroll_class parent-wrapper clearfix">
                                       <!---member start from here---->
                                       <?php 
                                          /////////////////////////////////////////////////////////////////////////
                                          if(!empty($level1_username1))
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left  node-child-root node-item-root">
                                             <div data-gid="3" class="binary-node-single-item user-block " id="user_block_<?php echo $level1_user_id1;?>">
                                                <div class="images_wrapper">
                                                   <a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id1);?>" width="70" height="70" alt="<?php echo $level1_username1;?>" title="<?php echo $level1_username1;?>" /></a>
                                                </div>
                                                <span class="wrap_content" ><a href="#"><?php echo $level1_username1;?></a></span>
                                                <div onclick="trigger_click(event.target,'<?php echo ID_encode($level1_user_id1);?>',this,'<?php echo site_url();?>admin/MyGenealogy/ajaxStage3Tree');" class="last_level_user">
                                                   <span class="add-genealogy-button"><i class="fa fa-plus fa-2x"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php    
                                          }
                                          else 
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left node-child-root node-item-root">
                                             <div class="binary-node-single-item user-block  user-7">
                                                <div class="images_wrapper"><a href="#"><img width="70" height="70" title="Add new member" alt="Add new member" src="<?php echo base_url();?>images/no-member.png" class="profile-rounded-image-small"></a></div>
                                                <span class="wrap_content"><a href="#">No Member</a></span>            
                                                <div  class="last_level_user add-new"> &nbsp;</div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php   
                                          }
                                          /////////////////////////////////////////////////////////////////////////
                                          if(!empty($level1_username2))
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left  node-child-root node-item-root">
                                             <div data-gid="3" class="binary-node-single-item user-block " id="user_block_<?php echo $level1_user_id2;?>">
                                                <div class="images_wrapper">
                                                   <a href="#"><img class="profile-rounded-image-small" src="<?php echo base_url();?>images/<?php echo get_user_rank_image($level1_user_id2);?>" width="70" height="70" alt="<?php echo $level1_username2;?>" title="<?php echo $level1_username2;?>" /></a>
                                                </div>
                                                <span class="wrap_content" ><a href="#"><?php echo $level1_username2;?></a></span>
                                                <div onclick="trigger_click(event.target,'<?php echo ID_encode($level1_user_id2);?>',this,'<?php echo site_url();?>admin/MyGenealogy/ajaxStage3Tree');" class="last_level_user">
                                                   <span class="add-genealogy-button"><i class="fa fa-plus fa-2x"></i></span>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php    
                                          }
                                          else 
                                          {
                                          ?>
                                       <div class="node-item-uid-569 node-left-item binary-level-width-50 node-item-uid-0">
                                          <span class="binary-hr-line binar-hr-line-left binary-hr-line-width-25"></span>
                                          <div class="node-item-1-child-left node-child-root node-item-root">
                                             <div class="binary-node-single-item user-block  user-7">
                                                <div class="images_wrapper"><a href="#"><img width="70" height="70" title="Add new member" alt="Add new member" src="<?php echo base_url();?>images/no-member.png" class="profile-rounded-image-small"></a></div>
                                                <span class="wrap_content"><a href="#">No Member</a></span>            
                                                <div  class="last_level_user add-new"> &nbsp;</div>
                                             </div>
                                          </div>
                                       </div>
                                       <?php   
                                          }
                                          ?>
                                       <!---member end over here---->
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <script>
                           //find the max width find the max widh
                           function max_width(){
                              w_max=0;
                              jQuery('.binary-genealogy-tree').each(function(){
                                 max_w_ele = jQuery(this).find('.last_level_user').parent().parent().width();
                                 n = jQuery(this).find('.last_level_user').length;
                                 max_w = max_w_ele*n;
                                if(w_max<max_w){
                                  w_max = max_w;
                                }
                              });
                              return w_max;
                           }
                            w = window.innerWidth
                           // jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.parent-wrapper').eq(0).css('width',window.innerWidth+'px');
                                  w1 = max_width();
                           
                                jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.scroll_class').css('width', 'auto');
                                      jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).children().css('overflow-x','hidden');
                                      jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).children().css('overflow-y','hidden');
                           
                                  if (w < w1) {
                                      jQuery('#block-system-main').css('width', w1+'px');
                                  } else {
                                    jQuery('#block-system-main').css('width', 'auto');
                                    jQuery('#block-system-main').css('overflow-x','hidden');
                           
                           
                                  }
                           
                                  //balance the tree
                                  max_val = 1;
                                  /*jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-item-root').each(function(){
                                      if(!jQuery(this).hasClass('main-member')){
                                         count = jQuery(this).find('.count-members').length;
                                         if(count > max_val){
                                           max_val = count;
                                         }
                                      }
                           
                                  });*/
                           
                                  /*jQuery('.binary-genealogy-tree').eq( jQuery('.binary-genealogy-tree').length -1).find('.node-item-root').each(function(){
                                      if(!jQuery(this).hasClass('main-member')){
                                         count = jQuery(this).find('.count-members').length;
                                         if(count < max_val){
                                           jQuery(this).append('<div class="last_level_user count-members">0</div>');
                                         }
                                      }
                           
                                  });*/
                           
                        </script>
                     </div>
                     <!-- /.block -->
                  </div>
               </div>
            </div>
            <!-- / content -->
            <?php
               $this->load->view("common/footer-text");
               ?>
            <!-- /footer -->
         </div>
         <!-- /content area -->
      </div>
<style type="text/css">
   .dropup .dropdown-menu, .navbar-fixed-bottom .dropdown .dropdown-menu 
   {
   margin-bottom: 0px;
   }
   .dropdown-menu>li 
   {
   margin-bottom: 0px;
   }
   .dropdown-menu 
   {
   padding: 0px 0;
   }
   .dropdown-menu>li>a 
   {
   padding: 7px 15px;
   }
   .badge
   {
   background-color: #FF7043;
   border-color: #FF7043;
   color: #fff;
   }
</style>	  