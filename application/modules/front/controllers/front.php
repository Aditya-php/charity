<?php
defined('BASEPATH') OR exit('No direct script access allowed');
@set_time_limit(0);
ini_set('memory_limit', '100000000000M');
ini_set('upload_max_filesize', '-1');
//ini_set("safe_mode",'off');
ini_set('mysql.connect_timeout','0');   
ini_set('max_execution_time', '-1'
); 
/*
@package Front/Front
*/
class Front extends CI_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		$this->load->helper("layout_helper");
		$this->load->helper("registration_helper");
		//$this->load->helper("commission_helper");
		$this->load->model('front_model');
		$this->load->model('user/account_model');
		$this->load->model('user/package_model');
		$this->load->model('user/ewallet_model');
	}
	/*
	@mandatory method for all mlm plan i.e generic method
	@Desc: It's accept ajax request to validate the sponsor username and new registered username is availability
	*/
	
	public function forgot()
	{
		
		if(!empty($this->input->post('btn')))
	     {
			 $email=$this->input->post("email");
			 $user_id=$this->input->post("user_id");
			 
			 if($email=='')
			 {
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Please enter your Email</span>');
				redirect(site_url()."front/forgot");
				exit();
			 }
			 if($user_id=='')
			 {
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Please enter your User ID</span>');
				redirect(site_url()."front/forgot");
				exit();
			 }
			 
	 $query=$this->db->query("select * from user_registration where email='".$email."' and user_id='".$user_id."' ");
	 $num=$query->num_rows();
	 
	 if($num==0)
	 {
		 
		        $this->session->set_flashdata("error_msg", '<span class="text-semibold">User ID or Email does not exist</span>');
				redirect(site_url()."front/forgot");
				exit();
	 }
	 
	 $result=$query->result_array();
		
	     	 $email=$result[0]['email'];
	     	 $username=$result[0]['username'];
	     	 $password=$result[0]['password'];
			 
			 
				$email_data['from']='info@globalsoftwebtechnologies.com';
				$email_data['to']=$email;
				$email_data['subject']='Forgot Password';
				$email_data['username']=$username;
				$email_data['password']=$password;
				$email_data['email-template']='forgot-password';
				_sendEmail($email_data);
				
				$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Password Successfully Sent to your email </span>');
				redirect(site_url()."front/forgot");
				exit();
			 
			 
		 }
		
	  _frontLayout("front-mgmt/forgot");
	}
	
	
	public function isUserNameExists()
	{
		$username=$this->input->post('username');
		$requestType=$this->input->post('requestType');
		//sleep(1);
		if($requestType=="sponsor")
		{
			if($this->account_model->isActiveUserExist($username))
			{
				$user_info=$this->account_model->getUserDetails($username);
				$output=array(
					'exist'=>1,
					'username'=>$user_info->username,
					);
				$this->output ->set_content_type('application/json') ->set_output(json_encode($output)); 
			}
			else
			{
				$output=array(
					'exist'=>0,
					);
				$this->output ->set_content_type('application/json') ->set_output(json_encode($output)); 
			}
		}
		else if($requestType=="new_user")
		{
			if($this->front_model->isUserExist($username))
			{
				$user_info=$this->account_model->getUserDetails($username);
				$output=array(
					'exist'=>1,
					'first_name'=>$user_info->first_name,
					'last_name'=>$user_info->last_name
					);
				$this->output ->set_content_type('application/json') ->set_output(json_encode($output)); 
			}
			else
			{
				$output=array(
					'exist'=>0,
					);
				$this->output ->set_content_type('application/json') ->set_output(json_encode($output)); 
			} 
		}
	}  
	/*
	@desc:It's used to display the index/home page
	*/
	public function index()
	{
	 /*
	 $data=array();
	 _frontLayout("front-mgmt/home",$data);
	 */
	 $all_user=$this->db->select(array('id','user_id','nom_id','nom_leg_position','pkg_id'))->from('user_registration')->where(array('id >'=>'264875'))->order_by('id','ASC')->get()->result();
	 $no=1;
	 foreach($all_user as $user_obj)
	 {
		 echo "no=".$no."  ";
		 manage_matrix_downline($user_obj);
	     echo $no++;
	 }
	   
	   /*echo "\nStart\n";
	  $this->db->query("call reset_data()");	   
		$sno=1;
		
		$member=1;
		$number=1;
		for($i=1;$i<=2;$i++)
		{
			
		 foreach (range('A', 'Z') as $column)
		 {
				if($member==19)break;
				
				echo "\nsno=".$sno;
				
				$username=$column.$i;
				if($number%2==0)
				{
					$leg="right";
				}
				else 
				{
					$leg="left";
				}
				testRegistration($username,$leg);
			    $sno++;
				$number++;
			 $member++;
		 }   
		}
		echo "\end by us";*/
		
	}
	
	public function login()
	{
	  _frontLayout("front-mgmt/login");
	}
	/*
	@mandatory method for all mlm plan i.e generic method
	@desc:It's used to display the Register page
	*/
	public function register($ref_id=null,$account_type=null)
	{
	      if(!empty($ref_id))
		 {
			if($this->front_model->isUserExist($ref_id))
			{
			 $data['replicated_username']=$ref_id;
			}
		 }
		 if(!empty($this->input->post('btn')))
	     {
	     	//$this->session->set_userdata($data);
	     	/////sponsor and account informtaion
	     	$ref_id=$this->input->post("sponsor_id");
	     	$username=$this->input->post("username");
	     	$pkg_id=(!empty($this->input->post("platform")))?$this->input->post("platform"):1;
			
			
	     	$email=$this->input->post("email");
	     	$password=$this->input->post("password");
	     	$t_code=$this->input->post("transaction_pwd");
			$ref_leg_position=$this->input->post("ref_leg_position");
			
			$condition=$this->input->post("con_sponsor");
			
			if($condition==1)
			{
				$ref_id='123456';
			}
			else
			{
				$ref_id=$ref_id;
			}
			
			$pk_res=$this->db->query("select * from package where id='".$pkg_id."'")->row_array();
			
	     	$pkg_amount=$pk_res['amount'];
			
			
			$pkg_count=$this->db->select('*')->from('package')->where(array('id'=>$pkg_id))->get()->num_rows();
			
			if($pkg_count==0)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Please choose valid package</span>');
				redirect(site_url()."front/register");
				exit();
				
			}
			
			
			$sponsor_qry=$this->db->query("select * from user_registration where (username='".$ref_id."' || user_id='".$ref_id."')");
	
	        $sponsor_count=$sponsor_qry->num_rows();
			
			$sponsor_result=$sponsor_qry->row_array();
	
			if($sponsor_count==0)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Sponsor not found</span>');
				redirect(site_url()."front/register");
				exit();	
			}
			
		    $user_count=$this->db->select('*')->from('user_registration')->where(array('username'=>$username))->get()->num_rows();
			
			if($user_count==1)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">Username already exist</span>');
				redirect(site_url()."front/register");
				exit();
				
			}
			
			if($ref_leg_position=='')
			{
				$this->session->set_flashdata("error_msg", '<span class="text-semibold">Please Choose Leg</span>');
				redirect(site_url()."front/register");
				exit();
			}
			
			$chkpkgcond=$this->db->select('*')->from('user_registration')->where(array('username'=>$username))->get()->num_rows();
			
			if($sponsor_result['pkg_id']!=$pkg_id)
			{
				 $this->session->set_flashdata("error_msg", '<span class="text-semibold">your package and sponsor package should be same</span>');
				redirect(site_url()."front/register");
				exit();
				
			}
			
			
			
			
	     	$ref_user_info=$this->account_model->getUserDetails($ref_id);
	     	$account_type=(!empty($this->input->post("account_type")))?$this->input->post("account_type"):'1';
	     	/////personal informtaion
	     	$first_name=$this->input->post('firstname');
	     	$last_name=$this->input->post('lastname');
	     	$contact_no=$this->input->post('phone');
	     	$country=$this->input->post('country');
	     	$state=$this->input->post('state');
	     	$city=$this->input->post('city');
	     	$address_line1=$this->input->post('address');
	     	$date_of_birth=$this->input->post('date_of_birth');
	     	/////Bank account informtaion
	     	$account_holder_name=(!empty($this->input->post('account_holder_name')))?$this->input->post('account_holder_name'):null;
	     	$account_no=(!empty($this->input->post('account_no')))?$this->input->post('account_no'):null;
	     	$bank_name=(!empty($this->input->post('bank_name')))?$this->input->post('bank_name'):null;
	     	$branch_name=(!empty($this->input->post('branch_name')))?$this->input->post('branch_name'):null;
	     	//////Bit Coin Information/////////////////////
			$bit_coin_id=(!empty($this->input->post('bit_coin_id')))?$this->input->post('bit_coin_id'):null;
			/////////////
			
	     	$registration_info=array();
	     	$registration_info['sponsor_and_account_info']=array(
	     		'ref_id'=>$ref_user_info->user_id,
	     		'ref_user_name'=>$ref_user_info->username,
	     		'username'=>$username,
	     		'email'=>$email,
	     		'pkg_id'=>$pkg_id,
	     		'pkg_amount'=>$pkg_amount,
	     		'password'=>$password,
	     		't_code'=>$t_code,
				'ref_leg_position'=>$ref_leg_position,
				'account_type'=>$account_type
	     		);
	     	
	     	$registration_info['personal_info']=array(
	     		'first_name'=>$first_name,
	     		'last_name'=>$last_name,
	     		'contact_no'=>$contact_no,
	     		'country'=>$country,
	     		'state'=>$state,
	     		'city'=>$city,
	     		'address_line1'=>$address_line1,
	     		'date_of_birth'=>$date_of_birth
	     		);
	     	
	     	$registration_info['bank_account_info']=array(
	     		'account_holder_name'=>$account_holder_name,
	     		'account_no'=>$account_no,
	     		'bank_name'=>$bank_name,
	     		'branch_name'=>$branch_name
	     		);
			$registration_info['bit_coin_info']=array(
	     		'bit_coin_id'=>$bit_coin_id,
	     		);
				
	     	$this->session->set_userdata('registration_info',$registration_info);
	     	redirect(site_url()."payment-option");
	     	exit;
	      }
	     $data['registration_info']=(!empty($this->session->userdata('registration_info')) && count($this->session->userdata('registration_info'))>0)?$this->session->userdata('registration_info'):null; 
	      if(!empty($ref_id))
	     {
	     	$registration_info['sponsor_and_account_info']['ref_id']=$ref_id;
	     	$ref_user_info=$this->account_model->getUserDetails($ref_id);
	     	$registration_info['sponsor_and_account_info']['ref_user_name']=$ref_user_info->username;
	     	$data['registration_info']=$registration_info;
	     }
	     if(!empty($account_type))
	     {
	     	$data['account_type']=$account_type;
	     }
		 
		 $data['all_package']=$this->db->query("select * from package")->result_array();
		 
		 _frontLayout("front-mgmt/register",$data);
		 //$this->load->view("front-mgmt/register",$data);
	}
	/*
	@mandatory method for all mlm plan i.e generic method
	@desc:It's used to display the registration method option example ewallet or epin selection for registration
	*/
	public function paymentOption()
	{
	  ///registration_method

	  $payment_option_array=$this->db->select('*')->from('registration_method')->get()->result();
	  $payment_options=array();
	   foreach ($payment_option_array as $arr) 
	   {
	   	$payment_options[$arr->short_name]=$arr->status;
	   }
	  $data['payment_options']=$payment_options;
	  _frontLayout("front-mgmt/payment-option",$data);
	}
	/*
	@mandatory method for all mlm plan i.e generic method
	@author:Aditya
	@desc:It's used to display the Ewallet validation (via transaction password) page
	*/
	public function ewalletPayment()
	{
	   $this->load->model('user/ewallet_model');
	   $data=array();
	   $registration_info=$this->session->userdata('registration_info');
	   $sponser_id=$registration_info['sponsor_and_account_info']['ref_id'];
	   $pkg_amount=$registration_info['sponsor_and_account_info']['pkg_amount'];
       ////////////////
       $user_details=$this->account_model->getUserDetails($sponser_id);
	   $data['username']=(!empty($user_details->username))?$user_details->username:null;
	   $data['transaction_pwd']=(!empty($user_details->t_code))?$user_details->t_code:null;
	   $data['sponsor_wallet_amount']=$this->ewallet_model->getEwalletBalance($sponser_id);
	   $data['pkg_amount']=$pkg_amount;
	   ////////////////
	  _frontLayout("front-mgmt/ewallet-payment",$data);
	}

	/*
	@mandatory method for all mlm plan i.e generic method
	@author:Aditya
	@desc:It's used to regsiter the user and redirect them into userpanel
	*/
	public function registerUserViaEwallet()
	{
		 $registration_info=$this->session->userdata('registration_info');
		 if(!empty($registration_info) && $this->input->is_ajax_request() )
		  {
			  $sponsor_user_name=$this->input->post('sponsor_user_name');
			  $sponsor_transaction_password=$this->input->post('sponsor_transaction_password');
			  ////////////////////////////////////
			  $registration_info=$this->session->userdata('registration_info');
			  $ref_user=$registration_info['sponsor_and_account_info']['ref_id'];
			  $pkg_amount=$registration_info['sponsor_and_account_info']['pkg_amount'];
			  $sponsor_info=get_user_details($ref_user);
			  $post_sponsor_info=get_user_details($sponsor_user_name);
			  ////////
			  $wallet_info=$this->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$sponsor_info->user_id))->get()->row();
			  
			  $username=$registration_info['sponsor_and_account_info']['username'];
			  
			  $is_already_registered=$this->db->select('username')->from('user_registration')->where('username',$username)->get()->num_rows();
			  if($is_already_registered>0)
			  {
				$result=array('status'=>'0','message'=>'Member Registered successfully, please login with entered details!');
				
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			  }
			  else if($sponsor_info->user_id!=$post_sponsor_info->user_id)
			  {
				$result=array('status'=>'0','message'=>'Please enter valid username and password!');
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			  }
			  else if($sponsor_info->t_code!=$sponsor_transaction_password)
			  {
				$result=array('status'=>'0','message'=>'Please enter valid username and password!');
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			  }
			  else if($pkg_amount>$wallet_info->amount)
			  {
				$result=array('status'=>'0','message'=>"Sorry you don't have sufficient fund in your E-wallet!");
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
			  }
			  else 
			  {
				if(ewalletUserRegistration())
				{
				$registration_info=$this->session->userdata('registration_info');
				$username=$registration_info['sponsor_and_account_info']['username'];
				$password=$registration_info['sponsor_and_account_info']['password'];
				$this->session->unset_userdata('registration_info');
				$this->session->unset_userdata('username');
				$this->session->unset_userdata('password');
				$result=array('status'=>'1','message'=>"success",'username'=>$username,'password'=>$password);
				$this->output->set_content_type('application/json')->set_output(json_encode($result));
				}  
			  }
		  }
		  else 
		  {
			$result=array('status'=>'0','message'=>'Invalid Request!');
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		  }
	}
	/*
	@Desc: It's used to render the epin payment page as well as insert data into user registration table
	*/
	public function epinPayment()
	{
	   $data=null;	
	   _frontLayout("front-mgmt/epin-payment",$data);
	}
	/*
	@mandatory method for all mlm plan i.e generic method
	@author:Aditya
	@desc:It's used to regsiter the user and redirect them into userpanel
	*/
	/*
	public function registerUserViaEpin()
	{
		  if(epinUserRegistration())
		  {
		  	$registration_info=$this->session->all_userdata();
		  	$username=$registration_info['registration_info']['sponsor_and_account_info']['username'];
		    $password=$registration_info['registration_info']['sponsor_and_account_info']['password'];
			$this->session->unset_userdata('registration_info');
		    $this->session->set_userdata('username',$username);
			$this->session->set_userdata('password',$password);
		    /////////
		  	$epin_code=$this->input->post('epin_code');
		  	$this->db->update('epin_meta',array('epin_status'=>'1','register_username'=>$username,'register_user_id'=>
			get_user_id($username)),array('epin_code'=>$epin_code,'epin_status'=>'0'));
		    redirect(site_url().'user/auth/login/');
		    exit;
		  }
	}
	*/
	/*
	@Desc: It's registration test method
	*/
	/*
	@Desc: It's used to view the personal information on ajax request for business type registration
	*/
	public function getPersonalInfoHtml()
	{
		$this->load->view("front-mgmt/get-personal-info");
	}
	
	public function isEpinValid()
	{
		$epin_code=$this->input->post("epin_code");
		$res=$this->db->select('*')->from('epin_meta')->where(array(
			'epin_code'=>$epin_code,
			'epin_status'=>'0'
			))->get();
		if($res->num_rows()>0)
		{
			echo true;
		}
		else 
		{
			echo false;
		}
	}
	
	/*
	*/
	public function purchasePinRequest()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$full_name=$this->input->post("full_name");
			$email=$this->input->post("email");
			$mobile_no=$this->input->post("mobile_no");
            $image_upload_path='/images/';
	        $proof=adImageUpload($_FILES['proof'],1, $image_upload_path);
	        $this->db->insert('epin_request',array(
	        	'full_name'=>$full_name,
	        	'email'=>$email,
	        	'mobile_no'=>$mobile_no,
	        	'proof'=>$proof,
	        	));
		    $this->session->set_flashdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Pin Request is submitted successfully</h3>");
		    redirect(site_url().'front/purchasePinRequest');
		}
	    _frontLayout("front-mgmt/purchase-pin",$data);
	}
	/*
	@author:Aditya
	@desc:It's used to display the About Us page
	*/
	public function aboutUs()
	{
	  $data=array();
	  _frontLayout("front-mgmt/about-us");
	}
	public function howItWorks()
	{
	  $data=array();
	  _frontLayout("front-mgmt/how-it-works");
	}
	public function ourPackage()
	{
	  $data=array();
	  _frontLayout("front-mgmt/our-package");
	}
	public function faq()
	{
	  $data=array();
	  _frontLayout("front-mgmt/faq");
	}
	public function disclaimer()
	{
	  $data=array();
	  _frontLayout("front-mgmt/disclaimer");
	}
	public function businessPlan()
	{
	  $data=array();
	  _frontLayout("front-mgmt/business-plan");
	}
	public function contactUs()
	{
	  $data=array();
	  _frontLayout("front-mgmt/contact-us");
	}	
	/*
	@Desc: It's used to render the bankwire page with info as well as insert bank wire data into DB
	*/
	public function bankWirePayment()
	{
		$registration_info=$this->session->userdata('registration_info');
		if(!empty($registration_info) && count($registration_info)>0)
		{
			
			$count=$this->db->query("select * from bank_wired_user_registration where username='".$registration_info['sponsor_and_account_info']['username']."'")->num_rows();
	
		if($count==1)
		{
		        $this->session->set_flashdata("error_msg", '<span class="text-semibold">Username Already Exist</span>');
				redirect(site_url()."front/register");
				exit();		
		}
			
			$this->db->insert('bank_wired_user_registration',array(
		    	///sponsor and account information
		    	'ref_id'=>$registration_info['sponsor_and_account_info']['ref_id'],
		    	'platform'=>$registration_info['sponsor_and_account_info']['pkg_id'],
		    	'package_fee'=>$registration_info['sponsor_and_account_info']['pkg_amount'],
		    	'username'=>$registration_info['sponsor_and_account_info']['username'],
		    	'password'=>$registration_info['sponsor_and_account_info']['password'],
		    	't_code'=>$registration_info['sponsor_and_account_info']['t_code'],
				'ref_leg_position'=>$registration_info['sponsor_and_account_info']['ref_leg_position'],
				'account_type'=>$registration_info['sponsor_and_account_info']['account_type'],
		    	//personal informtaion
		    	'first_name'=>$registration_info['personal_info']['first_name'],
		    	'last_name'=>$registration_info['personal_info']['last_name'],
		    	'email'=>$registration_info['sponsor_and_account_info']['email'],
		    	'contact_no'=>$registration_info['personal_info']['contact_no'],
		    	'country'=>$registration_info['personal_info']['country'],
		    	'state'=>$registration_info['personal_info']['state'],
		    	'city'=>$registration_info['personal_info']['city'],
		    	'address_line1'=>$registration_info['personal_info']['address_line1'],
		    	'date_of_birth'=>$registration_info['personal_info']['date_of_birth'],
		    	//bank account info
		    	'account_no'=>$registration_info['bank_account_info']['account_no'],
		    	'branch_name'=>$registration_info['bank_account_info']['branch_name'],
		    	'bank_name'=>$registration_info['bank_account_info']['bank_name'],
		    	'account_holder_name'=>$registration_info['bank_account_info']['account_holder_name'],
				//bit coin info
		    	'bit_coin_id'=>$registration_info['bit_coin_info']['bit_coin_id'],
				'payment_method'=>'1'
		    	));
        $username=$registration_info['sponsor_and_account_info']['username'];
        $password=$registration_info['sponsor_and_account_info']['password'];
        $email=$registration_info['sponsor_and_account_info']['email'];
        $transaction_pwd=$registration_info['sponsor_and_account_info']['t_code'];
		
		$this->session->unset_userdata('registration_info');
		
		sendUploadBankWireProofEmailToUser($username,$password,$email,$transaction_pwd);
        
        $this->session->set_userdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Thanks for your registration Using Bank Wire</h5><br>
        	<a style='color:#fff;padding:8px;' class='btn btn-primary' href='".site_url()."front/uploadBankWireProof/".$username."'>Upload proof of payment</a>
        	");
        $this->session->unset_userdata('registration_info');
	    redirect(site_url().'bank-wire-payment');
	    exit;
		}
		$bank_wire_detail=$this->front_model->getBankWirePaymentDetailsList(COMP_USER_ID);
		$bank_wire_detail=$bank_wire_detail[0];
		$data['bank_wire_detail']=$bank_wire_detail;
	    //pr($data['bank_wire_detail']);
	   _frontLayout("front-mgmt/bank-wire-payment",$data);
	}
	/*
	@Desc: It's used to upload bank wire proof
	*/
	public function uploadBankWireProof($username=null)
	{
		$data['username']=$username;
		if(!empty($this->input->post('btn')))
		{
		  $username=$this->input->post('username');
		  $total_rows=$this->db->select('id')->from('bank_wired_user_registration')->where(array('username'=>$username,'status !='=>'1'))->get()->num_rows();
		  if($total_rows>0)
		  {
			  $image_upload_path='/images/';
			  $proof=adImageUpload($_FILES['proof'],1, $image_upload_path);
			  $this->db->update('bank_wired_user_registration',array('proof'=>$proof),array('username'=>$username,'status !='=>'1'));
			  $this->session->set_flashdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Proof is uploaded successfully</h3>");
			  redirect(site_url().'front/uploadBankWireProof');
		  }
		  else 
		  {
		  	redirect(site_url().'front/uploadBankWireProof');
		  }
		}
		_frontLayout("front-mgmt/upload-bank-wire-proof",$data);
	}
    /*
	@Desc: It's used to render the bankwire page with info as well as insert bank wire data into DB
	*/
	public function bitCoinPayment()
	{
		$registration_info=$this->session->userdata('registration_info');
		if(!empty($registration_info) && count($registration_info)>0)
		{
			
			$this->db->insert('bank_wired_user_registration',array(
		    	///sponsor and account information
		    	'ref_id'=>$registration_info['sponsor_and_account_info']['ref_id'],
		    	'platform'=>$registration_info['sponsor_and_account_info']['pkg_id'],
		    	'package_fee'=>$registration_info['sponsor_and_account_info']['pkg_amount'],
		    	'username'=>$registration_info['sponsor_and_account_info']['username'],
		    	'password'=>$registration_info['sponsor_and_account_info']['password'],
		    	't_code'=>$registration_info['sponsor_and_account_info']['t_code'],
				'ref_leg_position'=>$registration_info['sponsor_and_account_info']['ref_leg_position'],
				'account_type'=>$registration_info['sponsor_and_account_info']['account_type'],
		    	//personal informtaion
		    	'first_name'=>$registration_info['personal_info']['first_name'],
		    	'last_name'=>$registration_info['personal_info']['last_name'],
		    	'email'=>$registration_info['sponsor_and_account_info']['email'],
		    	'contact_no'=>$registration_info['personal_info']['contact_no'],
		    	'country'=>$registration_info['personal_info']['country'],
		    	'state'=>$registration_info['personal_info']['state'],
		    	'city'=>$registration_info['personal_info']['city'],
		    	'address_line1'=>$registration_info['personal_info']['address_line1'],
		    	'date_of_birth'=>$registration_info['personal_info']['date_of_birth'],
		    	//bank account info
		    	'account_no'=>$registration_info['bank_account_info']['account_no'],
		    	'branch_name'=>$registration_info['bank_account_info']['branch_name'],
		    	'bank_name'=>$registration_info['bank_account_info']['bank_name'],
		    	'account_holder_name'=>$registration_info['bank_account_info']['account_holder_name'],
				//bit coin info
		    	'bit_coin_id'=>$registration_info['bit_coin_info']['bit_coin_id'],
				'payment_method'=>'2'
		    	));
        $username=$registration_info['sponsor_and_account_info']['username'];
        $password=$registration_info['sponsor_and_account_info']['password'];
        $email=$registration_info['sponsor_and_account_info']['email'];
        $transaction_pwd=$registration_info['sponsor_and_account_info']['t_code'];
		
		sendUploadBitCoinProofEmailToUser($username,$password,$email,$transaction_pwd);
        
        $this->session->set_userdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Thanks for your registration via bit Coin Method<br>
        	<a href='".site_url()."front/uploadBitCoinProof/".$registration_info['sponsor_and_account_info']['username']."'><p>Please upload your Bit Coin proof of payment to get confirmed.</p></a>
        	</h5>");
        $this->session->unset_userdata('registration_info');
	    redirect(site_url().'bit-coin-payment');
	    exit;
		}
		$data=array();
		$data['bit_coin_detail']=$this->front_model->getBitCoinPaymentDetailsList(COMP_USER_ID);
		//pr($data['bit_coin_detail']);
	   _frontLayout("front-mgmt/bit-coin-payment",$data);
	}
	/*
	@Desc: It's used to upload bank wire proof
	*/
	public function uploadBitCoinProof($username=null)
	{
		$data['username']=$username;
		if(!empty($this->input->post('btn')))
		{
		  $username=$this->input->post('username');
		  $total_rows=$this->db->select('id')->from('bank_wired_user_registration')->where(array('username'=>$username,'status !='=>'1'))->get()->num_rows();
		  if($total_rows>0)
		  {
			  $image_upload_path='/images/';
			  $proof=adImageUpload($_FILES['proof'],1, $image_upload_path);
			  $this->db->update('bank_wired_user_registration',array('proof'=>$proof),array('username'=>$username,'status !='=>'1'));
			  $this->session->set_flashdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Proof is uploaded successfully</h3>");
			  redirect(site_url().'front/uploadBitCoinProof');
		  }
		  else 
		  {
		  	redirect(site_url().'front/uploadBitCoinProof');
		  }
		}
		_frontLayout("front-mgmt/upload-bit-coin-proof",$data);
	}
	/*
	@Desc: It's used to render the bankwire page with info as well as insert bank wire data into DB
	*/
	public function mobileMoneyPayment()
	{
		$data=array();
		$registration_info=$this->session->userdata('registration_info');
		if(!empty($registration_info) && count($registration_info)>0)
		{
			
			$this->db->insert('bank_wired_user_registration',array(
		    	///sponsor and account information
		    	'ref_id'=>$registration_info['sponsor_and_account_info']['ref_id'],
		    	'platform'=>$registration_info['sponsor_and_account_info']['pkg_id'],
		    	'package_fee'=>$registration_info['sponsor_and_account_info']['pkg_amount'],
		    	'username'=>$registration_info['sponsor_and_account_info']['username'],
		    	'password'=>$registration_info['sponsor_and_account_info']['password'],
		    	't_code'=>$registration_info['sponsor_and_account_info']['t_code'],
				'ref_leg_position'=>$registration_info['sponsor_and_account_info']['ref_leg_position'],
				'account_type'=>$registration_info['sponsor_and_account_info']['account_type'],
		    	//personal informtaion
		    	'first_name'=>$registration_info['personal_info']['first_name'],
		    	'last_name'=>$registration_info['personal_info']['last_name'],
		    	'email'=>$registration_info['sponsor_and_account_info']['email'],
		    	'contact_no'=>$registration_info['personal_info']['contact_no'],
		    	'country'=>$registration_info['personal_info']['country'],
		    	'state'=>$registration_info['personal_info']['state'],
		    	'city'=>$registration_info['personal_info']['city'],
		    	'address_line1'=>$registration_info['personal_info']['address_line1'],
		    	'date_of_birth'=>$registration_info['personal_info']['date_of_birth'],
		    	//bank account info
		    	'account_no'=>$registration_info['bank_account_info']['account_no'],
		    	'branch_name'=>$registration_info['bank_account_info']['branch_name'],
		    	'bank_name'=>$registration_info['bank_account_info']['bank_name'],
		    	'account_holder_name'=>$registration_info['bank_account_info']['account_holder_name'],
				//bit coin info
		    	'bit_coin_id'=>$registration_info['bit_coin_info']['bit_coin_id'],
				'payment_method'=>'3'
		    	));
        $username=$registration_info['sponsor_and_account_info']['username'];
        $password=$registration_info['sponsor_and_account_info']['password'];
        $email=$registration_info['sponsor_and_account_info']['email'];
        $transaction_pwd=$registration_info['sponsor_and_account_info']['t_code'];
		
		sendUploadMobileMoneyProofEmailToUser($username,$password,$email,$transaction_pwd);
        
        $this->session->set_userdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Thanks for your registration Via Mobile Money Provider Payment Method
			<br>
        	<a href='".site_url()."front/uploadMobileMoneyPaymentProof/".$registration_info['sponsor_and_account_info']['username']."'><p>Please click here to upload your Mobile Money Provider proof of payment to get confirmed.</p></a>
        	</h5>");
        $this->session->unset_userdata('registration_info');
	    redirect(site_url().'mobile-money-payment');
	    exit;
		}
		$data['payment_details']=$this->front_model->getMobileMoneyProviderList(COMP_USER_ID);
		//pr($data['payment_details']);
	   _frontLayout("front-mgmt/mobile-money-payment",$data);
	}
	/*
	@Desc: It's used to upload bank wire proof
	*/
	public function uploadMobileMoneyPaymentProof($username=null)
	{
		$data['username']=$username;
		if(!empty($this->input->post('btn')))
		{
		  $username=$this->input->post('username');
		  $total_rows=$this->db->select('id')->from('bank_wired_user_registration')->where(array('username'=>$username,'status !='=>'1'))->get()->num_rows();
		  if($total_rows>0)
		  {
			  $image_upload_path='/images/';
			  $proof=adImageUpload($_FILES['proof'],1, $image_upload_path);
			  $this->db->update('bank_wired_user_registration',array('proof'=>$proof),array('username'=>$username,'status !='=>'1'));
			  $this->session->set_flashdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Proof is uploaded successfully</h3>");
			  redirect(site_url().'front/uploadMobileMoneyPaymentProof');
		  }
		  else 
		  {
		  	redirect(site_url().'front/uploadMobileMoneyPaymentProof');
		  }
		}
		_frontLayout("front-mgmt/upload-mobile-money-payment-proof",$data);
	}
	public function termsCondition()
	{
		$data=array();
		_frontLayout("front-mgmt/terms-conditions",$data);
	}
	public function gallery()
	{
		$data=array();
		_frontLayout("front-mgmt/gallery",$data);
	}
	/*
	@Desc:used to check script
	*/
	public function news()
	{
		$data=array();
		_frontLayout("front-mgmt/news",$data);
	}
	public function ourServices()
	{
		$data=array();
		_frontLayout("front-mgmt/our-services",$data);	
	}

}//end class
