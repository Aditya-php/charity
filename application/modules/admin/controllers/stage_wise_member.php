<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/stage_wise_member
*/
class Stage_Wise_Member extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model('stage_wise_member_model');
		$this->load->model('account_model');
	}//end constructor 
	public function feeder_stage_member()
	{
		$data=array();
		$data['all_members']=array();
		_adminLayout("stage-wise-member-list/feeder_stage_member",$data);
	}
	public function feeder_stage_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('Worker Stage');
		echo json_encode($all_members);
	}
	
	//////////////////////////////////////
	public function stage1_member()
	{
		$data=array();
		_adminLayout("stage-wise-member-list/stage1_member",$data);
	}
	public function stage1_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('Supervisor Stage');
		echo json_encode($all_members);
	}
	public function stage2_member()
	{
		$data=array();
		_adminLayout("stage-wise-member-list/stage2_member",$data);
	}
	public function stage2_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('Manager Stage');
		echo json_encode($all_members);
	}
	public function stage3_member()
	{
		$data=array();
		//$data['all_members']=$this->stage_wise_member_model->getAllActiveMembers('GENERAL MANAGER Stage');
		_adminLayout("stage-wise-member-list/stage3_member",$data);
	}
	public function stage3_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('GENERAL MANAGER Stage');
		echo json_encode($all_members);
	}
	public function stage4_member()
	{
		$data=array();
		//$data['all_members']=$this->stage_wise_member_model->getAllActiveMembers('ASSISTANT DIRECTOR Stage');
		_adminLayout("stage-wise-member-list/stage4_member",$data);
	}
	public function stage4_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('ASSISTANT DIRECTOR Stage');
		echo json_encode($all_members);
	}
	public function stage5_member()
	{
		$data=array();
		//$data['all_members']=$this->stage_wise_member_model->getAllActiveMembers('DIRECTOR Stage');
		_adminLayout("stage-wise-member-list/stage5_member",$data);
	}
	public function stage5_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('DIRECTOR Stage');
		echo json_encode($all_members);
	}
	public function stage6_member()
	{
		$data=array();
		//$data['all_members']=$this->stage_wise_member_model->getAllActiveMembers('ACTING CEO Stage');
		_adminLayout("stage-wise-member-list/stage6_member",$data);
	}
	public function stage6_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('ACTING CEO Stage');
		echo json_encode($all_members);
	}
	public function stage7_member()
	{
		$data=array();
		//$data['all_members']=$this->stage_wise_member_model->getAllActiveMembers('CEO Stage');
		_adminLayout("stage-wise-member-list/stage7_member",$data);
	}
	public function stage7_member_list_ajax()
	{
		$all_members=$this->stage_wise_member_model->getAllActiveMembers('CEO Stage');
		echo json_encode($all_members);
	}
	public function exportStageWiseData($stage_name)
	{
		if($stage_name=='feeder_stage')
		{
			
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/feeder_stage_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','Worker Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			
			///$this->export_member($all_member,'work_stage');
			$this->export_member($all_member,"worker_stage");
			$this->session->set_flashdata('flash_msg','<h5>Worker Stage Member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_1')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage1_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','Supervisor Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			$this->export_member($all_member,"supervisor_stage");
			$this->session->set_flashdata('flash_msg','<h5>Supervisor stage Member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_2')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage2_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','Manager Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			$this->export_member($all_member,"manager_stage");
			$this->session->set_flashdata('flash_msg','<h5>Manager stage member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_3')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage3_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','GENERAL MANAGER Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			$this->export_member($all_member,"general_manager_stage");
			$this->session->set_flashdata('flash_msg','<h5>General Manager stage Member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_4')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage4_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','ASSISTANT DIRECTOR Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			///$this->export_member($all_member,'work_stage');
			$this->export_member($all_member,"assistant_director_stage");
			$this->session->set_flashdata('flash_msg','<h5>Assistant Director stage member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_5')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage5_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','DIRECTOR Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			///$this->export_member($all_member,'work_stage');
			$this->export_member($all_member,"director_stage");
			$this->session->set_flashdata('flash_msg','<h5>Director stage member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_6')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage6_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','ACTING CEO Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			///$this->export_member($all_member,'work_stage');
			$this->export_member($all_member,"acting_ceo_stage");
			$this->session->set_flashdata('flash_msg','<h5>Acting CEO member CSV export is done successfully!</h5>');
		}
		else if($stage_name=='stage_7')
		{
			$all_member=$this->input->post('all_member');
			$check_all=$this->input->post('check_all');
			
			if(empty($all_member) || count($all_member)<0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please select anyone member!</h5>');
				redirect(site_url().'admin/stage_wise_member/stage7_member');
				exit;
			}
			
			if(!empty($check_all))
			{
				$all_member=$this->db->select('*')->from('user_registration')->where('rank_name','CEO Stage')->order_by('id','asc')->get()->result();
			}
			else 
			{
				$all_member=$this->db->select('*')->from('user_registration')->where_in('user_id',$all_member)->order_by('id','asc')->get()->result();
			}
			
			///$this->export_member($all_member,'work_stage');
			$this->export_member($all_member,"ceo_stage");
			$this->session->set_flashdata('flash_msg','<h5>CEO stage Member CSV export is done successfully!</h5>');
		}
	}
   public function export_member($all_member=null,$stage_name=null)  
   {  
	   header("Content-type: text/csv");   
	   $file_name=$stage_name."_member(".date('d-m-Y H:i:s').").csv";
	   header("Content-Disposition: attachment; filename=".$file_name);  
	   header("Cache-Control: no-cache, must-revalidate");    
	   header("Pragma: no-cache");
	   $content = '';     
	   $title   = '';    
	   $sno      =1;   
	   if(!empty($all_member) && count($all_member)>0)      
	   {
		   foreach ($all_member as $member)
		   {        
			   $content .= $sno . ",";   
			   $content .= $member->username . ",";
			   $content .= $member->email . ",";
			   $content .= $member->contact_no . ",";
			   $content .= get_user_name($member->ref_id) . ",";
			   $content .= $member->rank_name . ",";
			   $content .= date('d-m-Y',strtotime($member->registration_date)) . ",";
			   $content .= "\n";
			   $sno++;
		   }//end foreach 
	   }//end if
	   $title .= "Sr.No , Username, email, Mobile, Sponsor Name, Stage Name, Registration Date" . "\n";    
	   echo $title;      
	   echo $content; 
   }//end method
}//end class