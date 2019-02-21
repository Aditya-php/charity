<!DOCTYPE html>
<html lang="en">
  <?php echo $this->load->view('common/header-script');?>
   <body>
      <?php 
      $admin=getProfileInfo();
      //pr($admin);
	  
	    $query_all_today_reg=$this->db->query("select username,user_id from user_registration where registration_date='".date('Y-m-d')."'");
		
		$counting=$query_all_today_reg->num_rows();
		
		$result_today=$query_all_today_reg->result_array();
		
		
		$query_all_open_tckt=$this->db->query("select a.*,b.username from support as a,user_registration as b where a.status='1' and a.user_id=b.user_id");
		
		$counting2=$query_all_open_tckt->num_rows();
		
		$result_open_tckt=$query_all_open_tckt->result_array();
		
	  
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
                  <span class="badge bg-warning-400"><?php echo $counting; ?></span>
                  </a>
                  <div class="dropdown-menu dropdown-content">
                     <div class="dropdown-content-heading">
                        New Member
                       
                     </div>
                     <ul class="media-list dropdown-content-body width-350">
					 <?php
					 foreach($result_today as $res)
					 {
					 ?>
                        <li class="media">
                           <div class="media-left">
                              <a href="#" class="btn border-primary text-primary btn-flat btn-rounded btn-icon btn-sm"><i class="icon-user-check"></i></a>
                           </div>
                           <div class="media-body">
                              <?php echo $res['user_id']; ?>
                              <div class="media-annotation"><?php echo $res['username']; ?></div>
                           </div>
                        </li>
                        <?php
						}
						?>
                     </ul>
                     <div class="dropdown-content-footer">
                        <a href="<?php echo site_url() ?>admin/member/viewAllMember" data-popup="tooltip" title="View All Registered Member"><i class="icon-menu display-block"></i></a>
                     </div>
                  </div>
               </li>
            </ul>
            <p class="navbar-text"><span class="label bg-success-400">Online</span></p>
            <ul class="nav navbar-nav navbar-right">
               
               <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="icon-bubbles4"></i>
                  <span class="visible-xs-inline-block position-right">Support Ticket </span>
                  <span class="badge bg-warning-400"><?php echo $counting2; ?></span>
                  </a>
                  <div class="dropdown-menu dropdown-content width-350">
                     <div class="dropdown-content-heading">
                       Support Ticket
                       
                     </div>
                     <ul class="media-list dropdown-content-body">
					 <?php
					 foreach($result_open_tckt as $res1)
					 {
					 ?>
                        <li class="media">
                           <!--<div class="media-left">
                              <img src="<?php echo base_url();?>admin_assets/images/face10.jpg" class="img-circle img-sm" alt="">
                              <span class="badge bg-danger-400 media-badge">5</span>
                           </div>-->
                           <div class="media-body">
                              <a href="#" class="media-heading">
                              <span class="text-semibold"><?php echo $res1['username']; ?></span>
                             
                              </a>
                              <span class="text-muted"><?php echo $res1['subject']; ?></span><br>
							  <span class="text-muted"><?php echo $res1['description']; ?></span>
                           </div>
                        </li>
                        
                        <?php
						}
						?>
                     </ul>
                     <div class="dropdown-content-footer">
                        <a href="<?php echo site_url(); ?>admin/SupportTicket/openTicket" data-popup="tooltip" title="View All Ticket"><i class="icon-menu display-block"></i></a>
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
      <!-- Page container -->
      <div class="page-container">
         <!-- Page content -->
         <div class="page-content">
            <!-- Main sidebar -->
            <?php 
            $this->load->view('common/sidebar');
            ?>
            <!-- /main sidebar -->
      