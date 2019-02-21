<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Member Management</span> - Edit Profile</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-btn-group">
               <a href="<?php echo site_url();?>admin/member/viewAllMember" class="btn btn-success"><i class="icon-arrow-left52 position-left"></i> Back</a>
            </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Members</a></li>
            <li class="active">Edit Profile</li>
         </ul>
         <ul class="breadcrumb-elements">
            <li><a href="#"><i class="icon-comment-discussion position-left"></i> Support</a></li>
            <li class="dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown">
               <i class="icon-gear position-left"></i>
               Settings
               <span class="caret"></span>
               </a>
               <ul class="dropdown-menu dropdown-menu-right">
                  <li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>
                  <li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>
                  <li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>
                  <li class="divider"></li>
                  <li><a href="#"><i class="icon-gear"></i> Edit Profile</a></li>
               </ul>
            </li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <?php 
      if(!empty($this->session->flashdata('flash_msg')))
      {
      ?>
      <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
         <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
         <?php echo $this->session->flashdata('flash_msg');?>
      </div>
      <?php    
      }
      ?>
      <div class="panel panel-flat">
         <div class="panel-heading">
            <h5 class="panel-title">Edit Profile</h5>
         </div>
         <?php 
            //////////////Personal information////////////////////
            $first_name=(!empty($user_details->first_name))?$user_details->first_name:'';
            $last_name=(!empty($user_details->last_name))?$user_details->last_name:'';
            $email=(!empty($user_details->email))?$user_details->email:'';
            $contact_no=(!empty($user_details->contact_no))?$user_details->contact_no:'';
            $gender=(!empty($user_details->gender=='1'))?'Male':'Female';
            if(!empty($user_details->date_of_birth))
            {
               $date_of_birth=date(date_formats(),strtotime($user_details->date_of_birth));
            }
            else
            {
               $date_of_birth='';
            }
            $address_line1=(!empty($user_details->address_line1))?$user_details->address_line1:'';
            $address_line2=(!empty($user_details->address_line2))?$user_details->address_line2:'';
            $country=(!empty($user_details->country))?$user_details->country:'';
            $state=(!empty($user_details->state))?$user_details->state:'';
            $city=(!empty($user_details->city))?$user_details->city:'';
            $zip_code=(!empty($user_details->zip_code))?$user_details->zip_code:'';
            
            /////////Account information//////
            $bank_name=(!empty($user_details->bank_name))?$user_details->bank_name:'';
            $branch_name=(!empty($user_details->branch_name))?$user_details->branch_name:'';
            $account_holder_name=(!empty($user_details->account_holder_name))?$user_details->account_holder_name:'';
            $account_no=(!empty($user_details->account_no))?$user_details->account_no:'';
            ////////Social Media Information//////////
            $facebook_link=(!empty($user_details->facebook_link))?$user_details->facebook_link:'';
            $twitter_link=(!empty($user_details->twitter_link))?$user_details->twitter_link:'';
            $linkedin_link=(!empty($user_details->linkedin_link))?$user_details->linkedin_link:'';
            $google_plus_link=(!empty($user_details->google_plus_link))?$user_details->google_plus_link:'';
            //echo $this->session->flashdata('flash_msg');
            ?>
         <div class="panel-body">
            <div class="row">
               <div class="panel panel-flat">
                                    <div class="panel-heading">
                                       <h6 class="panel-title">Personal information</h6>
                                       
                                    </div>
                                    <div class="panel-body">
                                       <form action="<?php echo site_url();?>admin/member/updatePersonalInformation/<?php echo ID_encode($user_id);?>" method='post' enctype='multipart/form-data'>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>First Name</label>
                                                   <input type="text" name='first_name' value="<?php echo $first_name;?>" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Last Name</label>
                                                   <input type="text" name="last_name" value="<?php echo $last_name;?>" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Address line 1</label>
                                                   <input type="text" name="address_line1" value="<?php echo $address_line1;?>" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Address line 2</label>
                                                   <input type="text" name="address_line2" value="<?php echo $address_line2;?>" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-4">
                                                   <label>City</label>
                                                   <input type="text" name="city" value="<?php echo $city;?>" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                   <label>State/Province</label>
                                                   <input type="text" name="state" value="<?php echo $state;?>" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                   <label>ZIP code</label>
                                                   <input type="text" name="zip_code" value="<?php echo $zip_code;?>" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Email</label>
                                                   <input type="text" name="email" value="<?php echo $email;?>" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Your country</label>
                                                   <?php 
                                                   $country_array=array(
                                                      'Germany'=>'germany',
                                                      'France'=>'france',
                                                      'Spain'=>'germany',
                                                      'Netherlands'=>'netherlands',
                                                      'United Kingdom'=>'uk'
                                                      );
                                                   ?>
                                                   <select name='country' class="form-control">
                                                      <?php 
                                                      foreach ($country_array as $key => $value) 
                                                      {
                                                         if($value==$country)
                                                         {
                                                      ?>
                                                      <option value="<?php echo $value;?>" selected="selected"><?php echo $key;?></option>
                                                      <?php       
                                                         }
                                                         else 
                                                         {
                                                      ?>
                                                      <option value="<?php echo $value;?>"><?php echo $key;?></option>
                                                      <?php       
                                                         }
                                                      }
                                                      ?>
                                                   </select>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Phone #</label>
                                                   <input type="text" name="contact_no" value="<?php echo $contact_no;?>" class="form-control">
                                                   <span class="help-block">+99-99-9999-9999</span>
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Upload profile image</label>
                                                   <input type='hidden' name='profile_pic_old' value='<?php echo $profile_pic_old;?>'>
                                                   <input type="file" name='profile_pic' class="file-styled">
                                                   <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                                </div>
                                             </div>
                                          </div>
                                          <div class="text-right">
                                             <button type="submit" class="btn btn-primary">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- Bank settings -->
                                 <div class="panel panel-flat">
                                    <div class="panel-heading">
                                       <h6 class="panel-title">Bank Detail Setting</h6>
                                    </div>
                                    <div class="panel-body">
                                       <form action="<?php echo site_url();?>admin/member/updateBankInformation/<?php echo ID_encode($user_id);?>" method="post">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Bank Name</label>
                                                   <input type="text" name="bank_name" value="<?php echo $bank_name;?>" placeholder="Bank Name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Branch Name</label>
                                                   <input type="text" name="branch_name" value="<?php echo $branch_name;?>" placeholder="Branch Name" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Account Holder Name</label>
                                                   <input type="text" name="account_holder_name" value="<?php echo $account_holder_name;?>" placeholder="Account Holder Name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Account No</label>
                                                   <input type="text" name="account_no" value="<?php echo $account_no;?>" placeholder="Account No." class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn btn-primary">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /Bank Detail settings -->
                 <!-- Bank settings -->
                                 <div class="panel panel-flat">
                                    <div class="panel-heading">
                                       <h6 class="panel-title">Social Media Setting</h6>
                                      
                                    </div>
                                    <div class="panel-body">
                                       <form action="<?php echo site_url();?>admin/member/updateSocialMediaInformation/<?php echo ID_encode($user_id);?>" method="post">
                                          
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Facebook Link</label>
                                                   <input type="text" name="facebook_link" value="<?php echo $facebook_link;?>" placeholder="Facebook Link" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Twitter Link</label>
                                                   <input type="text" name="twitter_link" value="<?php echo $twitter_link;?>" placeholder="Twitter Link" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Linked In</label>
                                                   <input type="text" name="linkedin_link" value="<?php echo $linkedin_link;?>" placeholder="Linkedin Link" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Google+</label>
                                                   <input type="text" name="google_plus_link" value="<?php echo $google_plus_link;?>" placeholder="Google Plus Link" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn btn-primary">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                                 <!-- /Bank Detail settings -->
            </div>
         </div>
      </div>
      <!-- Footer -->
      <?php $this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /content wrapper -->