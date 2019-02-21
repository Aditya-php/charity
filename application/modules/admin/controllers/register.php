<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/register
*/
class Register extends Common_Controller 
{
	private $userId;
	public $register_new_member=array();
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('register_model');
		$this->load->model('package_model');
		$this->load->model('account_model');
		$this->load->helper('registration_helper');
	} 
	/*
	@Desc: It's used to display register new member form
	*/
	public function registerNewMember()
	{
		$data['account_info']=$this->session->userdata('account_info');
		$data['personal_info']=$this->session->userdata('personal_info');
		$data['bank_account_info']=$this->session->userdata('bank_account_info');
		$data['register_method']=$this->register_model->getAllEnabledRegistrationMethod();
		$data['title']='Register New Member';
		$userDetails=$this->account_model->getUserDetails($this->userId);
		$data['sponsor_username']=(!empty($userDetails->username))?$userDetails->username:'';
		$data['tran_code']=(!empty($userDetails->t_code))?$userDetails->t_code:'';
		if(!empty($this->input->post('btn')))
		{
			$all_input=$this->input->post(null);
			$this->session->set_userdata('new_register_member_info',$all_input);
			redirect(site_url().'user/register/registrationMethod');
			exit;
		}
		$my_active_package=$this->package_model->getMyActivePackage($this->userId);
		$my_active_package_amount=(!empty($my_active_package->amount))?$my_active_package->amount:0;

		$all_active_package=$this->package_model->getAllActivePackage();
		if(!empty($all_active_package) && count($all_active_package)>0)
		{
			foreach ($all_active_package as $package) 
			{
				if($package->amount<=$my_active_package_amount)
				{
					$data['all_active_package'][]=$package;
				}
			}
		}
		//pr($data['all_active_package']);die;
		//_userLayout("register-mgmt/register-new-member",$data);
		$this->load->view('register-mgmt/register-new-member',$data);
	}
	public function registrationMethod()
	{
		$data['title']='Registration Method';
		_userLayout("register-mgmt/registration-method",$data);
	}
	public function confirmTransactionPassword()
	{
		$data['title']='Confirm Transaction Password';
		_userLayout("register-mgmt/confirm-transaction-password",$data);
	}
	/*
    @Desc: Method to save sponsor & account information into session via ajax request
	*/
	public function saveAccountInformation()
	{
		$platform=$this->input->post('platform');
		$username=$this->input->post('username');
		$password=$this->input->post('password');
		$t_code=$this->input->post('t_code');
		///////////////////////////////////////////////
		$account_info=array();
		$account_info['platform']=$platform;
		$account_info['username']=$username;
		$account_info['password']=$password;
		$account_info['t_code']=$t_code;
		$this->session->set_userdata('account_info',$account_info);
	}
	/*
    @Desc: Method to save sponsor & account information into session via ajax request
	*/
	public function savePersonalInformation()
	{
		$first_name=$this->input->post('first_name');
		$last_name=$this->input->post('last_name');
		$email=$this->input->post('email');
		$contact_no=$this->input->post('contact_no');
		$country=$this->input->post('country');
		$state=$this->input->post('state');
		$city=$this->input->post('city');
		$zip_code=$this->input->post('zip_code');
		$address_line1=$this->input->post('address_line1');
		//////////////////////////////////////////////////////
		$personal_info=array();
		$personal_info['first_name']=$first_name;
		$personal_info['last_name']=$last_name;
		$personal_info['email']=$email;
		$personal_info['contact_no']=$contact_no;
		$personal_info['country']=$country;
		$personal_info['state']=$state;
		$personal_info['city']=$city;
		$personal_info['zip_code']=$zip_code;
		$personal_info['address_line1']=$address_line1;
		$this->session->set_userdata('personal_info',$personal_info);
	}
	/*
    @Desc: Method to save sponsor & account information into session via ajax request
	*/
	public function saveBankAccountInformation()
	{
		$account_no=$this->input->post('account_no');
		$branch_name=$this->input->post('branch_name');
		$bank_name=$this->input->post('bank_name');
		$ifsc_code=$this->input->post('ifsc_code');
		$account_holder_name=$this->input->post('account_holder_name');
		////////////////////////////////////////////////////////////////
		$bank_account_info=array();
		$bank_account_info['account_no']=$account_no;
		$bank_account_info['branch_name']=$branch_name;
		$bank_account_info['bank_name']=$bank_name;
		$bank_account_info['ifsc_code']=$ifsc_code;
		$bank_account_info['account_holder_name']=$account_holder_name;
		$this->session->set_userdata('bank_account_info',$bank_account_info);
	}
	/*
	@Desc: It's used to check weather the epin exists and not expired till now or not used till now
	*/
	public function isEpinValid()
	{
		$epin_code=$this->input->post('epin_code');
		$total=$this->db->select('*')->from('epin_meta')->where(array('user_id'=>$this->userId,'epin_code'=>$epin_code,'epin_status'=>'0'))->get()->num_rows();
		if($total>0)
		{
			echo '1';
		}
		else 
		{
			echo '0';
		}
	}
	/*
    @Desc: It's used to display register new member form data
	*/
	public function addNewMember()
	{
		$registration_method=$this->input->post('registration_method');
		$user_id=$this->userId;

		$account_info=$this->session->userdata('account_info');
		$platform=$account_info['platform'];
		$package_details=$this->package_model->getPackageDetails($platform);
		$package_fee=$package_details->amount;
		$username=$account_info['username'];
		$password=$account_info['password'];
		$t_code=$account_info['t_code'];
		/////////////////////////////////////////////////////////
		$personal_info=$this->session->userdata('personal_info');
		$first_name=$personal_info['first_name'];
		$last_name=$personal_info['last_name'];
		$email=$personal_info['email'];
		$contact_no=$personal_info['contact_no'];
		$country=$personal_info['country'];
		$state=$personal_info['state'];
		$city=$personal_info['city'];
		$zip_code=$personal_info['zip_code'];
		$address_line1=$personal_info['address_line1'];

		/////////////////////////////////////////////////////////
		$bank_account_info=$this->session->userdata('bank_account_info');
		$account_no=$bank_account_info['account_no'];
		$branch_name=$bank_account_info['branch_name'];
		$bank_name=$bank_account_info['bank_name'];
		$ifsc_code=$bank_account_info['ifsc_code'];
		$account_holder_name=$bank_account_info['account_holder_name'];

		
		//1=>E-Wallet, 2=>E-Pin, 3=>Bank Wire,4=>PayPal
		if($registration_method=='1')
		{
			$registration_method_name='E-Wallet';
		}
		else if($registration_method=='2')
		{
			$registration_method_name='E-Pin';
		}
		else if($registration_method=='3')
		{
			$registration_method_name='Bank Wire';
		}
		$new_member_data=array(
			'platform'=>$platform,
			'package_fee'=>$package_fee,
			'ref_id'=>$this->userId,
			'username'=>$username,
			'password'=>$password,
			't_code'=>$t_code,
			'first_name'=>$first_name,
			'last_name'=>$last_name,
			'email'=>$email,
			'contact_no'=>$contact_no,
			'country'=>$country,
			'state'=>$state,
			'city'=>$city,
			'zip_code'=>$zip_code,
			'address_line1'=>$address_line1,
			'account_no'=>$account_no,
			'branch_name'=>$branch_name,
			'bank_name'=>$bank_name,
			'ifsc_code'=>$ifsc_code,
			'account_holder_name'=>$account_holder_name,
			'registration_method'=>$registration_method,
			'registration_method_name'=>$registration_method_name,
			);
		if($registration_method=='3')//Bank wire registration
		{
			
			$image_upload_path='/images/';
		    $bank_wired_proof=adImageUpload($_FILES['bank_wired_proof'],1, $image_upload_path);
			$new_member_data['proof']=$bank_wired_proof;
			$this->register_model->addBankWiredUser($new_member_data);
			exit;
		}
		else 
		{
			userRegistrationFromUserBackOffice($new_member_data);
			if($registration_method=='2')
			{
				$epin_code=$this->input->post('epin');
				$this->db->update('epin_meta',array('epin_status'=>'1'),array('epin_code'=>$epin_code,'user_id'=>$this->userId));
			}
			$this->session->unset_userdata('account_info');
			$this->session->unset_userdata('personal_info');
			$this->session->unset_userdata('bank_account_info');
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Member Is Created Successfully!</h5>');
			redirect(site_url().'user/TeamReport/directReferralMemberList/');
		}//end if-else here!
	}//end method
}//end class
