<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>User Panel</title>
	<!-- Global stylesheets -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/icons/icomoon/styles.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/minified/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/minified/core.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/minified/components.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo base_url();?>admin_assets/assets/css/minified/colors.min.css" rel="stylesheet" type="text/css">
	<!-- /global stylesheets -->
	<!-- Core JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/loaders/pace.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/libraries/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/libraries/bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/loaders/blockui.min.js"></script>
	<!-- /core JS files -->

	<!-- Theme JS files -->
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/forms/wizards/steps.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/forms/selects/select2.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/forms/styling/uniform.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/libraries/jasny_bootstrap.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/forms/validation/validate.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/plugins/extensions/cookie.js"></script>

	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/core/app.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>admin_assets/assets/js/pages/wizard_steps.js"></script>
	<!-- /theme JS files -->

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
      <?php echo $user->panel_title;;?>

      <ul class="nav navbar-nav visible-xs-block">
        <li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
        <li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
      </ul>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
     

      <p class="navbar-text"><span class="label bg-success-400">Online</span></p>

      <ul class="nav navbar-nav navbar-right">
       

        

        <li class="dropdown dropdown-user">
          <a class="dropdown-toggle" data-toggle="dropdown">
            <img src="<?php echo base_url();?>images/<?php echo (!empty($user->image))?$user->image:'user-small.png';?>" alt="">
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


	<!-- Page container -->
	<div class="page-container">

		<!-- Page content -->
		<div class="page-content">

			<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<!-- /user menu -->


					<!-- Main navigation -->
					<?php 
		      		echo $this->load->view("common/sidebar.php");
		      		?>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->
			<!-- Main content -->
			<div class="content-wrapper">
				<!-- Page header -->
				<!-- /page header -->
				<!-- Content area -->
				<div class="content">
					<!-- Basic setup -->
		            <div class="panel panel-white">
						<div class="panel-heading">
							<h6 class="panel-title">Register New Member</h6>
							<div class="heading-elements">
								<ul class="icons-list">
			                		<li><a data-action="collapse"></a></li>
			                		<li><a data-action="reload"></a></li>
			                		<li><a data-action="close"></a></li>
			                	</ul>
		                	</div>
						</div>
	                	<?php 
	                	//account information
	                	$platform=(!empty($account_info['platform']))?$account_info['platform']:Null;
	                	$binary_pos=(!empty($account_info['binary_pos']))?$account_info['binary_pos']:Null;
	                	$username=(!empty($account_info['username']))?$account_info['username']:Null;
	                	$password=(!empty($account_info['password']))?$account_info['password']:Null;
	                	$t_code=(!empty($account_info['t_code']))?$account_info['t_code']:Null;
	                	//////Personal informtaion
	                	$first_name=(!empty($personal_info['first_name']))?$personal_info['first_name']:Null;
	                	$last_name=(!empty($personal_info['last_name']))?$personal_info['last_name']:Null;
	                	$email=(!empty($personal_info['email']))?$personal_info['email']:Null;
	                	$contact_no=(!empty($personal_info['contact_no']))?$personal_info['contact_no']:Null;
	                	$country=(!empty($personal_info['country']))?$personal_info['country']:Null;
	                	$state=(!empty($personal_info['state']))?$personal_info['state']:Null;
	                	$city=(!empty($personal_info['city']))?$personal_info['city']:Null;
	                	$zip_code=(!empty($personal_info['zip_code']))?$personal_info['zip_code']:Null;
	                	$address_line1=(!empty($personal_info['address_line1']))?$personal_info['address_line1']:Null;
	                	//////Bank accoun information
	                	$account_no=(!empty($bank_account_info['account_no']))?$bank_account_info['account_no']:Null;
	                	$bank_name=(!empty($bank_account_info['bank_name']))?$bank_account_info['bank_name']:Null;
	                	$branch_name=(!empty($bank_account_info['branch_name']))?$bank_account_info['branch_name']:Null;
	                	$ifsc_code=(!empty($bank_account_info['ifsc_code']))?$bank_account_info['ifsc_code']:Null;
	                	$account_holder_name=(!empty($bank_account_info['account_holder_name']))?$bank_account_info['account_holder_name']:Null;

	                	?>
	                	<form class="steps-basic" action="<?php echo site_url();?>user/register/addNewMember" method="post" id="register_form" enctype="multipart/form-data">
							<h6>Sponsor and Account Information</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Sponsor Username:</label>
											 <input type="text" value="<?php echo $sponsor_username;?>" disabled class="form-control" placeholder="Sponsor Username">
											 <input type="hidden" value="<?php echo $sponsor_username;?>" name="sponsor_id" id="sponsor_id">
										</div>
									</div>

									<div class="col-md-6">
										<div class="form-group">
											<label>Select  Package:</label>
											<select name="platform" id="platform" data-placeholder="Select Package" class="select">
												<option></option>
												<optgroup label="Select Package">
													<?php 
													if(!empty($all_active_package) && count($all_active_package))
													{
														foreach ($all_active_package as $package) 
														{
															if($platform==$package->id)
															{
													?>
													<option selected value="<?php echo $package->id;?>"><?php echo $package->title." (".$package->amount.currency().")" ?></option>
													<?php 			
															}
															else
															{
													?>
													<option value="<?php echo $package->id;?>"><?php echo $package->title." (".$package->amount.currency().")" ?></option>
													<?php 			
															}
														}
													}
													?>
												</optgroup>
											</select>
											<span id="valid_platform" style="font-weight:bold;color:red;display:none"></span>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Username:</label>
											<input type="text" value="<?php echo $username;?>" name="username" id="username" class="form-control" onblur="check_username(this.value)" placeholder="Username">
											<span class="valid_username" id="valid_username" style="color:red;font-weight:bold"></span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Password:</label>
											<input type="password" value="<?php echo $password;?>" name="password" id="password" class="form-control" placeholder="Password">
											<span id="valid_password" style="font-weight:bold;color:red;;display:none"></span>
										</div>
									</div>									
								</div>

								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Confirm Password:</label>
											<input type="password" value="<?php echo $password;?>" name="confirm_password" id="confirm_password" class="form-control" placeholder="Confirm Password">
											<span id="valid_confirm_password" style="font-weight:bold;color:red;;display:none"></span>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Transaction Password:</label>
											<input type="password" value="<?php echo $t_code;?>" name="t_code" id="t_code" class="form-control" placeholder="Password">
											<span id="valid_t_code" style="font-weight:bold;color:red;;display:none"></span>
										</div>
									</div>

								</div>
								<div class="row">
									
									<div class="col-md-6">
										<div class="form-group">
											<label>Confirm Transaction Password:</label>
											<input type="password" value="<?php echo $t_code;?>" name="confirm_t_code" id="confirm_t_code" class="form-control" placeholder="Confirm Transaction Password">
											<span id="valid_confirm_t_code" style="font-weight:bold;color:red;;display:none"></span>
										</div>
									</div>


								</div>
							</fieldset>

							<h6>PERSONAL INFORMATION</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>First Name:</label>
			                                <input type="text" value="<?php echo $first_name;?>" name="first_name" id="first_name" placeholder="First Name" class="form-control">
		                                </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Last Name:</label>
			                                <input type="text" value="<?php echo $last_name;?>" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
		                                </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Email:</label>
			                                <input type="text" value="<?php echo $email;?>" name="email" id="email" placeholder="Email" class="form-control">
		                                </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Mobile:</label>
			                                <input type="text" value="<?php echo $contact_no;?>" name="contact_no" id="contact_no" placeholder="Contact Number" class="form-control">
		                                </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Country:</label>
			                                <?php $all_country=array('india','germany','pak','aus','us','uk');?>
			                                <select name="country" id="country" data-placeholder="Select Country" class="select">
												<option></option>
												<optgroup label="Select Country">
													<?php 
													foreach ($all_country as $count) 
													{
													   if($count==$country)
													   {
													?>
													<option selected value="<?php echo $count;?>"><?php echo ucfirst($count);?></option>
													<?php    	
													   }
													   else
													   {
													?>
													<option value="<?php echo $count;?>"><?php echo ucfirst($count);?></option>
													<?php    	
													   }
													}
													?>
												</optgroup>
											</select>
		                                </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>State:</label>
			                                <input type="text" value="<?php echo $state;?>" name="state" id="state" placeholder="State" class="form-control">
		                                </div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>City:</label>
			                                <input type="text" value="<?php echo $city;?>" name="city" id="city" placeholder="City" class="form-control">
		                                </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Zip Code:</label>
			                                <input type="text" value="<?php echo $zip_code;?>" name="zip_code" id="zip_code" placeholder="Zip Code" class="form-control">
		                                </div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Address:</label>
			                                <input type="text" value="<?php echo $address_line1;?>" name="address_line1" id="address_line1" placeholder="Address" class="form-control">
		                                </div>
									</div>
								</div>
	
							</fieldset>

							<h6>Bank Account Information</h6>
							<fieldset>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Account Number:</label>
			                                <input type="text" value="<?php echo $account_no;?>" name="account_no" id="account_no" placeholder="Account Number" class="form-control">
		                                </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Branch Name:</label>
			                                <input type="text" value="<?php echo $branch_name;?>" name="branch_name" id="branch_name" placeholder="Branch Name" class="form-control">
		                                </div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Bank Name:</label>
			                                <input type="text" value="<?php echo $bank_name;?>" name="bank_name" id="bank_name" placeholder="Bank Name" class="form-control">
		                                </div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Ifsc Code:</label>
			                                <input type="text" value="<?php echo $ifsc_code;?>" name="ifsc_code" id="ifsc_code" placeholder="Ifsc Code" class="form-control">
		                                </div>
									</div>
								</div>
								

								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Account Holder Name:</label>
			                                <input type="text" value="<?php echo $account_holder_name;?>" name="account_holder_name" id="account_holder_name" placeholder="Account Holder Name" class="form-control">
		                                </div>
									</div>
								</div>
							</fieldset>

							<h6>Payment Method</h6>
							<fieldset>
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<label>Select Payment Method:</label>
			                                <select name="registration_method" id="registration_method" data-placeholder="Registration Method" class="select">
												<option></option>
												<optgroup label="Registration Method">
													<?php 
													foreach ($register_method as $method) 
													{
													?>
													<option value="<?php echo $method->id;?>"><?php echo $method->reg_method;?></option>
													<?php
													}
													?>
												</optgroup>
											</select>
											<span class="valid_registration_method" id="valid_registration_method" style="color:red;font-weight:bold;"></span>
		                                </div>
									</div>
									<div id="selected_payment_method">
										
									</div>
								</div>
							</fieldset>
                           
                           
						</form>
		            </div>
		            <!-- /basic setup -->


		            <!-- Wizard with validation -->
		           
		            <!-- /wizard with validation -->


		            <!-- Saving state -->
		            
		            <!-- /saving state -->


		            <!-- Starting step -->
		           
		            <!-- /starting step -->


		            <!-- Remote content source -->
		            <!-- /remote content source -->


					<!-- Footer -->
					<?php 
					$this->load->view('common/footer-text');
					?>
					<!-- /footer -->

				</div>
				<!-- /content area -->

			</div>
			<!-- /main content -->

		</div>
		<!-- /page content -->

	</div>
	<!-- /page container -->

</body>
</html>
<script type="text/javascript">
$(document).ready(function(){
  	    
   $("a[href=#next],[href=#finish]").click(function(){
   	    var cls=new Array();
	  	var index=0;
	  	$("li[role=tab]").each(function(){
	  		cls[index]=$(this).attr('class');
	  		index++;
	  	});//end each
	  	var str=cls[0]+cls[1]+cls[2]+cls[3];
	  	//console.log(str);
	  	if(str=='first donecurrentdisableddisabled last' || str=='first donecurrentdonelast done')
	  	{
	  		//sponsor and user account information
	  		var sponsor_id=$("#sponsor_id").val();
	  		var platform=$("#platform").val();
	  		var binary_pos=$("#binary_pos").val();
	  		var username=$("#username").val();
	  		var password=$("#password").val();
	  		var t_code=$("#t_code").val();
	  		/////validation start from here
	  		if(platform=='')
	  		{
	  			$("#valid_platform").css('display','').text('Please Select Package!');
	  			return false;
	  		}
	  		/////validation end over here
	  		jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>user/register/saveAccountInformation/',
               data: {platform:platform,binary_pos:binary_pos,username:username,password:password,t_code:t_code},
               success:function(res)
               {
               }//end success
          });//end ajax   

	  	}
	  	else if(str=='first donedonecurrentdisabled last' || str=='first donedonecurrentlast done')
	  	{
	  		//personal information
	  		var first_name=$("#first_name").val();
	  		var last_name=$("#last_name").val();
	  		var email=$("#email").val();
	  		var contact_no=$("#contact_no").val();
	  		var country=$("#country").val();
	  		var state=$("#state").val();
	  		var city=$("#city").val();
	  		var zip_code=$("#zip_code").val();
	  		var address_line1=$("#address_line1").val();
	  		jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>user/register/savePersonalInformation/',
               data: {first_name:first_name,last_name:last_name,email:email,contact_no:contact_no,country:country,state:state,city:city,zip_code:zip_code,address_line1:address_line1},
               success:function(res)
               {
               }//end success
          });//end ajax   
	  	}
	  	else if(str=='first donedonedonelast current')
	  	{
	  		//bank account information
	  		var account_no=$("#account_no").val();
	  		var branch_name=$("#branch_name").val();
	  		var bank_name=$("#bank_name").val();
	  		var ifsc_code=$("#ifsc_code").val();
	  		var account_holder_name=$("#account_holder_name").val();
	  		jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>user/register/saveBankAccountInformation/',
               data: {account_no:account_no,branch_name:branch_name,bank_name:bank_name,ifsc_code:ifsc_code,account_holder_name:account_holder_name},
               success:function(res)
               {
               }//end success
          });//end ajax   

	  	}
	  	else if(str=='first donedonedonelast current done')
	  	{
	  		//payment information
	  				
	  	}
   });//end next button click

	$("a[href=#finish]").click(function(){
		var registration_method=$("#registration_method").val();
		if(registration_method=="")
		{
			$("#valid_registration_method").text('please select anyone registration method!');
			return false;
		}
		if($("#bank_wired_proof").val()!='undefined' && $("#bank_wired_proof").val()=='')
		{
			$("#valid_bank_wired_proof").css('display','');
			return false;
		}

		if($("#epin").val()!='undefined' && $("#epin").val()=='')
		{
			$("#valid_epin").css('display','');
			return false;
		}

        if($("#transaction_password").val()!='undefined' && $("#transaction_password").val()=='')
		{
			$("#valid_transaction_password").css('display','').text('Please Enter Transaction Password!');
			return false;
		}
		if(typeof $("#epin").val()!='undefined' && $("#epin").val()!='')
		{
			var epin_code=$("#epin").val();
			var bool=true;
			jQuery.ajax({
		               type:'POST',
		               async:false,
		               url:'<?php echo site_url();?>user/register/isEpinValid/',
		               data: {epin_code:epin_code},
		               success:function(res)
		               {
		               	if(res=='0')
		               	{
		               	  $("#valid_epin").css('display','').text('Please enter valid epin');
		               	  bool=false; 	
		               	}
		              
		               }//end success
		          });//end ajax
		    if(!bool)
		    {
		    	return false;
		    }    		
		}

		if(typeof $("#transaction_password").val()!='undefined' && $("#transaction_password").val()!='<?php echo $tran_code ?>')
		{
			$("#valid_transaction_password").css('display','').text('Please Enter Valid Transaction Password!');
			return false;
		}
		//window.location.href='<?php echo site_url();?>user/register/addNewMember/';
		$("#register_form" ).submit();
	});//end form submit button if here
	$("#registration_method").change(function(){
		var registration_method=$(this).val();
		
		var ewallet_div ='<div class="col-md-6">';
			ewallet_div +='<div class="form-group">';
			ewallet_div +='<label>Ewallet Transaction Password:</label>';
			ewallet_div +='<input type="password" name="transaction_password" id="transaction_password" placeholder="Enter Ewallet Transaction Password" class="form-control">';
			ewallet_div +='<span style="color:red;display:none;font-weight:bold" id="valid_transaction_password">Please Enter Transaction Password!</span>';
			ewallet_div +='</div>';
			ewallet_div +='</div>';

		var epin_div ='<div class="col-md-6">';
			epin_div +='<div class="form-group">';
			epin_div +='<label>Enter Epin:</label>';
			epin_div +='<input type="text" name="epin" id="epin" placeholder="Enter Epin" class="form-control">';
			epin_div +='<span style="color:red;display:none;font-weight:bold" id="valid_epin">Please Enter Epin!</span>';
			epin_div +='</div>';
			epin_div +='</div>';


		var bank_wire_div ='<div class="col-md-6">';
			bank_wire_div +='<div class="form-group">';
			bank_wire_div +='<label>Upload Bank Wire Proof:</label>';
			bank_wire_div +='<input type="file" name="bank_wired_proof" id="bank_wired_proof" placeholder="Bank Wired Proof" class="form-control">';
			bank_wire_div +='<span style="color:red;display:none;font-weight:bold" id="valid_bank_wired_proof">Please Upload Bank Wire Proof!</span>';
			bank_wire_div +='</div>';
			bank_wire_div +='</div>';


		$("#selected_payment_method").children().remove();	
		if(registration_method!='')
		{
			$("#selected_payment_method").children().remove();	
			$("#valid_registration_method").text('');
		}
		//1=>ewallet, 2=>epin, 3=>bank_wired,4=>paypal
		if(registration_method=='1')
		{
			//ewallet code
			$("#selected_payment_method").children().remove();	
			if($("#selected_payment_method").append(ewallet_div))
			{
				  $("#transaction_password").keyup(function(){
				  	if($(this).val().length>0)
				  	{
				  		$("#valid_transaction_password").css('display','none');
				  	}
				  })
			}//end if
		}
		else if(registration_method=='2')
		{
			//epin code
			$("#selected_payment_method").children().remove();	
			if($("#selected_payment_method").append(epin_div))
			{
				$("#epin").keyup(function(){
					if($(this).val().length>0)
					{
				  		$("#valid_epin").css('display','none');
					}
				});
			}//end if
		}
		else if(registration_method=='3')
		{
			//bank wired code
			$("#selected_payment_method").children().remove();	
			if($("#selected_payment_method").append(bank_wire_div))
			{
				$("#bank_wired_proof").change(function(){
				  if($(this).val()!='')
				  {
				  		$("#valid_bank_wired_proof").css('display','none');
				  }
				});
			}//end if
		}
		else if(registration_method=='4')
		{
			//paypal code
		}
	})
});//end ready
function check_username(username)
  {
      var loader_image='<img src="<?php echo site_url();?>front_assets/images/loader.gif" width="auto">';
       jQuery("#valid_username").children().remove();
      if(username=='')
      {
      	jQuery("#valid_username").append('<div>Please enter username!</div>').css({
	                   'font-weight': 'bold',
	                   'color': 'red',
	                  });//end css
      	return false;
      }
      else 
      {
      	  jQuery("#valid_username").append(loader_image);
	      jQuery.ajax({
	               type:'POST',
	               url:'<?php echo site_url();?>front/isUserNameExists',
	               data: {username:username,requestType:'new_user'},
	               success:function(res){
	               jQuery("#valid_username").children().remove();
	                 if(res=='1')
	                 {
	                   jQuery("#valid_username").append('<div>Sorry username already exists!</div>').css({
	                   'font-weight': 'bold',
	                   'color': 'red',
	                  });//end css
	                 }//end if
	                 else 
	                 {
	                  jQuery("#valid_username").append('<div>Username available!</div>').css({
	                   'font-weight': 'bold',
	                   'color': 'green',
	                  });//end css
	                 }
	               }//end success
	          });//end ajax    	
      }
  }//end function
</script>
