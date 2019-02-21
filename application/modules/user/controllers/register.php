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
		$this->load->model('TeamReport_Model','team_report');
		$this->load->helper('registration_helper');
		$this->load->model('admin/member_model','admin_member_model');
	} 
	/*
	@Desc: It's used to display register new member form
	*/
	public function registerNewMember()
	{
		if(isSubAccountCompleted($this->userId))
		{
			$this->session->set_flashdata('flash_msg','Your sub account creation limit is completed');
			redirect(site_url().'user/register/allSubAccountList/');
			exit;

		}
		else 
		{
		 redirect(site_url()."front/register/".$this->userId."/2");
		 exit;
		}
		/////////////
		$data['account_info']=$this->session->userdata('account_info');
		$data['account_info']=$data['account_info']['sponsor_and_account_info'];
		////////////
		$data['personal_info']=$this->session->userdata('personal_info');
		$data['personal_info']=$data['personal_info']['personal_info'];
		//////////
		$data['bank_account_info']=$this->session->userdata('bank_account_info');
		$data['bank_account_info']=$data['bank_account_info']['bank_account_info'];
		//////////
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
		if(empty($account_info))
		{
			$account_info=array();
		}
		if(empty($personal_info))
		{
			$personal_info=array();
		}
		if(empty($bank_account_info))
		{
			$bank_account_info=array();
		}
		//$new_member_data=array_merge($account_info,$personal_info,$bank_account_info);
		
		$data['registration_info']=(!empty($new_member_data) && count($new_member_data)>0)?$new_member_data:null;
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
		$package_amount_info=$this->db->select('amount')->from('package')->where('id',$platform)->get()->row();
		$pkg_amount=$package_amount_info->amount;
		///////////////////////////////////////////////
		//$account_info=array();
		$registration_info['sponsor_and_account_info']['ref_id']=$this->userId;
		$registration_info['sponsor_and_account_info']['account_type']='2';
		$registration_info['sponsor_and_account_info']['pkg_id']=$platform;
		$registration_info['sponsor_and_account_info']['pkg_amount']=$pkg_amount;
		$registration_info['sponsor_and_account_info']['username']=$username;
		$registration_info['sponsor_and_account_info']['password']=$password;
		$registration_info['sponsor_and_account_info']['t_code']=$t_code;
		$this->session->set_userdata('account_info',$registration_info);
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
		
		$registration_info['personal_info']['first_name']=$first_name;
		$registration_info['personal_info']['last_name']=$last_name;
		$registration_info['personal_info']['email']=$email;
		$registration_info['personal_info']['contact_no']=$contact_no;
		$registration_info['personal_info']['country']=$country;
		$registration_info['personal_info']['state']=$state;
		$registration_info['personal_info']['city']=$city;
		$registration_info['personal_info']['zip_code']=$zip_code;
		$registration_info['personal_info']['address_line1']=$address_line1;
		$this->session->set_userdata('personal_info',$registration_info);
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
		//$bank_account_info=array();
		$registration_info['bank_account_info']['account_no']=$account_no;
		$registration_info['bank_account_info']['branch_name']=$branch_name;
		$registration_info['bank_account_info']['bank_name']=$bank_name;
		$registration_info['bank_account_info']['ifsc_code']=$ifsc_code;
		$registration_info['bank_account_info']['account_holder_name']=$account_holder_name;
		$this->session->set_userdata('bank_account_info',$registration_info);
	}
	/*
	@Desc: It's used to check weather the epin exists and not expired till now or not used till now
	*/
	public function isEpinValid()
	{
		$epin_code=$this->input->post('epin_code');
		$total=$this->db->select('*')->from('epin_meta')->where(array('epin_code'=>$epin_code,'epin_status'=>'0'))->get()->num_rows();
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
		//////////
		$account_info=$this->session->userdata('account_info');
		//////////
		$personal_info=$this->session->userdata('personal_info');
		//////////
		$bank_account_info=$this->session->userdata('bank_account_info');
		///////////
		$new_member_data=array_merge($account_info,$personal_info,$bank_account_info);
		//$register_info=array_merge($register_info,$bank_account_info);
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
			$registration_method_name='Bank-Wire';
		}
		else if($registration_method=='4')
		{
			$registration_method_name='Bit-Coin';
		}
		
		if($registration_method=='3')//Bank wire registration
		{
			
			$image_upload_path='/images/';
		    $bank_wired_proof=adImageUpload($_FILES['bank_wired_proof'],1, $image_upload_path);
			//$new_member_data['proof']=$bank_wired_proof;
			$this->register_model->addBankWiredUser($new_member_data,$bank_wired_proof);
			$this->session->unset_userdata('account_info');
			$this->session->unset_userdata('personal_info');
			$this->session->unset_userdata('bank_account_info');
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Member Is Created Successfully and Waiting for proof approval!</h5>');
			redirect(site_url().'user/BankWireMemberReport/pendingMember/');
			exit;
		}
		else if($registration_method=='4')//Bit coin User Registration
		{
			$image_upload_path='/images/';
		    $bank_wired_proof=adImageUpload($_FILES['bank_wired_proof'],1, $image_upload_path);
			//$new_member_data['proof']=$bank_wired_proof;
			$this->register_model->addBitCoinUser($new_member_data,$bank_wired_proof);
			$this->session->unset_userdata('account_info');
			$this->session->unset_userdata('personal_info');
			$this->session->unset_userdata('bank_account_info');
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Member Is Created Successfully and Waiting for proof approval!</h5>');
			redirect(site_url().'user/BankWireMemberReport/pendingMember/');
			exit;
		}
		else 
		{
			if($registration_method=='1')
			{
			 ewalletUserRegistration($new_member_data);
			}
			else if($registration_method=='2')
			{
				$epin_code=$this->input->post('epin');
				//$this->db->update('epin_meta',array('epin_status'=>'1'),array('epin_code'=>$epin_code,'user_id'=>$this->userId));
				$this->db->update('epin_meta',array('epin_status'=>'1','register_username'=>$account_info['sponsor_and_account_info']['username'],'register_user_id'=>
				get_user_id($account_info['sponsor_and_account_info']['username'])),array('epin_code'=>$epin_code,'epin_status'=>'0'));
				epinUserRegistration($new_member_data);
			}
			$this->session->unset_userdata('account_info');
			$this->session->unset_userdata('personal_info');
			$this->session->unset_userdata('bank_account_info');
			$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New Member Is Created Successfully!</h5>');
			redirect(site_url().'user/register/allSubAccountList/');
		}//end if-else here!
	}//end method
	public function allSubAccountList()
	{
		$data=array();
		$data['direct_member']=$this->team_report->getDirectReferralMemberList($this->userId);
		_userLayout("register-mgmt/all-sub-account-list",$data);
	}//
	public function subAccountPasswordTrackerList()
	{
		$data=array();
		$data['all_members']=$this->admin_member_model->getAllMembers();
		$data['user_id']=$this->userId;
		_userLayout("register-mgmt/sub-account-password-tracker-list",$data);
	}
}//end class
