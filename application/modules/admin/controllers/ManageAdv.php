<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/ManageAdv
*/
class ManageAdv extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("manage_adv_model");
	} 
	public function viewCategoryList()
	{
		$data=array();	
		$data['all_category']=$this->manage_adv_model->getAllCategory();
	    _adminLayout("manage-adv-mgmt/view-category-list",$data);
	}
	public function addNewCategory()
	{
		$data=array();	
		if(!empty($this->input->post('btn')))
		{
			$title=$this->input->post('title');
			$image_upload_path='/images/';
		    $image=adImageUpload($_FILES['image'],1, $image_upload_path);
	
			$this->db->insert('adv_category',array('title'=>$title,'image'=>$image));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Category is created successfully');
		 	redirect(site_url()."admin/ManageAdv/viewCategoryList");
		}
	    _adminLayout("manage-adv-mgmt/add-new-category",$data);
	}
	public function editCategory($id)
	{
		$data=array();	
		$id=ID_decode($id);
		if(!empty($this->input->post('btn')))
		{
			$title=$this->input->post('title');
			$image_upload_path='/images/';
		    $image=adImageUpload($_FILES['image'],1, $image_upload_path);
		    $image=(!empty($image))?$image:$this->input->post('image_old');

			$this->db->update('adv_category',array('title'=>$title,'image'=>$image),array('id'=>$id));
			$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Category is edit successfully');
		 	redirect(site_url()."admin/ManageAdv/viewCategoryList");
		}
		$category_info=$this->db->select(array('title','image'))->from('adv_category')->where('id',$id)->get()->row();
		$data['id']=$id;
		$data['category_info']=$category_info;
	    _adminLayout("manage-adv-mgmt/edit-category",$data);
	}
	public function deleteCategory($id)
	{
		$id=ID_decode($id);
	    $this->db->delete('adv_category',array(
	     	'id'=>$id
	     	));
	    $this->db->delete('adv',array(
	     	'category_id'=>$id
	     	));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Category is deleted successfully');
		redirect(site_url()."admin/ManageAdv/viewCategoryList");
		exit;
	}
	public function changeCategoryStatus($id)
	{
		$id=ID_decode($id);
	    $info=$this->db->select('status')->from('adv_category')->where('id',$id)->get()->row();
	    $status=$info->status;
	    if($status=='1')
	    {
	     	$set_status='0';
	    }
	    else 
	    {
	     	$set_status='1';
	    }
	    $this->db->update('adv_category',array('status'=>$set_status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Category status is changed successfully');
		redirect(site_url()."admin/ManageAdv/viewCategoryList");
		exit;
	}
	/*
	@Desc:It's used to render the all active advertisement list weather unapproved or underapproved
	*/
	public function viewAllAdvertisementList()
	{
		$data=array();	
		$data['all_active_adv']=$this->manage_adv_model->getAllActiveAdv();
		//pr($data['all_active_adv']);
	    _adminLayout("manage-adv-mgmt/view-all-adv",$data);
	}
	/*
	@Desc:It's used to render the all active unapproved advertisement list
	*/
	public function viewAllUnderApprovalAdvertisementList()
	{
		$data=array();	
		$data['all_active_unapproved_adv']=$this->manage_adv_model->getAllActiveDisapprrovedAdv();
	    _adminLayout("manage-adv-mgmt/view-all-unapproved-adv",$data);

	}
	/*
	@Desc:It's used to render the all active appoved advertisement list
	*/
	public function viewAllApprovedAdvertisementList()
	{
		$data=array();	
		$data['all_active_approved_adv']=$this->manage_adv_model->getAllActiveApprrovedAdv();
	    _adminLayout("manage-adv-mgmt/view-all-approved-adv",$data);
	}
	public function changeAdvStatus($id)
	{
		$id=ID_decode($id);
	    $info=$this->db->select('approval_status')->from('adv')->where('id',$id)->get()->row();
	    $status=$info->approval_status;
	    if($status=='1')
	    {
	     	$set_status='0';
	     	$action='viewAllUnderApprovalAdvertisementList';
	    }
	    else 
	    {
	     	$set_status='1';
	     	$action='viewAllApprovedAdvertisementList';
	    }
	    $this->db->update('adv',array('approval_status'=>$set_status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span>Advertisement status is changed successfully');
		redirect(site_url()."admin/ManageAdv/".$action);
		exit;
	}
	public function deleteAdv($id)
	{
		$id=ID_decode($id);
	    $this->db->delete('adv',array(
	     	'id'=>$id
	     	));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Advertisement is deleted successfully');
		redirect(site_url()."admin/ManageAdv/viewAllAdvertisementList");
		exit;
	}
}//end class
