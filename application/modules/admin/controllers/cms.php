<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cms extends Common_Controller 
{
	public function __construct()
	{
		
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		
	}

   public function stageText()
   {
	   $data['all_list']=$this->db->query("select * from cms_stagetext")->result_array();	   
   	  _adminLayout("cms-mgmt/stagetext",$data);   
	  
   }

   public function editstagetext($fetch_id=null)
   {
	   $fetch_id=ID_decode($fetch_id);
	   $data['title']='Update Text';
	   $data['fetch_data']=$this->db->query("select * from cms_stagetext where id='".$fetch_id."'")->row_array();
	   
	   if(!empty($this->input->post('btn')))
	   {
		   $title=$this->input->post('title');
		   $bottom_text=$this->input->post('bottom_text');
		   $hidid=$this->input->post('hidid');
		   
		   $data = array(
          'title' => $title,
          'bottom_text' => $bottom_text
			);

			$this->db->where('id', $hidid);
			$this->db->update('cms_stagetext', $data);
			
            $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Successfully Updated</span>');
			redirect(site_url()."admin/cms/stageText");
			exit();
		   
	   }

   	  _adminLayout("cms-mgmt/editstage",$data);   
	  
   }


   public function compensationPlan()
   {
	   $data['compensation_plan']=$this->db->query("select * from cms_compensationplan")->result_array();	   
   	  _adminLayout("cms-mgmt/compensation-list",$data);   
	  
   }
   
   
   public function editcompensationplan($fetch_id=null)
   {
	   $fetch_id=ID_decode($fetch_id);
	   $data['title']='Update Compensation Data';
	   $data['fetch_data']=$this->db->query("select * from cms_compensationplan where id='".$fetch_id."'")->row_array();
	   
	   if(!empty($this->input->post('btn')))
	   {
		   $hidid=$this->input->post('hidid');
		   $title=$this->input->post('title');
		   $short_description=$this->input->post('short_description');
		   $table_data=$this->input->post('table_data');
		   $hidimg=$this->input->post('hidimg');
		   
		   if($_FILES['image']['name']=='')
		   {
			   
			   $image=$hidimg;
		   }
		   else
		   {
			
		   $image_upload_path='/front_assets/images/';
	       $image=adImageUpload($_FILES['image'],1, $image_upload_path);
		    
		   }
		   
		   $data = array(
          'title' => $title,
          'short_description' => $short_description,
          'table_data' => $table_data,
          'image' => $image
         
			);

			$this->db->where('id', $hidid);
			$this->db->update('cms_compensationplan', $data);
			
            $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Successfully Updated</span>');
			redirect(site_url()."admin/cms/compensationPlan");
			exit();
		   
	   }

   	  _adminLayout("cms-mgmt/edit-compensationplan",$data);   
	  
   }
   
  
	
}
