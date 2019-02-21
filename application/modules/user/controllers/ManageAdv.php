<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/ManageAdv
*/
class ManageAdv extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		if(!isBusinessMember())
		{
			redirect(site_url()."user");
			exit;
		}
		$this->userId=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->model("manage_adv_model");
	} 
	public function viewAdvList()
	{
		$data=array();	
		$data['all_adv']=$this->manage_adv_model->getAllAdv($this->userId);
	    _userLayout("manage-adv-mgmt/view-adv-list",$data);
	}
	public function addNewAdv()
	{
		$data=array();	
		if(!empty($this->input->post('btn')))
		{
			$category_id=$this->input->post('category_id');
			$title=$this->input->post('title');
			$price=$this->input->post('price');
 			$image_upload_path='/images/';
		    ////

		    $image=adImageUpload($_FILES['image'],0, $image_upload_path);
			$image=(!empty($image))?$image:null;

		    $image1=adImageUpload($_FILES['image1'],1, $image_upload_path);
			$image1=(!empty($image1))?$image1:null;

		    $image2=adImageUpload($_FILES['image2'],2, $image_upload_path);
			$image2=(!empty($image2))?$image2:null;

		    $image3=adImageUpload($_FILES['image3'],3, $image_upload_path);
			$image3=(!empty($image3))?$image3:null;

		    $image4=adImageUpload($_FILES['image4'],4, $image_upload_path);
			$image4=(!empty($image4))?$image4:null;

			$descs=$this->input->post('descs');

			$this->db->insert('adv',array(
				'category_id'=>$category_id,
				'user_id'=>$this->userId,
				'title'=>$title,
				'price'=>$price,
				'descs'=>$descs,
				'image'=>$image,
				'image1'=>$image1,
				'image2'=>$image2,
				'image3'=>$image3,
				'image4'=>$image4,
				));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Advertisement is created successfully');
		 	redirect(site_url()."user/ManageAdv/viewAdvList");
		}
		$data['all_publish_category']=$this->manage_adv_model->getAllPublishCategory();
	    _userLayout("manage-adv-mgmt/add-new-adv",$data);
	}
	public function editAdv($id)
	{
		$data=array();	
		$id=ID_decode($id);
		if(!empty($this->input->post('btn')))
		{
			$category_id=$this->input->post('category_id');
			$title=$this->input->post('title');
			$price=$this->input->post('price');
 			$image_upload_path='/images/';
 			////
		    $image=adImageUpload($_FILES['image'],0, $image_upload_path);
		    $image=(!empty($image))?$image:$this->input->post('old_image');
			$image=(!empty($image))?$image:null;
			////
		    $image1=adImageUpload($_FILES['image1'],1, $image_upload_path);
		    $image1=(!empty($image1))?$image1:$this->input->post('old_image1');
			$image1=(!empty($image1))?$image1:null;

		    $image2=adImageUpload($_FILES['image2'],2, $image_upload_path);
		    $image2=(!empty($image2))?$image2:$this->input->post('old_image2');
			$image2=(!empty($image2))?$image2:null;

		    $image3=adImageUpload($_FILES['image3'],3, $image_upload_path);
		    $image3=(!empty($image3))?$image3:$this->input->post('old_image3');
			$image3=(!empty($image3))?$image3:null;

		    $image4=adImageUpload($_FILES['image4'],4, $image_upload_path);
		    $image4=(!empty($image4))?$image4:$this->input->post('old_image4');
			$image4=(!empty($image4))?$image4:null;

			$descs=$this->input->post('descs');
			$this->db->update('adv',array(
				'category_id'=>$category_id,
				'user_id'=>$this->userId,
				'title'=>$title,
				'price'=>$price,
				'descs'=>$descs,
				'image'=>$image,
				'image1'=>$image1,
				'image2'=>$image2,
				'image3'=>$image3,
				'image4'=>$image4
				),array('id'=>$id));

			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Advertisement is edit successfully');
		 	redirect(site_url()."user/ManageAdv/viewAdvList");
		}
		$data['id']=$id;
		$data['all_publish_category']=$this->manage_adv_model->getAllPublishCategory();
		$data['adv_info']=$this->manage_adv_model->getAdv($id);
	    _userLayout("manage-adv-mgmt/edit-adv",$data);
	}
	public function deleteAdv($id)
	{
		$id=ID_decode($id);
	     $this->db->delete('adv',array(
	     	'id'=>$id
	     	));
		 $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Advertisement is deleted successfully');
		 redirect(site_url()."user/ManageAdv/viewAdvList");
		 exit;
	}
	public function changeAdvStatus($id)
	{
		 $id=ID_decode($id);
	     $info=$this->db->select('status')->from('adv')->where('id',$id)->get()->row();
	     $status=$info->status;
	     if($status=='1')
	     {
	     	$set_status='0';
	     }
	     else 
	     {
	     	$set_status='1';
	     }
	     $this->db->update('adv',array('status'=>$set_status),array('id'=>$id));
		 $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Advertisement status is changed successfully');
		 redirect(site_url()."user/ManageAdv/viewAdvList");
		 exit;
	}
	public function viewAdvRequestList($adv_id=null)
	{
		$data=array();
		if(!empty($adv_id))
		{
			$data['all_request']=$this->manage_adv_model->viewAllAdvRequest($this->userId,ID_decode($adv_id));
		}
		else 
		{
			$data['all_request']=$this->manage_adv_model->viewAllRequest($this->userId);
		}
		_userLayout("manage-adv-mgmt/view-adv-request-list",$data);
	}
}//end class
