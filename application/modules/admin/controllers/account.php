<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/account
*/
class Account extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("account_model");
	} 
	/*
	@Desc: It's used to view and update profile
	*/
	public function profileManagement()
	{
		if(!empty($this->input->post('btn')))
		{
	        $this->load->library('form_validation');
	        $this->form_validation->set_rules('username', 'Username','callback_check_username_exists');
	        if(!$this->form_validation->run()==FALSE)
	        {
		        $username=$this->input->post('username');
		        $panel_title=$this->input->post('panel_title');
		        $image_upload_path='/images/';
		        $profile_pic=adImageUpload($_FILES['profile_pic'],1, $image_upload_path);
		        $profile_pic=(!empty($profile_pic))?$profile_pic:$this->input->post('profile_pic_old');
		        $facebook_link=$this->input->post('facebook_link');
		        $google_plus_link=$this->input->post('google_plus_link');
		        $linkedin_link=$this->input->post('linkedin_link');
		        $this->db->update('admin',array('image'=>$profile_pic, 'username'=>$username, 'panel_title'=>$panel_title),array('user_id'=>COMP_USER_ID));
		        $this->db->update("user_registration",array(
		       	'facebook_link'=>$facebook_link,
		       	'google_plus_link'=>$google_plus_link,
		       	'linkedin_link'=>$linkedin_link),array('user_id'=>COMP_USER_ID));
		        $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Profile is updated successfully!');
		        redirect(site_url()."admin/account/profileManagement");
	       }//end validation if here
		}
        $data['user']=$this->account_model->getAdminDetails(COMP_USER_ID);
	   _adminLayout("account-mgmt/profile",$data);	
	}
	/* end method */
	public function check_old_password($old_password)
	{
		$user=$this->db->select('password')->from('admin')->where('user_id',COMP_USER_ID)->get()->row();
		//$user->password;
		if(hash('sha256',$old_password)!=$user->password)
		{
         $this->form_validation->set_message('check_old_password', 'Sorry old password is wrong!');
         return false;
		}
		return true;
	}
	public function changePassword()
	{
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
		       $this->db->update('admin',array('password'=>hash('sha256',$new_password)),array('user_id'=>COMP_USER_ID));
		       $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Password is updated successfully!');
		       redirect(site_url()."admin/account/changePassword");
			}
		}
        $data['user']=$this->account_model->getAdminDetails(COMP_USER_ID);
		_adminLayout("account-mgmt/change-password",$data);
	}
}//end class
