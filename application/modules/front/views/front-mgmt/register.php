<!DOCTYPE html>
<html lang="en-US" class="no-js">
	<?php 
	$this->load->view('common/header');
	?>
	<link rel='stylesheet' id='bootstrap-css'  href='<?php echo base_url();?>front_assets/css/sky-forms.css' type='text/css' media='all' />
	<body class="home page-template page-template-page-templates page-template-template-page-vc page-template-page-templatestemplate-page-vc-php page page-id-34 woocommerce-no-js wpb-js-composer js-comp-ver-5.4.7 vc_responsive">
      <div class="over-loader loader-live">
         <div class="loader">
            <div class="loader-item style5">
               <div class="bounce1"></div>
               <div class="bounce2"></div>
               <div class="bounce3"></div>
            </div>
         </div>
      </div>
      <div class="wrapper-boxed">
         <div class="site-wrapper">
            <!-- ================================ -->
            <!-- ============ HEADER ============ -->
           <?php 
		   $this->load->view('top-nav');
		   ?>
            <!-- ========== END OF HEADER  ========== -->
            <!-- ==================================== -->
            <!---------- Sub Header ---------->
            <!---------- Sub Header ---------->
           
           <br><br>
            <section class="page-section">
         <div class="container">
            <div class="row">
               <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php 
     ///sponsor and account info
     $sponsor_id=(!empty($registration_info['sponsor_and_account_info']['ref_user_name']))?$registration_info['sponsor_and_account_info']['ref_user_name']:null;
     $username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:null;
     $email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
     $password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:null;
     $t_code=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:null;
     ///personal info
     $first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
     $last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
     $contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
     $country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
     $state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
     $city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
     $address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
     ///sponsor and account info
     $account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
     $account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
     $bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
     $branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	 
	 $bit_coin_id=(!empty($registration_info['bit_coin_info']['bit_coin_id']))?$registration_info['bit_coin_info']['bit_coin_id']:null;
     ?>
					 
					 <?php 
                  if(!empty($this->session->flashdata('error_msg')))
                  {
                  ?>
               <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
                  ?>
					 
                  <form name="registration" method="post" class="sky-form" action="<?php echo site_url();?>front/register">
                              <header>SPONSOR AND ACCOUNT INFORMATION</header>
                              <fieldset>
                                 <div class="row">
								 
								 <section class="col col-4">               
							  									                                       
							  <input type="checkbox" value="1"  name='con_sponsor'   id='con_no' /> &nbsp;&nbsp;Select if you dont have a sponsor                                   
							                                                                           
							  </section>  
                                    <section class="col col-4">
                                       <label class="input">
                                       <input type="text" placeholder="Sponsor Username" value="<?php echo $sponsor_id;?>" name="sponsor_id" required="" onblur="check_sponsor(this.value)" autocomplete="off" id="sponsor_id" title="Sponsor name" value="">&nbsp;&nbsp;&nbsp;&nbsp;
                                       <span id="check_sponsor"></span>
                                       </label>
                                    </section>
									<section class="col col-4">
                                       <label class="select">
                                       <select name="ref_leg_position" required="">
									     <option value="">-Select your leg position-</option>
										 <option value="left">Left</option>
										 <option value="right">right</option>
									  </select>
                                       </label>
                                    </section>
									
									  <section class="col col-6">
                                       <label class="select">
                                          <select name="platform" id="platform" required="">
										  <option value="">Please choose package</option>
										  <?php
										  foreach($all_package as $all)
										  {
										  ?>
                                        <option  value="<?php echo $all['id'] ?>"><?php echo $all['amount']; ?> <?php echo currency();?> (Registration fee)</option>
											  <?php
										  }
											  ?>
                                          </select>
                                          <i></i>
                                       </label>
                                    </section>
                                    
                                 </div>
                              </fieldset>
                              <?php 
                              if(!empty($account_type))
                              {
                              ?>
                              <input type="hidden" name="account_type" value="<?php echo $account_type;?>">
                              <?php 
                              }  
                              ?>
                              <fieldset style="padding:0px; margin:0px;">
                                 <header>NEW USER DETAILS</header>
                              </fieldset>
                              <fieldset>
                                 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="username" value="<?php echo $username;?>" required="" id="username" onblur="check_username(this.value)" placeholder="Enter Username">&nbsp;&nbsp;&nbsp;&nbsp;  
                                       <span id="check_username"></span>
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="email" value="<?php echo $email;?>" name="email" placeholder="E-mail" required="">
                                       </label>
                                    </section>
                                 </div>
                                 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="password" value="<?php echo $password;?>" name="password" required="" id="passwords" maxlength="12" title="Password" placeholder="Enter Password">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                          <input type="password" value="<?php echo $password;?>" name="confirm_password" required="" title="Confirm Password" maxlength="12" id="confirm_password"  placeholder="Confirm Password">
                                          <span id="valid_confirm_password"></span>
                                       </label>
                                    </section>
                                 </div>
                                 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="password" name="transaction_pwd" value="<?php echo $t_code;?>" required="" id="transaction_pwd" maxlength="12" title="Password" placeholder="Enter Transaction Password">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                          <input type="password" name="transaction_pwd1" value="<?php echo $t_code;?>" required="" title="Confirm Password" maxlength="12" id="transaction_pwd1" placeholder="Confirm Transaction Password">
                                          <span id="valid_transaction_pwd1"></span>
                                       </label>
                                    </section>
                                 </div>
                              </fieldset>
                              <fieldset style="padding:0px; margin:0px;">
                                 <header>PERSONAL INFORMATION</header>
                              </fieldset>
                              <fieldset>
                                 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="firstname" value="<?php echo $first_name;?>" placeholder="Please enter your first name" required="">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="lastname" value="<?php echo $last_name;?>" required="" placeholder="Please enter your last name">
                                       </label>
                                    </section>
                                 </div>
                                 <div class="row">
                                    <section class="col col-6">
                                       <label class="input">
                                       <i class="icon-prepend icon-phone"></i>
                                       <input type="tel" name="phone" value="<?php echo $contact_no;?>" placeholder="Please enter your phone number" required="">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="select">
                                          <select name="country" id="country">
                                             <option value="">Select a Country</option>
                                             <option value="United States">United States</option>
                                             <option value="United Kingdom">United Kingdom</option>
                                             <option value="Afghanistan">Afghanistan</option>
                                             <option value="Albania">Albania</option>
                                             <option value="Algeria">Algeria</option>
                                             <option value="American Samoa">American Samoa</option>
                                             <option value="Andorra">Andorra</option>
                                             <option value="Angola">Angola</option>
                                             <option value="Anguilla">Anguilla</option>
                                             <option value="Antarctica">Antarctica</option>
                                             <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                             <option value="Argentina">Argentina</option>
                                             <option value="Armenia">Armenia</option>
                                             <option value="Aruba">Aruba</option>
                                             <option value="Australia">Australia</option>
                                             <option value="Austria">Austria</option>
                                             <option value="Azerbaijan">Azerbaijan</option>
                                             <option value="Bahamas">Bahamas</option>
                                             <option value="Bahrain">Bahrain</option>
                                             <option value="Bangladesh">Bangladesh</option>
                                             <option value="Barbados">Barbados</option>
                                             <option value="Belarus">Belarus</option>
                                             <option value="Belgium">Belgium</option>
                                             <option value="Belize">Belize</option>
                                             <option value="Benin">Benin</option>
                                             <option value="Bermuda">Bermuda</option>
                                             <option value="Bhutan">Bhutan</option>
                                             <option value="Bolivia">Bolivia</option>
                                             <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                             <option value="Botswana">Botswana</option>
                                             <option value="Bouvet Island">Bouvet Island</option>
                                             <option value="Brazil">Brazil</option>
                                             <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                             <option value="Brunei Darussalam">Brunei Darussalam</option>
                                             <option value="Bulgaria">Bulgaria</option>
                                             <option value="Burkina Faso">Burkina Faso</option>
                                             <option value="Burundi">Burundi</option>
                                             <option value="Cambodia">Cambodia</option>
                                             <option value="Cameroon">Cameroon</option>
                                             <option value="Canada">Canada</option>
                                             <option value="Cape Verde">Cape Verde</option>
                                             <option value="Cayman Islands">Cayman Islands</option>
                                             <option value="Central African Republic">Central African Republic</option>
                                             <option value="Chad">Chad</option>
                                             <option value="Chile">Chile</option>
                                             <option value="China">China</option>
                                             <option value="Christmas Island">Christmas Island</option>
                                             <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                             <option value="Colombia">Colombia</option>
                                             <option value="Comoros">Comoros</option>
                                             <option value="Congo">Congo</option>
                                             <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                             <option value="Cook Islands">Cook Islands</option>
                                             <option value="Costa Rica">Costa Rica</option>
                                             <option value="Cote D'ivoire">Cote D'ivoire</option>
                                             <option value="Croatia">Croatia</option>
                                             <option value="Cuba">Cuba</option>
                                             <option value="Cyprus">Cyprus</option>
                                             <option value="Czech Republic">Czech Republic</option>
                                             <option value="Denmark">Denmark</option>
                                             <option value="Djibouti">Djibouti</option>
                                             <option value="Dominica">Dominica</option>
                                             <option value="Dominican Republic">Dominican Republic</option>
                                             <option value="Ecuador">Ecuador</option>
                                             <option value="Egypt">Egypt</option>
                                             <option value="El Salvador">El Salvador</option>
                                             <option value="Equatorial Guinea">Equatorial Guinea</option>
                                             <option value="Eritrea">Eritrea</option>
                                             <option value="Estonia">Estonia</option>
                                             <option value="Ethiopia">Ethiopia</option>
                                             <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                             <option value="Faroe Islands">Faroe Islands</option>
                                             <option value="Fiji">Fiji</option>
                                             <option value="Finland">Finland</option>
                                             <option value="France">France</option>
                                             <option value="French Guiana">French Guiana</option>
                                             <option value="French Polynesia">French Polynesia</option>
                                             <option value="French Southern Territories">French Southern Territories</option>
                                             <option value="Gabon">Gabon</option>
                                             <option value="Gambia">Gambia</option>
                                             <option value="Georgia">Georgia</option>
                                             <option value="Germany">Germany</option>
                                             <option value="Ghana">Ghana</option>
                                             <option value="Gibraltar">Gibraltar</option>
                                             <option value="Greece">Greece</option>
                                             <option value="Greenland">Greenland</option>
                                             <option value="Grenada">Grenada</option>
                                             <option value="Guadeloupe">Guadeloupe</option>
                                             <option value="Guam">Guam</option>
                                             <option value="Guatemala">Guatemala</option>
                                             <option value="Guinea">Guinea</option>
                                             <option value="Guinea-bissau">Guinea-bissau</option>
                                             <option value="Guyana">Guyana</option>
                                             <option value="Haiti">Haiti</option>
                                             <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                             <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                             <option value="Honduras">Honduras</option>
                                             <option value="Hong Kong">Hong Kong</option>
                                             <option value="Hungary">Hungary</option>
                                             <option value="Iceland">Iceland</option>
                                             <option value="India">India</option>
                                             <option value="Indonesia">Indonesia</option>
                                             <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                             <option value="Iraq">Iraq</option>
                                             <option value="Ireland">Ireland</option>
                                             <option value="Israel">Israel</option>
                                             <option value="Italy">Italy</option>
                                             <option value="Jamaica">Jamaica</option>
                                             <option value="Japan">Japan</option>
                                             <option value="Jordan">Jordan</option>
                                             <option value="Kazakhstan">Kazakhstan</option>
                                             <option value="Kenya">Kenya</option>
                                             <option value="Kiribati">Kiribati</option>
                                             <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                             <option value="Korea, Republic of">Korea, Republic of</option>
                                             <option value="Kuwait">Kuwait</option>
                                             <option value="Kyrgyzstan">Kyrgyzstan</option>
                                             <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                             <option value="Latvia">Latvia</option>
                                             <option value="Lebanon">Lebanon</option>
                                             <option value="Lesotho">Lesotho</option>
                                             <option value="Liberia">Liberia</option>
                                             <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                             <option value="Liechtenstein">Liechtenstein</option>
                                             <option value="Lithuania">Lithuania</option>
                                             <option value="Luxembourg">Luxembourg</option>
                                             <option value="Macao">Macao</option>
                                             <option value="Macedonia">Macedonia</option>
                                             <option value="Madagascar">Madagascar</option>
                                             <option value="Malawi">Malawi</option>
                                             <option value="Malaysia">Malaysia</option>
                                             <option value="Maldives">Maldives</option>
                                             <option value="Mali">Mali</option>
                                             <option value="Malta">Malta</option>
                                             <option value="Marshall Islands">Marshall Islands</option>
                                             <option value="Martinique">Martinique</option>
                                             <option value="Mauritania">Mauritania</option>
                                             <option value="Mauritius">Mauritius</option>
                                             <option value="Mayotte">Mayotte</option>
                                             <option value="Mexico">Mexico</option>
                                             <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                             <option value="Moldova, Republic of">Moldova, Republic of</option>
                                             <option value="Monaco">Monaco</option>
                                             <option value="Mongolia">Mongolia</option>
                                             <option value="Montserrat">Montserrat</option>
                                             <option value="Morocco">Morocco</option>
                                             <option value="Mozambique">Mozambique</option>
                                             <option value="Myanmar">Myanmar</option>
                                             <option value="Namibia">Namibia</option>
                                             <option value="Nauru">Nauru</option>
                                             <option value="Nepal">Nepal</option>
                                             <option value="Netherlands">Netherlands</option>
                                             <option value="Netherlands Antilles">Netherlands Antilles</option>
                                             <option value="New Caledonia">New Caledonia</option>
                                             <option value="New Zealand">New Zealand</option>
                                             <option value="Nicaragua">Nicaragua</option>
                                             <option value="Niger">Niger</option>
                                             <option value="Nigeria">Nigeria</option>
                                             <option value="Niue">Niue</option>
                                             <option value="Norfolk Island">Norfolk Island</option>
                                             <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                             <option value="Norway">Norway</option>
                                             <option value="Oman">Oman</option>
                                             <option value="Pakistan">Pakistan</option>
                                             <option value="Palau">Palau</option>
                                             <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                             <option value="Panama">Panama</option>
                                             <option value="Papua New Guinea">Papua New Guinea</option>
                                             <option value="Paraguay">Paraguay</option>
                                             <option value="Peru">Peru</option>
                                             <option value="Philippines">Philippines</option>
                                             <option value="Pitcairn">Pitcairn</option>
                                             <option value="Poland">Poland</option>
                                             <option value="Portugal">Portugal</option>
                                             <option value="Puerto Rico">Puerto Rico</option>
                                             <option value="Qatar">Qatar</option>
                                             <option value="Reunion">Reunion</option>
                                             <option value="Romania">Romania</option>
                                             <option value="Russian Federation">Russian Federation</option>
                                             <option value="Rwanda">Rwanda</option>
                                             <option value="Saint Helena">Saint Helena</option>
                                             <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                             <option value="Saint Lucia">Saint Lucia</option>
                                             <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                             <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                             <option value="Samoa">Samoa</option>
                                             <option value="San Marino">San Marino</option>
                                             <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                             <option value="Saudi Arabia">Saudi Arabia</option>
                                             <option value="Senegal">Senegal</option>
                                             <option value="Serbia and Montenegro">Serbia and Montenegro</option>
                                             <option value="Seychelles">Seychelles</option>
                                             <option value="Sierra Leone">Sierra Leone</option>
                                             <option value="Singapore">Singapore</option>
                                             <option value="Slovakia">Slovakia</option>
                                             <option value="Slovenia">Slovenia</option>
                                             <option value="Solomon Islands">Solomon Islands</option>
                                             <option value="Somalia">Somalia</option>
                                             <option value="South Africa">South Africa</option>
                                             <option value="South Georgia">South Georgia</option>
                                             <option value="Spain">Spain</option>
                                             <option value="Sri Lanka">Sri Lanka</option>
                                             <option value="Sudan">Sudan</option>
                                             <option value="Suriname">Suriname</option>
                                             <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                             <option value="Swaziland">Swaziland</option>
                                             <option value="Sweden">Sweden</option>
                                             <option value="Switzerland">Switzerland</option>
                                             <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                             <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                             <option value="Tajikistan">Tajikistan</option>
                                             <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                             <option value="Thailand">Thailand</option>
                                             <option value="Timor-leste">Timor-leste</option>
                                             <option value="Togo">Togo</option>
                                             <option value="Tokelau">Tokelau</option>
                                             <option value="Tonga">Tonga</option>
                                             <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                             <option value="Tunisia">Tunisia</option>
                                             <option value="Turkey">Turkey</option>
                                             <option value="Turkmenistan">Turkmenistan</option>
                                             <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                             <option value="Tuvalu">Tuvalu</option>
                                             <option value="Uganda">Uganda</option>
                                             <option value="Ukraine">Ukraine</option>
                                             <option value="United Arab Emirates">United Arab Emirates</option>
                                             <option value="United Kingdom">United Kingdom</option>
                                             <option value="United States">United States</option>
                                             <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                             <option value="Uruguay">Uruguay</option>
                                             <option value="Uzbekistan">Uzbekistan</option>
                                             <option value="Vanuatu">Vanuatu</option>
                                             <option value="Venezuela">Venezuela</option>
                                             <option value="Viet Nam">Viet Nam</option>
                                             <option value="Virgin Islands, British">Virgin Islands, British</option>
                                             <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                             <option value="Wallis and Futuna">Wallis and Futuna</option>
                                             <option value="Western Sahara">Western Sahara</option>
                                             <option value="Yemen">Yemen</option>
                                             <option value="Zambia">Zambia</option>
                                             <option value="Zimbabwe">Zimbabwe</option>
                                          </select>
                                          <i></i>
                                       </label>
                                    </section>
                                 </div>
                                 <div class="row">
                                  
                                    <section class="col col-6">
                                       <label for="file" class="input">
                                       <input type="text" value="<?php echo $address_line1;?>" name="address" required="" placeholder="Address">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="city" value="<?php echo $city;?>" id="city" placeholder="City">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="state" value="<?php echo $state;?>" required="" placeholder="State">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="date_of_birth" value="<?php echo $state;?>" required="" placeholder="Please enter date of birth Example 1989-08-27 (yyyy-mm-dd) ">
                                       </label>
                                    </section>
                                 </div>
                              </fieldset>
                              <fieldset style="padding:0px; margin:0px;">
                                 <header> Bank Account Information</header>
                              </fieldset>
                              
                              <fieldset>
                                 <div class="row">
								 <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="account_holder_name" value="<?php echo $account_holder_name;?>" placeholder="Enter Account Name">
                                       </label>
                                    </section>
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="account_no" value="<?php echo $account_no;?>" placeholder="Enter Account Number">
                                       </label>
                                    </section>
                                 </div>
                                 <div class="row">
                                    
                                    <section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="bank_name" value="<?php echo $bank_name;?>" placeholder="Enter Bank Name">
                                       </label>
                                    </section>
									<section class="col col-6">
                                       <label class="input">
                                       <input type="text" name="branch_name" value="<?php echo $branch_name;?>" placeholder="Enter Branch Name">
                                       </label>
                                    </section>
                                 </div>
                                 <div class="row"></div>
                              </fieldset>
                              <footer>
                                 <label class="checkbox">  
                                 <?php 
                                 if(!empty($registration_info) && count($registration_info)>0)
                                 {
                                 ?>
                                 <input type="checkbox" name="term_cond" id="term_cond" required="" checked='true'>
                                 <?php   
                                 }
                                 else 
                                 {
                                 ?>
                                 <input type="checkbox" name="term_cond" id="term_cond" required="" checked='true'>
                                 
                                 <?php  
                                 }
                                 ?>
                                 <i></i>
                                 

                                 I have Read the <a target="_blank" href="<?php echo site_url();?>terms-conditions">Terms &amp; Condition</a></label>
                                 <span id="valid_term_cond"></span>   
                                 <button type="submit" name="btn" id="btn" value="submit" class="button">Submit Detail</button>
                              </footer>
                           </form>
                  <div>
                  </div>
               </div>
            </div>
         </div>
      </section>
            <!-- =================================== -->
            <!-- ========== START FOOTER  ========== -->
            <!-- =================================== -->
            <?php 
			$this->load->view('common/footer');
			?>
            <!-- ================================= -->
            <!-- ========== END FOOTER  ========== -->
            <!-- ================================= -->
         </div>
      </div>
      <?php 
	  $this->load->view('common/footer-script');
	  ?>
   </body>
</html>
<!-- loader-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/jquery.loading.block.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>admin_assets/js/loader.function.js"></script>
<!-----loader---->      
<script>
function check_sponsor(sponsor_id)
{
     var loader_image='<img class="loader_image" src="<?php echo site_url();?>admin_assets/images/loader.gif" width="auto">';
     if(sponsor_id=='')
     {
         jQuery("#check_sponsor").children().remove();
         jQuery("#check_sponsor").append('<div>Please enter sponsor username!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
     }
     else 
     {
         //jQuery("#check_sponsor").append(loader_image);
         jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>front/isUserNameExists',
               data: {username:sponsor_id,requestType:'sponsor'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    jQuery.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                  },
               success:function(res){
                 jQuery("#check_sponsor").children().remove();
                 if(res.exist!='1')
                 {
                  jQuery("#check_sponsor").append('<div>Sorry Sponsor does not exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                  //jQuery("#sponsor_id").focus();
                 }//end if
                 else 
                 {
                  jQuery("#check_sponsor").append('<div>'+res.username+' Exist</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
               complete: function () {
                    //$("#load").css("display", "none");
                    jQuery.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                }

          });//end ajax
     }
}//end function

//jQuery(document).ready(function(){alert("call")});
function check_username(username)
{
     //var loader_image='<img src="<?php echo site_url();?>front_assets/images/loader.gif" width="auto">';
     if(username=='')
     {
         jQuery("#check_username").children().remove();
         jQuery("#check_username").append('<div>Please enter username!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '13px'
                  });//end css
                  //jQuery("#sponsor_id").focus();
     }
     else 
     {
           //jQuery("#check_username").append(loader_image);
           jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>front/isUserNameExists',
               data: {username:username,requestType:'new_user'},
               async:false,
               beforeSend: function () {
                    //$("#load").css("display", "block");
                    $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                  },
               success:function(res){
                 jQuery("#check_username").children().remove();
                 if(res.exist=='1')
                 {
                  
                   jQuery("#check_username").append('<div>Sorry '+username+' already exists!</div>').css({
                   'font-weight': 'bold',
                   'color': 'red',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }//end if
                 else 
                 {
                  jQuery("#check_username").append('<div>'+username+' available!</div>').css({
                   'font-weight': 'bold',
                   'color': 'green',
                   'margin': '0',
                   'padding': '0',
                   'float': 'left',
                   'font-size': '14px'
                  });//end css
                 }
               },//end success
              complete: function () {
                    //$("#load").css("display", "none");
                    $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                } 
          });//end ajax
     }
}//end function
//jQuery(document).ready(function(){alert("call")});
jQuery(document).ready(function(){
     jQuery("#country").children().each(function(){
          if(jQuery(this).val()=='<?php echo $country;?>')
          {
            jQuery(this).attr('selected','true')
          }
     });
     /////////////////



 //////////check cond
	 jQuery("#con_no").click(function(){
		
	 if(jQuery('#con_no').is(':checked'))
	 {
	  
	 jQuery("#sponsor_id").val('123456');	
	 jQuery("#sponsor_id").attr("disabled", "disabled");
	 jQuery("#check_sponsor").text(''); 
	 }
	 else
	 {
		  
		    jQuery("#sponsor_id").prop("disabled", false);	
			jQuery("#sponsor_id").val('');		
			jQuery("#check_sponsor").text('');   
			jQuery("sponsor_id").prop('required',true);	
	 }
	 });	 	 	 	 	 
     /////////////////






     jQuery("#confirm_password").blur(function(){

          var password=jQuery("#passwords").val();
          var confirm_password=jQuery(this).val();
          if(password!=confirm_password)
          {
               jQuery("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold'});
          }
          else
          {
               jQuery("#valid_confirm_password").text("");
          }

     });
     jQuery("#transaction_pwd1").blur(function(){
               var transaction_pwd=jQuery("#transaction_pwd").val();
               var confirm_transaction_pwd=jQuery(this).val();
               if(transaction_pwd!=confirm_transaction_pwd)
               {
                    jQuery("#valid_transaction_pwd1").text("Confirm Transaction password does not match!").css({'color':'red','font-weight':'bold'});
               }
               else
               {
                    jQuery("#valid_transaction_pwd1").text("");   
               }
     });
     ////
     jQuery("#btn").click(function(){
          var usernameExist=false;
          var username=jQuery("#username").val();
          jQuery.ajax({
               type:'POST',
               url:'<?php echo site_url();?>front/isUserNameExists',
               async:false,
               data: {username:username,requestType:'new_user'},
               success:function(res){
                 //jQuery("#check_username").children().remove();
                 if(res=='1')
                 {
                  usernameExist=true;
                 }//end if
               }//end success
          });//end ajax
          if(usernameExist)
          {
               //jQuery("#check_username").append("<div>Sorry username already available!</div>").css({'color':'red','font-weight':'bold'});
               jQuery("#username").focus();
               return false;
          }
          var password=jQuery("#passwords").val();
          var confirm_password=jQuery("#confirm_password").val();
          if(password!=confirm_password)
          {
               jQuery("#valid_confirm_password").text("Confirm Password does not match!").css({'color':'red','font-weight':'bold'});
               jQuery("#confirm_password").focus();
               return false;
          }
          var transaction_pwd=jQuery("#transaction_pwd").val();
          var confirm_transaction_pwd=jQuery("#transaction_pwd1").val();
          if(transaction_pwd!=confirm_transaction_pwd)
          {
               jQuery("#valid_transaction_pwd1").text("Confirm Transaction password does not match!").css({'color':'red','font-weight':'bold'});
               jQuery("#transaction_pwd1").focus();
               return false;
          }
          if(!jQuery("#term_cond").is(':checked'))
          {
               jQuery("#valid_term_cond").text("Accept Terms & Condition!").css({'color':'red','font-weight':'bold'});
               //jQuery("#term_cond").focus();
               return false;
          }
          return true;
     });
     $("#chk").keyup(function(){
		$("#valid_captcha").text('');
		})
})
</script>
