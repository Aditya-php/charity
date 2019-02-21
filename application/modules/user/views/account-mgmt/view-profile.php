<div class="content-wrapper">
				<!-- Page header -->
				<div class="page-header">
					<div class="page-header-content">
						<div class="page-title">
							<h4><i class="icon-arrow-left52 position-left"></i><span class="text-semibold">Account Management</span> - <?php echo $title;?></h4>
						</div>
					<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
					<div class="breadcrumb-line">
						<ul class="breadcrumb">
							<li><a href="<?php echo site_url();?>user"><i class="icon-home2 position-left"></i> Home</a></li>
							<li class="active">Account Management</li>
							<?php echo $breadcrumb;?>
						</ul>
						<ul class="breadcrumb"></ul>
						
					</div>
				</div>
               <!-- /page header -->
               <!-- Cover area -->
               <div class="profile-cover">
                  <div class="profile-cover-img" style="background-image: url(<?php echo base_url();?>images/cover2.jpg)"></div>
                  <div class="media">
                     <div class="media-left">
                        <a href="#" class="profile-thumb">
                        <?php
                        $profile_pic_old=(!empty($user_details->image))?$user_details->image:'';
                        if(!empty($profile_pic_old) && $profile_pic_old!='')
                        {
                        ?>
                        <img src="<?php echo base_url();?>images/<?php echo $profile_pic_old;?>" class="img-circle" alt="">
                        <?php
                        }
                        else
                        {
                        ?>
                        <img src="<?php echo base_url();?>images/face11.jpg" class="img-circle" alt="">
                        <?php
                        }
                        ?>
                        </a>
                     </div>
                     <div class="media-body">
                        <h1><?php echo $user_details->username; ?></h1>
                     </div>
                    
                  </div>
               </div>
               <!-- /cover area -->
               <!-- Toolbar -->
               <div class="navbar navbar-default navbar-xs content-group">
                  <ul class="nav navbar-nav visible-xs-block">
                     <li class="full-width text-center"><a data-toggle="collapse" data-target="#navbar-filter"><i class="icon-menu7"></i></a></li>
                  </ul>
                  <div class="navbar-collapse collapse" id="navbar-filter">
                     <ul class="nav navbar-nav element-active-slate-400">
                        <li class="active"><a href="#activity" data-toggle="tab"><i class="icon-menu7 position-left"></i> My Profile</a></li>
                        
                        <li><a href="#settings" data-toggle="tab"><i class="icon-cog3 position-left"></i> Update Profile</a></li>
                     </ul>
                    
                  </div>
               </div>
               <!-- /toolbar -->
               <!-- Content area -->
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
                  <!-- User profile -->
                  <div class="row">
                     <div class="col-lg-12">
                        <div class="tabbable">
                           <div class="tab-content">
                              <div class="tab-pane fade in active" id="activity">
                                 <!-- Timeline -->
                                	<div class="content-group">
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
                        echo $this->session->flashdata('flash_msg');
                        ?>
                        <div class="panel panel-body no-border-top no-border-radius-top table-responsive">												<h2>Personal Information</h2>							<table class='table table-striped table-bordered table-hover'>							<tr>							<td><b>Full Name :</b></td><td><?php echo $first_name.' '.$last_name;?></td>							</tr>							<tr>							<td><b>Email Id :</b></td><td><?php echo $email;?></td>							</tr>							<tr>							<td><b>Mobile No :</b></td><td><?php echo $contact_no;?></td>							</tr>							<tr>							<td><b>Gender :</b></td><td><?php echo $gender;?></td>							</tr>							<tr>							<td><b>Date Of Birth :</b></td><td><?php echo $date_of_birth;?></td>							</tr>							<tr>							<td><b>Address Line 1 :</b></td><td><?php echo $address_line1;?></td>							</tr>							<tr>							<td><b>Address Line 2 :</b></td><td><?php echo $address_line2;?></td>							</tr>							<tr>							<td><b>Zip Code :</b></td><td><?php echo $zip_code;?></td>							</tr>							<tr>							<td><b>Country :</b></td><td><?php echo $country;?></td>							</tr>							<tr>							<td><b>State :</b></td><td><?php echo $state;?></td>							</tr>							<tr>							<td><b>City :</b></td><td><?php echo $city;?></td>							</tr>														</table>														<h2>Bank Information</h2>							<table style='width:89%' class='table table-striped table-bordered table-hover'>							<tr>							<td><b>Bank Name :</b></td><td><?php echo $bank_name;?></td>							</tr>							<tr>							<td><b>Branch Name :</b></td><td><?php echo $branch_name;?></td>							</tr>							<tr>							<td><b>Account Holder Name :</b></td><td><?php echo $account_holder_name;?></td>							</tr>							<tr>							<td><b>Account No :</b></td><td><?php echo $account_no;?></td>							</tr>														</table>																											</div>
							</div>
                                 <!-- /timeline -->
                              </div>
                              
                              <div class="tab-pane fade" id="settings">
                                 <!-- Profile info -->
                                 <div class="panel panel-flat">
                                    <div class="panel-heading">
                                       <h6 class="panel-title">Personal information</h6>
                                       
                                    </div>
                                    <div class="panel-body">
                                       <form action="<?php echo site_url().'user/account/updatePersonalInformation'?>" method='post' enctype='multipart/form-data'>
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
                                                      
                                                      'South Africa'=>'South Africa'
                                                      );
                                                   ?>
                                                   <select name='country' class="select">
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
                                 <!-- /profile info -->
                                 <!-- Account settings -->
                                 <!--
                                 <div class="panel panel-flat">
                                    <div class="panel-heading">
                                       <h6 class="panel-title">Account settings</h6>
                                      
                                    </div>
                                    <div class="panel-body">
                                       <form action="#">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>New password</label>
                                                   <input type="password" placeholder="Enter new password" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Repeat password</label>
                                                   <input type="password" placeholder="Repeat new password" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Transaction password</label>
                                                   <input type="password" placeholder="Enter new password" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Repeat Transactin password</label>
                                                   <input type="password" placeholder="Repeat new password" class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn btn-primary">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>
                               -->
                                 <!-- /account settings -->
                                  <!-- Bank settings -->
                                 <div class="panel panel-flat">
                                    <div class="panel-heading">
                                       <h6 class="panel-title">Bank Detail Setting</h6>
                                      
                                    </div>
                                    <div class="panel-body">
                                       <form action="<?php echo site_url();?>user/account/updateBankInformation" method="post">
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
                                       <form action="<?php echo site_url();?>user/account/updateSocialMediaInformation" method="post">
                                          
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
                     </div>
                    
                  </div>
                  <!-- /user profile -->
                  <!-- Footer -->
                   <?php
                  $this->load->view("common/footer-text");
                  ?>

                  <!-- /footer -->
               </div>
				<!-- /content area -->
			</div>
<style>
button.btn.btn-default.btn-icon.kv-fileinput-upload{
	display: none;
}
.file-preview-old {
    /*border-radius: 2px;
    border: 1px solid #ddd;*/
    width: 100%;
    margin-bottom: 20px;
    position: relative;
}
</style>
<script>
  $(document).ready(function(){
  	$(".file-caption-name").text("No Profile Pic Selected");
  });//end ready
</script>