<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/policy
*/
class Policy extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('policy_model');
	} 
	/*
	@Desc: It's used to view the privacy policy
	*/
	public function privacyPolicy()
	{
		$data['title']='Privacy Policy';
		$data['privacy_policy']=$this->policy_model->getPrivacyPolicy();
		_userLayout("poilcy-mgmt/privacy-policy",$data);
	}
	/*
	@Desc: It's used to view the terms and condition
	*/
	public function termsCondition()
	{
		$data['title']='Terms and Condition';
		$data['terms_and_condition']=$this->policy_model->getTermsCondition();
		_userLayout("poilcy-mgmt/terms-condition",$data);
	}
}//end class
