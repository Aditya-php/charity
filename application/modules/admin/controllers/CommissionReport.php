<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/CommissionReport
*/
class CommissionReport extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("commission_report_model");
		$this->load->helper("commission_helper");
	}//end constructor 
	public function directReferralCommission()
	{
		$data=array();
		$data['direct_commission']=$this->commission_report_model->getDirectReferralCommission();
		_adminLayout("commission-report-mgmt/direct-referral-commission",$data);
	}
	public function unilevelCommission()
	{
		$data=array();
		$data['unilevel_commission']=$this->commission_report_model->getUnilevelCommission();
		_adminLayout("commission-report-mgmt/unilevel-commission",$data);
	}
	public function matrixcompleteCommission()
	{
		$data=array();
		$data['matrix_complete_commission']=$this->commission_report_model->getmatrixcompleteCommission();
		_adminLayout("commission-report-mgmt/matrix-complete-commission",$data);
	}
	
	public function welcomebonus()
	{
		$data=array();
		$data['total_welcome_bonus']=$this->db->query("select a.*,b.username from credit_debit as a,user_registration as b where a.reason='36' and a.user_id=b.user_id")->result_array();
		_adminLayout("commission-report-mgmt/welcome-bonus",$data);
	}
	
	
	
	public function matrixstagelevelCommission()
	{
		$data=array();
		$data['matrix_stage_level_commission']=$this->commission_report_model->getmatrixstagelevelCommission();
		_adminLayout("commission-report-mgmt/matrix-stage-level-commission",$data);
	}
	
	
	
	public function matchingCommission()
	{
		$data=array();
		$data['matching_commission']=$this->commission_report_model->getMatchingCommission();
		_adminLayout("commission-report-mgmt/matching-commission",$data);
	}
	/*
	@Desc: It's used to credit binary commission manually
	*/
	public function creditBinaryCommission()
	{
		/*
		@call to creditBinaryCommission() of commission_helper
		*/
		$credit_status=creditBinaryCommission();
		if($credit_status==0)
		{
			$flash_msg='<span class="text-semibold">Well done!</span> Sorry no more binary commission is left to be credited';

		}
		else if($credit_status==1)
		{
			$flash_msg='<span class="text-semibold">Well done!</span> Binary commission is credited successfully';
		}
		$this->session->set_flashdata("flash_msg",$flash_msg);
		redirect(site_url()."admin/CommissionReport/binaryCommission");
		exit;
	}
	/*
	@Desc: It's used to credit matching commission manually
	*/
	public function creditMatchingCommission()
	{
		/*
		@call to creditMatchingCommission() of commission_helper
		*/
		$credit_status=creditMatchingCommission();
		if($credit_status==0)
		{
		 $flash_msg='<span class="text-semibold">Well done!</span> Sorry no more matching commission is left to be credited';
		}
		else if($credit_status==1)
		{
		 $flash_msg='<span class="text-semibold">Well done!</span> Matching commission is credited successfully';
		}
		$this->session->set_flashdata("flash_msg",$flash_msg);
		redirect(site_url()."admin/CommissionReport/matchingCommission");
		exit;
	}	
	public function rankBonus()
	{
		$data=array();
		$data['rank_bonus']=$this->commission_report_model->getRankBonus();
		_adminLayout("commission-report-mgmt/rank-bonus",$data);
	}

	public function rankAchieverReport()
	{
		$data=array();
		$data['rank_achiever_report']=$this->commission_report_model->getRankAchieverReport();
		//pr($data['rank_achiever_report']);
		_adminLayout("commission-report-mgmt/rank-achiever-report",$data);
	}

	public function topEarnerReport()
	{
		$data=array();
		$data['top_earner_report']=$this->commission_report_model->getTopEarnerReport();
		_adminLayout("commission-report-mgmt/top-earner-report",$data);
	}

	public function topRecruiterReport()
	{
		$data=array();
		$data['top_recruiter_report']=$this->commission_report_model->getTopRecuriterReport();
		_adminLayout("commission-report-mgmt/top-recruiter-report",$data);
	}
}//end class