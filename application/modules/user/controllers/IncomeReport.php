<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/IncomeReport
*/
class IncomeReport extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('IncomeReport_Model','income_report');
		$this->load->model('TeamReport_model','team_report');
		$this->load->model('dashboard_model','dashboard');
	} 
	/*
	@Desc: It's used to view the direct referral commission list
	*/
	public function directReferralCommissionList()
	{
	    $data['title']="Direct Referral Commission List";
	    $data['breadcrumb']='<li class="active">Direct Referral Commission List</li>';
	    $data['direct_referral_income']=$this->income_report->getDirectReferralCommission($this->userId);
	    $data['total_direct_referral_income']=$this->income_report->getTotalDirectCommission($this->userId);
	    $data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/direct-referral-comission-list",$data);
	}
	/*
	@Desc: It's used to view the level commission list
	*/
	public function levelCommissionList()
	{
	    $data['title']="Level Commission List";
	    $data['breadcrumb']='<li class="active">Level Commission List</li>';
	    $data['level_income']=$this->income_report->getLevelCommission($this->userId);
	    $data['total_level_income']=$this->income_report->getTotalUnilevelCommission($this->userId);
	    $data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("income-report-mgmt/level-comission-list",$data);
	}
	/*
	@Desc: It's used to view the rank bonus
	*/
	public function rankBonusList()
	{
	    $data['title']="Level Commission List";
	    $data['breadcrumb']='<li class="active">Level Commission List</li>';
	    $data['rank_bonus_income']=$this->income_report->getRankUpdateBonus($this->userId);
	    $data['rank_name']=$this->dashboard->getRank($this->userId);
		_userLayout("income-report-mgmt/rank-bonus-list",$data);
	}
	/*
	@Desc: It's used to display matrix commission income
	*/
	public function matrixcompleteCommissionList()
	{
	    $data['title']="Stage Complete Commission List";
	    $data['breadcrumb']='<li class="active">Matrix Commission List</li>';
	    $data['matrix_income']=$this->income_report->getMatrixCommission($this->userId);
	    $data['total_matrix_income']=$this->income_report->getTotalMatrixCommission($this->userId);
	    //$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		_userLayout("income-report-mgmt/matrix-complete-comission-list",$data);
	}
	
	public function matrixCommissionList()
	{
	    $data['title']="Matrix Commission List";
	
	    $data['matrix_commission']=$this->db->query("select a.*,b.username as sender_username from credit_debit as a,user_registration as b where a.user_id='".$this->userId."' and a.reason='37' and a.sender_id=b.user_id")->result();
		_userLayout("income-report-mgmt/matrix-comission-list",$data);
	}
	
}//end class
