<!-- Main content -->
<div class="content-wrapper">
<!-- Page header -->
<div class="page-header">
   <div class="page-header-content">
      <div class="page-title">
         <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> - Dashboard</h4>
      </div>
   </div>
   <div class="breadcrumb-line">
      <ul class="breadcrumb">
         <li><a href="<?php echo site_url();?>user/"><i class="icon-home2 position-left"></i> Home</a></li>
         <li class="active">Dashboard</li>
      </ul>
   </div>
</div>
<!-- /page header -->
<!-- Content area -->
<div class="content">
    
    <div class="row">
       
    </div>
<!-- Main charts -->



<!--<div class="row">
   <div class="col-sm-6 col-md-6">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">Welcome Bonus</h6>
               <span class="text-muted"><?php echo currency()." ".$welcome_bonus;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
   
   <div class="col-sm-6 col-md-6">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">Direct Commission</h6>
               <span class="text-muted"><?php echo currency()." ".$total_direct_commission;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
   </div>--->
   <div class="row">
   
  <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">Matrix Commission</h6>
               <span class="text-muted"><?php echo currency()." ".$total_matrix_commission;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
   
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">Stage Complete Commission</h6>
               <span class="text-muted"><?php echo currency()." ".$TotalMatrixCompleteCommission;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
   
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-blue-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-body">
               <h6 class="no-margin text-semibold">Gross Commission</h6>
               <span class="text-muted"><?php echo currency()." ".$total_commission;?></span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-coins icon-2x"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-6 col-md-6">
      <div class="panel panel-body bg-success-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-left media-middle">
               <i class="icon-users4 icon-2x"></i>
            </div>
            <div class="media-body">
               <h6 class="no-margin text-semibold">My Team Member</h6>
               <span class="text-muted"><?php echo $total_team_member;?></span>
            </div>
         </div>
         <div class="progress progress-micro mb-10 bg-success">
            <div class="progress-bar bg-white" style="width: 100%">
               <span class="sr-only">100% Complete</span>
            </div>
         </div>
         <span class="pull-right">Direct Member : <?php echo $total_direct_member;?></span>
         Team Member : <?php echo $total_team_member;?>
      </div>
   </div>
   <div class="col-sm-6 col-md-6">
      <div class="panel panel-body bg-indigo-400 has-bg-image">
         <div class="media no-margin-top content-group">
            <div class="media-left media-middle">
               <i class="icon-pulse2 icon-2x"></i>
            </div>
            <div class="media-body">
               <h6 class="no-margin text-semibold">My CURRENT STAGE</h6>
               <span class="text-muted">
                  <?php
                  if(empty($rank_name) || $rank_name==Null)
                  {
                     echo "No Rank";
                  }
                  else 
                  {
                     echo $rank_name;
                  }
                  ?>
               </span>
            </div>
         </div>
         <div class="progress progress-micro mb-10 bg-indigo">
            <div class="progress-bar bg-white" style="width: 100%">
               <span class="sr-only">80% Complete</span>
            </div>
         </div>
         <span class="pull-right"> </span>
         <?php 
         if(empty($rank_name) || $rank_name==Null)
         {
         ?>
         You have not achieved any rank
         <?php    
         }
         else 
         {
         ?>
         You have achieved <?php echo $rank_name;?> rank
         <?php    
         }
         ?>
      </div>
   </div>
</div>
<!-- /inside tabs -->
<!--Wallet Balance -->
<div class="row">
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-danger-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-body">
               <h3 class="no-margin"><?php echo currency()." ".$ewallet_balance;?></h3>
               <span class="text-uppercase text-size-mini">My Wallet Balance</span>
            </div>
            <div class="media-right media-middle">
               <i class="icon-wallet icon-3x opacity-75"></i>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-warning-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-left media-middle">
               <i class="icon-pointer icon-3x opacity-75"></i>
            </div>
            <div class="media-body text-right">
               <h3 class="no-margin"><?php echo currency()." ".$payout_in_process;?></h3>
               <span class="text-uppercase text-size-mini">Payout in Process</span>
            </div>
         </div>
      </div>
   </div>
   <div class="col-sm-6 col-md-4">
      <div class="panel panel-body bg-pink-400 has-bg-image">
         <div class="media no-margin">
            <div class="media-left media-middle">
               <i class="icon-enter6 icon-3x opacity-75"></i>
            </div>
            <div class="media-body text-right">
               <h3 class="no-margin"><?php echo currency()." ".$payout_success;?></h3>
               <span class="text-uppercase text-size-mini">Payout Success</span>
            </div>
         </div>
      </div>
   </div>
</div>
<!--Wallet Balance -->
<!--my profile -->
<div class="row">
   <div class="col-sm-6 col-lg-6">
      <!-- User details (with sample pattern) -->
      <div class="content-group">
         <div class="panel-body bg-blue border-radius-top text-center" style="background-image: url(images/bg.png); background-size: contain;">
            <div class="content-group-sm">
               <h5 class="text-semibold no-margin-bottom">
                  My Profile
               </h5>
               <h5 class="text-semibold no-margin-bottom">
                  <?php echo $user_details->username ;?>
               </h5>
               <span class="display-block">My User Id : <?php echo $user_details->user_id;?></span>
            </div>
            <a href="#" class="display-inline-block content-group-sm">
            <?php 
			if(!empty($user_details->image))
			{
			?>
			<img src="<?php echo base_url();?>images/<?php echo $user_details->image;?>" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
			<?php
			}
			else 
			{
			?>
			<img src="<?php echo base_url();?>images/face6.jpg" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
			<?php 
			}
			?>
            </a>
            <ul class="list-inline no-margin-bottom">
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-phone"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-bubbles4"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-envelop4"></i></a></li>
            </ul>
         </div>

         <div class="panel panel-body no-border-top no-border-radius-top">
            <div class="form-group mt-5">
               <label class="text-semibold">Full name:</label>
               <span class="pull-right-sm"><?php echo $user_details->username;?></span>
            </div>
            <div class="form-group">
               <label class="text-semibold">Phone number:</label>
               <span class="pull-right-sm"><?php echo $user_details->contact_no;?></span>
            </div>
            <div class="form-group no-margin-bottom">
               <label class="text-semibold">Personal Email:</label>
               <span class="pull-right-sm"><a href="#"><?php echo $user_details->email;?></a></span>
            </div>
         </div>
      </div>
      <!-- /user details (with sample pattern) -->
   </div>
   <div class="col-sm-6 col-lg-6">
      <!-- User details (with sample pattern) -->
      <div class="content-group">
         <div class="panel-body bg-blue border-radius-top text-center" style="background-image: url(images/bg.png); background-size: contain;">
            <div class="content-group-sm">
               <h5 class="text-semibold no-margin-bottom">
                  My Sponsor Detail
               </h5>
               <h5 class="text-semibold no-margin-bottom">
                  <?php echo (!empty($sponsor_details->username))?$sponsor_details->username:'none';?>
               </h5>
               <span class="display-block">Sponsor User Id : <?php echo (!empty($sponsor_details->user_id))?$sponsor_details->user_id:'none';?></span>
            </div>
            <a href="#" class="display-inline-block content-group-sm">
            <?php 
			if(!empty($sponsor_details->image))
			{
			?>
			<img src="<?php echo base_url();?>images/<?php echo $sponsor_details->image;?>" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
			<?php 
			}
			else 
			{
			?>
			<img src="<?php echo base_url();?>images/face6.jpg" class="img-circle img-responsive" alt="" style="width: 120px; height: 120px;">
			<?php
			}
			?>
            </a>
            <ul class="list-inline no-margin-bottom">
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-phone"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-bubbles4"></i></a></li>
               <li><a href="#" class="btn bg-blue-700 btn-rounded btn-icon"><i class="icon-envelop4"></i></a></li>
            </ul>
         </div>
         <div class="panel panel-body no-border-top no-border-radius-top">
            <div class="form-group mt-5">
               <label class="text-semibold">Full name:</label>
               <span class="pull-right-sm"><?php echo (!empty($sponsor_details->username))?$sponsor_details->username:'none';?></span>
            </div>
            <div class="form-group">
               <label class="text-semibold">Phone number:</label>
               <span class="pull-right-sm"><?php echo (!empty($sponsor_details->contact_no))?$sponsor_details->contact_no:'none';?></span>
            </div>
            <div class="form-group no-margin-bottom">
               <label class="text-semibold">Personal Email:</label>
               <span class="pull-right-sm"><a href="#"><?php echo (!empty($sponsor_details->email))? $sponsor_details->email:'none';?></a></span>
            </div>
         </div>
         
       
      </div>
       
      <!-- /user details (with sample pattern) -->
   </div>
    <div class="row">
            <div class="container">
                
            </div>
         </div>
</div>
<!--My profile-->

<?php
  $this->load->view("common/footer-text");
?>
<!-- /footer -->
</div>
<!-- /content area -->
</div>