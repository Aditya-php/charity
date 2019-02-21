<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/TeamReport
*/
class TeamReport extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('TeamReport_Model','team_report');
	} 
	/*
	@Desc: It's used to view the all the direct referral lis
	*/
	public function directReferralMemberList()
	{
	    $data['title']="Direct Referral Member Report";
	    $data['breadcrumb']='<li class="active">Direct Referral Member Report</li>';
		$data['direct_member']=$this->team_report->getDirectReferralMemberList($this->userId);
		$data['total_direct_member']=$this->team_report->getTotalDirectMember($this->userId);
		$data['total_team_member']=$this->team_report->getTotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/direct-referral-member-list",$data);
	}
	
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_downline table
	*/
	public function teamMemberList()
	{
	    $data['title']="Feedr stage Member Report";
	    $data['breadcrumb']='<li class="active">Feeder stage Member Report</li>';
		_userLayout("team-report-mgmt/team-member-list",$data);
	}
	
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_stage1 table
	*/
	public function stage1TeamMemberList()
	{
	    $data['title']="Stage1 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage1 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage1TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage1TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage1_team-member-list",$data);
	}
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_stage2 table
	*/
	public function stage2TeamMemberList()
	{
	    $data['title']="Stage2 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage2 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage2TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage2TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage2_team-member-list",$data);
	}
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_stage3 table
	*/
	public function stage3TeamMemberList()
	{
	    $data['title']="Stage3 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage3 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage3TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage3TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage3_team-member-list",$data);
	}
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_stage4 table
	*/
	public function stage4TeamMemberList()
	{
	    $data['title']="Stage4 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage4 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage4TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage4TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage4_team-member-list",$data);
	}
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_stage5 table
	*/
	public function stage5TeamMemberList()
	{
	    $data['title']="Stage5 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage5 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage5TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage5TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage5_team-member-list",$data);
	}
	/*
	@Desc: It's used to view all the team member list/downline team member from matrix_stage6 table
	*/
	public function stage6TeamMemberList()
	{
	    $data['title']="Stage6 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage6 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage6TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage6TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage6_team-member-list",$data);
	}
	public function stage7TeamMemberList()
	{
	    $data['title']="Stage7 Team Member Report";
	    $data['breadcrumb']='<li class="active">Stage7 Team Member Report</li>';
		$data['team_member']=$this->team_report->getStage7TeamMemberList($this->userId);
		$data['total_team_member']=$this->team_report->getStage7TotalTeamMember($this->userId);
		_userLayout("team-report-mgmt/stage7_team-member-list",$data);
	}
	public function get_stage_wise_team_member($table_name)
	{
		$all_members=$this->team_report->getAllTeamMembersStageWise($table_name,$this->userId);
		echo json_encode($all_members);
	}
}//end class
