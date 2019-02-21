<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/rank
*/
class Rank extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model('rank_model');
	}//end constructor 
	/*
	@author:Aditya
	@param:none
	@desc: this function is used to show the rank listing
	@return:none;
	*/
	public function allRanks()
	{
         $data['all_ranks']=$this->rank_model->getAllRanks();
         $data['moduleName']=$this->router->fetch_module();
		_adminLayout("rank-mgmt/all-rank",$data);
	}//end method
	/*
	@author:Aditya
	@param:none
	@desc: this function is used to add new rank
	@return:none;
	*/
	public function addNewRank()
	{
		if(!empty($this->input->post('btn')))
		{

         $rank_name=$this->input->post('rank_name');
         $direct_member=$this->input->post('direct_member');
         $team_member=$this->input->post('team_member');
         $bonus_amount=$this->input->post('bonus_amount');
         $this->db->insert("rank",array('rank_name'=>$rank_name,"direct_member"=>$direct_member,"team_member"=>$team_member,"bonus_amount"=>$bonus_amount));
		 $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> New Rank is added successfully');         
         redirect(site_url()."admin/rank/allRanks");
		 exit;
		}
		_adminLayout("rank-mgmt/add-new-rank");
	}//end method
	/*
	@author:Aditya
	@param:int(id)
	@desc: this function is used to edit the rank
	@return:none;
	*/
	public function editRank($edit_id=null)
	{
		$edit_id=ID_decode($edit_id);
		if(!empty($this->input->post('btn')))
		{
         $rank_name=$this->input->post('rank_name');
         $direct_member=$this->input->post('direct_member');
         $team_member=$this->input->post('team_member');
         $bonus_amount=$this->input->post('bonus_amount');
         $this->db->update("rank",array('rank_name'=>$rank_name,"direct_member"=>$direct_member,"team_member"=>$team_member,"bonus_amount"=>$bonus_amount),array("id"=>$edit_id));
		 $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Rank is edited successfully');         
         redirect(site_url()."admin/rank/allRanks/");
         exit;
		}
		$resObj=$this->db->select('*')->from('rank')->where(array('id'=>$edit_id))->get()->result();
		$data=array();
		$data['id']=$resObj[0]->id;
		$data['rank_name']=$resObj[0]->rank_name;
		$data['direct_member']=$resObj[0]->direct_member;
		$data['team_member']=$resObj[0]->team_member;
		$data['bonus_amount']=$resObj[0]->bonus_amount;
		_adminLayout("rank-mgmt/edit-rank",$data);
	}//end method
	/*
	@author:Aditya
	@param:int(id)
	@desc: this function is used to delete rank
	@return:none;
	*/
	public function deleteRank($delete_id=null)
	{
		$delete_id=ID_decode($delete_id);
		$this->db->delete("rank",array('id'=>$delete_id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Rank is deleted successfully');         
        redirect(site_url()."admin/rank/allRanks/");		
	}//end method

}//end class