<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/teamreport_model
*/
class TeamReport_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @Desc: It's used to get all the direct referral member
  */
  public function getDirectReferralMemberList($user_id)
  {
    return $this->db->select('*')->from('user_registration')->where('ref_id',$user_id)->order_by('id','desc')->get()->result();
  }
  /*
  @Desc: It's used to get all the team member from matrix downline table
  */
  public function getTeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
	  'u.ref_id',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_downline as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
  @Desc:It's used to return the total dirrect/referral member on the basis of user_id
  */
  public function getTotalDirectMember($user_id)
  {
    $total_direct_member=$this->db->select('id')->from('user_registration')->where('ref_id',$user_id)->get()->num_rows();
    return $total_direct_member;
  }
  /*
  @Desc:It's used to return the total team member from matrix_downline table on the basis of user_id
  */
  public function getTotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_downline')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  /*
  @Desc: It's used to get all the team member from matrix_stage1
  */
  public function getStage1TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage1 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage1 table on the basis of user_id
  */
  public function getStage1TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage1')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  /*
  @Desc: It's used to get all the team member from matrix_stage2
  */
  public function getStage2TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage2 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage2 table on the basis of user_id
  */
  public function getStage2TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage2')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  /*
  @Desc: It's used to get all the team member from matrix_stage3
  */
  public function getStage3TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage3 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage3 table on the basis of user_id
  */
  public function getStage3TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage3')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }

  /*
  @Desc: It's used to get all the team member from matrix_stage4
  */
  public function getStage4TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage4 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage4 table on the basis of user_id
  */
  public function getStage4TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage4')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  /*
  @Desc: It's used to get all the team member from matrix_stage5
  */
  public function getStage5TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage5 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage5 table on the basis of user_id
  */
  public function getStage5TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage5')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  /*
  @Desc: It's used to get all the team member from matrix_stage6
  */
  public function getStage6TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage6 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage6 table on the basis of user_id
  */
  public function getStage6TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage6')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  
  public function getStage7TeamMemberList($user_id)
  {
    return $this->db->select(array(
      'u.user_id',
      'u.username',
      'u.first_name',
      'u.last_name',
      'u.contact_no',
      'l.level',
      'u.rank_name',
      'u.active_status',
      'u.registration_method_name',
      'u.registration_date'
      ))->from('matrix_stage7 as l')->join('user_registration as u', 'u.user_id=l.down_id')->where('l.income_id',$user_id)->get()->result();
  }
  /*
   @Desc:It's used to return the total team member from matrix_stage6 table on the basis of user_id
  */
  public function getStage7TotalTeamMember($user_id)
  {
    $total_team_member=$this->db->select('id')->from('matrix_stage7')->where('income_id',$user_id)->get()->num_rows();
    return $total_team_member;
  }
  public function getAllTeamMembersStageWise($table_name,$user_id)
  {
        $requestData = $_GET;
		/*
		$requestData['length']=10; 
		$requestData['start']=1;
		*/
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from($table_name.' as m')
			->join('user_registration as u','u.user_id=m.down_id');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
             //$sql->order_by('u.id', 'desc');
			$sql->where_in('m.income_id',array($user_id));
			$sql1 = clone $sql;

			if ($requestData['length'] != '-1') {  // for showing all records
                $query = $sql->limit($requestData['length'], $requestData['start']);   
             }
            $query = $sql->get()->result();
            
			$totalData = $totalFiltered = $sql1->get()->num_rows();             
            
			$data = array();
            
			
			$sr_no = $requestData['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				
				$edit=html_entity_decode('<a href="'.site_url().'admin/member/editMember/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Edit Member Profile"><i class="icon-pencil7"></i></a>');
				
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->ref_id;
				$nestedData[] = $status;
				//$nestedData[] = $edit;
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
    }//end method 
  
}//end class
?>