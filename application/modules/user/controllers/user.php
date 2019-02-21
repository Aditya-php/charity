<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/user
*/
 
class User extends Common_Controller 
{
	private $user_id;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		
		
		
		$this->load->model('dashboard_model');
		
		$this->load->model('ewallet_model');
		
		$this->load->model('TeamReport_model','team_report');
		
		$this->load->model('IncomeReport_Model','income_report');
		

	} 
	/*
	@Desc:It's used to render the userbackoffice dashboard page
	*/
	public function index()
	{
		
		/*************************/
		$user_details=$this->dashboard_model->getUserDetails($this->user_id);
		//////@total direct commission////////
		
		$total_direct_commission=(!empty($this->dashboard_model->getUserTotalDirectCommission($this->user_id)))?$this->dashboard_model->getUserTotalDirectCommission($this->user_id):0;
		$data['total_direct_commission']=number_format($total_direct_commission,2);
		//////@total matrix commission////////
		
		$TotalMatrixCompleteCommission=(!empty($this->dashboard_model->getUserTotalMatrixCompleteCommission($this->user_id)))?$this->dashboard_model->getUserTotalMatrixCompleteCommission($this->user_id):0;
		$data['TotalMatrixCompleteCommission']=number_format($TotalMatrixCompleteCommission,2);
		
		$total_matrix_commission=(!empty($this->dashboard_model->gettotal_matrix_commission($this->user_id)))?$this->dashboard_model->gettotal_matrix_commission($this->user_id):0;
		$data['total_matrix_commission']=number_format($total_matrix_commission,2);
		
		$res=$this->db->query("select credit_amt from credit_debit where user_id='".$this->user_id."' and reason='36'")->row_array();
	$data['welcome_bonus']=$res['credit_amt'];
		
		$data['total_commission']=number_format($total_direct_commission+$TotalMatrixCompleteCommission+$total_matrix_commission+$res['credit_amt'],2);
		
		
		
		
		////////////////
		/**************************/
		$data['total_team_member']=(!empty($this->team_report->getTotalTeamMember($this->user_id)))?$this->team_report->getTotalTeamMember($this->user_id):0;

		$data['total_direct_member']=(!empty($this->team_report->getTotalDirectMember($this->user_id)))?$this->team_report->getTotalDirectMember($this->user_id):0;

		$data['rank_name']=(!empty($this->dashboard_model->getRank($this->user_id)))?$this->dashboard_model->getRank($this->user_id):Null;

		$data['ewallet_balance']=$this->ewallet_model->getEwalletBalance($this->user_id);

		$data['payout_in_process']=(!empty($this->dashboard_model->getPayOutInProcess($this->user_id)))?$this->dashboard_model->getPayOutInProcess($this->user_id):0;

		$data['payout_success']=(!empty($this->dashboard_model->getPayOutSuccess($this->user_id)))?$this->dashboard_model->getPayOutSuccess($this->user_id):0;

		$data['user_details']=$user_details;

		$data['sponsor_details']=$this->dashboard_model->getSponsorDetails($this->user_id);

		_userLayout("dashboard",$data);
	}
}//end class
