<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/MarketingTools
*/
class Policy extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("policy_model");
	} 
	public function editPrivacyPolicy()
	{
		if(!empty($this->input->post('btn')))
		{
		 $privacy_policy=$this->input->post('privacy_policy');
		 $this->db->update('confidential',
		 	               array('confidential_value'=>$privacy_policy,'last_updated'=>date('Y-m-d H:i:s')),
		 	               array('confidential_key'=>'privacy_policy')
		 	               );
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Privacy Policy is updated successfully');
        redirect(site_url().'admin/policy/editPrivacyPolicy');
		}
		$data=array();
		$data['privacy_policy']=$this->policy_model->getPrivacyPolicy();

	 	
	 	_adminLayout("policy-mgmt/edit-privacy-policy",$data);
	}
	public function editTermsCondition()
	{
		if(!empty($this->input->post('btn')))
		{
		 $terms_condition=$this->input->post('terms_condition');
		 $this->db->update('confidential',
		 	               array('confidential_value'=>$terms_condition,'last_updated'=>date('Y-m-d H:i:s')),
		 	               array('confidential_key'=>'terms_and_condition')
		 	               );
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Terms & Condition is updated successfully');
        redirect(site_url().'admin/policy/editTermsCondition');
		}
		$data=array();
		$data['terms_and_condition']=$this->policy_model->getTermsCondition();
	 	_adminLayout("policy-mgmt/edit-terms-condition",$data);
	}
}//end class
