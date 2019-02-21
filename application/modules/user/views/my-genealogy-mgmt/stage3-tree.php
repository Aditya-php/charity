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
      <!-- Main navbar -->
      <div class="navbar navbar-inverse">
         <div class="navbar-header">
            <?php 
               $user=getUserProfileInfo() ;
               ?>
            <a class="navbar-brand" href="<?php echo site_url();?>user/">
               <!-- <img src="<?php echo base_url();?>admin_assets/assets/images/logo_light.png" alt=""></a>-->
               <?php echo $user->panel_title;?>
               <ul class="nav navbar-nav visible-xs-block">
                  <li>
            <a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
            <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
            </ul>
         </div>
         <div class="navbar-collapse collapse" id="navbar-mobile">
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
            <ul class="nav navbar-nav navbar-right">
               <li class="dropdown dropdown-user">
                  <a class="dropdown-toggle" data-toggle="dropdown">
                  <img src="<?php echo base_url();?>images/<?php echo $user->image;?>" alt="">
                  <span> <?php echo $user->username;?></span>
                  <i class="caret"></i>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-right">
                     <li><a href="<?php echo site_url();?>user/account/profileManagement"><i class="icon-user-plus"></i> My profile</a></li>
                     <li class="divider"></li>
                     <li><a href="<?php echo site_url();?>user/auth/logout"><i class="icon-switch2"></i> Logout</a></li>
                  </ul>
               </li>
            </ul>
         </div>
      </div>
      <!-- /main navbar -->
      <div class="app      aside-lg">
      <!-- header -->
      <!-- / header -->
      <!-- aside -->
      <?php 
         $this->load->view('common/sidebar');
         
         ?> 
      <!-- / aside -->
      <!-- content -->
      <div id="content" class="app-content" role="main">
      <div class="app-content-body ">
      <div class="hbox hbox-auto-xs hbox-auto-sm">
      <div class="col">
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
                                                <div onclick="trigger_click(event.target,'<?php echo ID_encode($level1_user_id1);?>',this,'<?php echo site_url();?>user/MyGenealogy/ajaxStage3Tree');" class="last_level_user">
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
                                                <div onclick="trigger_click(event.target,'<?php echo ID_encode($level1_user_id2);?>',this,'<?php echo site_url();?>user/MyGenealogy/ajaxStage3Tree');" class="last_level_user">
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