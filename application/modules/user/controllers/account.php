<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/account
*/
class Account extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->model("account_model");
	} 
	/* end method */
	public function check_old_password($old_password)
	{
		$user_id=$this->session->userdata('user_id');
		$user=$this->db->select('password')->from('user_registration')->where('user_id',$user_id)->get()->row();
		//$user->password;
		if($old_password!=$user->password)
		{
         $this->form_validation->set_message('check_old_password', 'Sorry old password is wrong!');
         return false;
		}
		return true;
	}
	public function changePassword()
	{
		$user_id=$this->session->userdata('user_id');
		if(!empty($this->input->post('btn')))
		{
			$old_password=$this->input->post('old_password');
			$new_password=$this->input->post('new_password');
			$confirm_password=$this->input->post('confirm_password');
			$this->load->library("form_validation");
			
			$this->form_validation->set_rules('old_password', 'Old Password','callback_check_old_password');
			$this->form_validation->set_rules('new_password', 'New Password','required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password','required');
			if(!$this->form_validation->run()==FALSE)
			{
		       $this->db->update('user_registration',array('password'=>$new_password),array('user_id'=>$user_id));
		       $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Password is updated successfully!</h5>');
		       redirect(site_url()."user/account/changePassword");
			}
		}
        $data['title']="Change Password";
        $data['user']=$this->account_model->getUserDetails($user_id);
        $data['breadcrumb']='<li class="active">Change Password</li>';
        $data['action_url']="changePassword";
        $data['action']="edit";
		_userLayout("account-mgmt/change-password",$data);
	}
	//////////////////////
	public function check_old_transaction_password($old_password)
	{
		$user=$this->db->select('t_code')->from('user_registration')->where('user_id',$this->user_id)->get()->row();
		//$user->password;
		if($old_password!=$user->t_code)
		{
         $this->form_validation->set_message('check_old_transaction_password', 'Sorry old transaction password is wrong!');
         return false;
		}
		return true;
	}

	public function changeTranscationPassword()
	{
		if(!empty($this->input->post('btn')))
		{
			$old_password=$this->input->post('old_password');
			$new_password=$this->input->post('new_password');
			$confirm_password=$this->input->post('confirm_password');
			$this->load->library("form_validation");
			
			$this->form_validation->set_rules('old_password', 'Old Password','callback_check_old_transaction_password');
			$this->form_validation->set_rules('new_password', 'New Password','required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password','required');
			if(!$this->form_validation->run()==FALSE)
			{
		       $this->db->update('user_registration',array('t_code'=>$new_password),array('user_id'=>$this->user_id));
		       $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Transaction Password is updated successfully!</h5>');
		       redirect(site_url()."user/account/changeTranscationPassword");
			}
		}
        $data['title']="Change Transaction Password";
        $data['user']=$this->account_model->getUserDetails($this->user_id);
        $data['breadcrumb']='<li class="active">Change Transaction Password</li>';
        $data['action_url']="changeTranscationPassword";
        $data['action']="edit";
		_userLayout("account-mgmt/change-transaction-password",$data);
	}
	//////////////////////
	public function viewProfile()
	{
        $data['title']="View/Update Profile";
        $data['breadcrumb']='<li class="active">View OR Update Profile</li>';
        $data['action_url']="profileManagement";
        $data['action']="edit";
        $data['user_details']=$this->account_model->getUserDetails($this->user_id);
	   _userLayout("account-mgmt/view-profile",$data);
	}
	public function updatePersonalInformation()
	{
        $first_name=$this->input->post('first_name');
        $last_name=$this->input->post('last_name');
        $address_line1=$this->input->post('address_line1');
        $address_line2=$this->input->post('address_line2');
        $city=$this->input->post('city');
        $state=$this->input->post('state');
        $zip_code=$this->input->post('zip_code');
        $email=$this->input->post('email');
        $country=$this->input->post('country');
        $contact_no=$this->input->post('contact_no');
	    $image_upload_path='/images/';
	    $profile_pic=adImageUpload($_FILES['profile_pic'],1, $image_upload_path);
	    $profile_pic=(!empty($profile_pic))?$profile_pic:$this->input->post('profile_pic_old');
	    ///////////
        $this->db->update('user_registration',array(
        	'first_name'=>$first_name,
        	'last_name'=>$last_name,
        	'address_line1'=>$address_line1,
        	'address_line2'=>$address_line2,
        	'city'=>$city,
        	'state'=>$state,
        	'zip_code'=>$zip_code,
        	'email'=>$email,
        	'country'=>$country,
        	'contact_no'=>$contact_no,
        	'image'=>$profile_pic
        	),array('user_id'=>$this->user_id));
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Profile is updated successfully!</h5>');
        /////////////
        redirect(site_url().'user/account/viewProfile');
	}
	public function updateBankInformation()
	{
		$bank_name=$this->input->post('bank_name');
		$branch_name=$this->input->post('branch_name');
		$account_holder_name=$this->input->post('account_holder_name');
		$account_no=$this->input->post('account_no');
		///////////////////
		$this->db->update('user_registration',array(
			'bank_name'=>$bank_name,
			'branch_name'=>$branch_name,
			'account_holder_name'=>$account_holder_name,
			'account_no'=>$account_no
			),array('user_id'=>$this->user_id));

		///////////////////
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Bank information is updated successfully!</h5>');
        redirect(site_url().'user/account/viewProfile');
	}
	public function updateSocialMediaInformation()
	{
		$facebook_link=$this->input->post('facebook_link');
		$twitter_link=$this->input->post('twitter_link');
		$linkedin_link=$this->input->post('linkedin_link');
		$google_plus_link=$this->input->post('google_plus_link');
		/////////////////////////////
		$this->db->update('user_registration',array(
			'facebook_link'=>$facebook_link,
			'twitter_link'=>$twitter_link,
			'linkedin_link'=>$linkedin_link,
			'google_plus_link'=>$google_plus_link
			),array('user_id'=>$this->user_id));
		/////////////////////////////
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Social media information is updated successfully!</h5>');
        redirect(site_url().'user/account/viewProfile');
	}
}//end class
