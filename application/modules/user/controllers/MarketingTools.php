<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MarketingTools
*/
class MarketingTools extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->load->model("marketing_tools_model");	
		$this->userId=$this->session->userdata('user_id');		
	} 
	public function viewReferralLinks()
	{
		$data=array();
		$res=$this->db->query("select username from user_registration where user_id='".$this->userId."'")->row_array();				 
                $data['referral_link']=site_url().'join-us/'.$res['username'];
	 	_userLayout("marketing-tools-mgmt/view-referral-links",$data);
	}

	public function viewAllImages()
	{
		$data=array();
		$data['all_images']=$this->marketing_tools_model->getAllPublishedMarketingImages();
		//pr($data['all_images']);
	 	_adminLayout("marketing-tools-mgmt/view-all-images",$data);
	}
	public function viewAllVideo()
	{
		$data=array();
		$data['all_videos']=$this->marketing_tools_model->getAllPublishedMarketingVideos();
	 	_adminLayout("marketing-tools-mgmt/view-all-video",$data);
	}

}//end class
