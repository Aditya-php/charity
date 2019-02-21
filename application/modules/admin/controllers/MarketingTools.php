<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/MarketingTools
*/
class MarketingTools extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("account_model");
		$this->load->model("marketing_tools_model");
	} 
	public function viewReferralLinks()
	{
		$data=array();
		$data['referral_link']=site_url().COMP_USERNAME;
	 	_adminLayout("marketing-tools-mgmt/view-referral-links",$data);
	}
	public function viewSocialMediaLinks()
	{
		$data=array();
		$data['user']=$this->account_model->getAdminDetails(COMP_USER_ID);
	 	_adminLayout("marketing-tools-mgmt/view-social-media-links",$data);
	}
    /*
	CREATE TABLE `marketing_images` (
	 `id` bigint(8) NOT NULL AUTO_INCREMENT,
	 `title` varchar(255) DEFAULT NULL,
	 `description` text,
	 `image_path` varchar(255) DEFAULT NULL,
	 `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	 PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1
	=======================
	CREATE TABLE `marketing_videos` (
	 `id` bigint(8) NOT NULL AUTO_INCREMENT,
	 `title` varchar(255) DEFAULT NULL,
	 `description` text,
	 `video_path` varchar(255) DEFAULT NULL,
	 `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
	 PRIMARY KEY (`id`)
	) ENGINE=InnoDB DEFAULT CHARSET=latin1
   */
	public function addMarketingImage()
	{
		if(!empty($this->input->post('btn')))
		{
			$title=$this->input->post('title');
			$description=$this->input->post('description');
		    $image_upload_path='/images/';
		    $image_path=adImageUpload($_FILES['image_path'],1, $image_upload_path);
			$this->db->insert('marketing_images',array(
				'title'=>$title,
				'description'=>$description,
				'image_path'=>$image_path
				));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image is added successfully.');
			redirect(site_url().'admin/MarketingTools/viewImageList');
			exit;
		}
		$data=array();
	 	_adminLayout("marketing-tools-mgmt/add-marketing-image",$data);
	}
	public function changeStatus($id,$status)
	{
		$id=ID_decode($id);
		$this->db->update('marketing_images',array('status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image status is changed successfully.');
		redirect(site_url().'admin/MarketingTools/viewImageList');
		exit;
	}
	public function deleteImage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("marketing_images",array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Image is deleted successfully.');
		redirect(site_url().'admin/MarketingTools/viewImageList');
		exit;
	}
	public function viewImageList()
	{
		$data=array();
		$data['all_images']=$this->marketing_tools_model->getAllMarketingImages();
		//pr($data['all_images']);
	 	_adminLayout("marketing-tools-mgmt/view-image-list",$data);
	}
	public function viewAllImages()
	{
		$data=array();
		$data['all_images']=$this->marketing_tools_model->getAllMarketingImages();
		//pr($data['all_images']);
	 	_adminLayout("marketing-tools-mgmt/view-all-images",$data);
	}
	public function addMarketingVideo()
	{
		if(!empty($this->input->post('btn')))
		{
			$title=$this->input->post('title');
			$description=$this->input->post('description');
			$video_path=$this->input->post('video_path');
			$this->db->insert('marketing_videos',array(
				'title'=>$title,
				'description'=>$description,
				'video_path'=>$video_path
				));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video is added successfully.');
			redirect(site_url().'admin/MarketingTools/viewVideoList');
			exit;
		}
		$data=array();
	 	_adminLayout("marketing-tools-mgmt/add-marketing-video",$data);
	}
	public function changeVideoStatus($id,$status)
	{
		$id=ID_decode($id);
		$this->db->update('marketing_videos',array('status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video status is changed successfully.');
		redirect(site_url().'admin/MarketingTools/viewVideoList');
		exit;
	}
	public function deleteVideo($id)
	{
		$id=ID_decode($id);
		$this->db->delete("marketing_videos",array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Marketing Video is deleted successfully.');
		redirect(site_url().'admin/MarketingTools/viewVideoList');
		exit;
	}
	public function viewVideoList()
	{
		$data=array();
		$data['all_videos']=$this->marketing_tools_model->getAllMarketingVideos();
	 	_adminLayout("marketing-tools-mgmt/view-video-list",$data);
	}
	public function viewAllVideo()
	{
		$data=array();
		$data['all_videos']=$this->marketing_tools_model->getAllMarketingVideos();
	 	_adminLayout("marketing-tools-mgmt/view-all-video",$data);
	}

}//end class
