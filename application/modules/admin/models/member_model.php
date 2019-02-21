<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/member_model
*/
class Member_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllMembers()
    {
		$requestData = $_GET;
		/*
		 $requestData['length']=10;
		 $requestData['start']=1;
		 <th>Sr.No</th>
         <th>Member Name</th>
         <th>User Id</th>
         <th>Joining Date</th>
         <th>Sponsor Id</th>
         <th>Sponsor Name</th>
         
		 <th>View Genealogy</th>
      	 <th>Referral Tree</th>
         <th>Status</th>
         <th>Action</th>
		*/
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
             //$sql->order_by('u.id', 'desc'); 
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
				
				$edit=html_entity_decode('<a href="'.site_url().'admin/member/editMember/'.ID_encode($member->user_id).'" data-popup="tooltip" title="" data-original-title="Edit Member Profile"><i class="icon-pencil7"></i></a>');
				
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->ref_id;
				$nestedData[] = $status;
				$nestedData[] = $edit;
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
   public function getAllMembersPassword()
    {
		$requestData = $_GET;
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status,u.password,u.t_code',false)
			->from('user_registration as u');
		
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
             //$sql->order_by('u.id', 'desc'); 
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
				
				$reset_password=html_entity_decode('<a href="'.site_url().'admin/member/resetPassword/'.ID_encode($row->user_id).'">Reset Password</a>');
				
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->password;
				$nestedData[] = $row->t_code;
				$nestedData[] = $reset_password;
				$nestedData[] = $status;
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
  public function getAllActiveMembers()
   {
      $requestData = $_GET;
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
             //$sql->order_by('u.id', 'desc'); 
			$sql->where_in('u.active_status',array('1'));  
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
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->ref_id;
				$nestedData[] = $status;
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
  public function getAllInActiveMembers()
   {
        $requestData = $_GET;
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
			$sql->where_in('u.active_status',array('0'));  
             //$sql->order_by('u.id', 'desc'); 
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
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->ref_id;
				$nestedData[] = $status;
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
   public function getAllBlockUnBlockMembers()
    {
		$requestData = $_GET;
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
             //$sql->order_by('u.id', 'desc'); 
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
				//////////////////////
				$status_change_icon=($row->active_status=='1')?'icon-blocked':'icon-checkmark';
				$status_change_tooltip=($row->active_status=='1')?'block':'Unblock';
				////////////////////
				
				$action=html_entity_decode('<ul class="icons-list">
                           <li>
                              <a onclick="return changeStatusConfirm('.$row->active_status.');" href="'.site_url().'admin/member/changeStatus/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="'.$status_change_tooltip.'"><i class="'.$status_change_icon.'"></i></a>
                           </li>
                           <li>
                              <a href="'.site_url().'admin/member/editMember/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Edit Member Profile"><i class="icon-pencil7"></i></a>
                           </li>
                        </ul>');
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $status;
				$nestedData[] = $action;
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
  public function getAllDirectMember($user_id)
   {
    $userQuery=$this->db->select('u.id,u.username,u.user_id,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,u1.username as sponsor_name,u2.username as nom_name, w.amount')->from('user_registration as u')
    ->join('final_e_wallet as w', 'w.user_id=u.user_id')
    ->join('user_registration as u1', 'u.ref_id=u1.user_id')
    ->join('user_registration as u2', 'u.nom_id=u2.user_id')
    ->where('u.ref_id',$user_id)
    ->get();
    //echo $this->db->last_query();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
  public function getAllDownlineMembers($user_id)
   {
    $userQuery=$this->db->select('u.id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,l.level,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
    ->join('level_income_binary as l', 'l.income_id=u.user_id')
    ->join('final_e_wallet as w', 'w.user_id=u.user_id')
    ->join('user_registration as u1', 'u.ref_id=u1.user_id')
    ->join('user_registration as u2', 'u.nom_id=u2.user_id')
    ->where('u.ref_id',$user_id)
    ->get();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
   public function getUserId($username)
   {
    $this->db->where('username',$username);
    $this->db->or_where('user_id',$username);
    $user_obj=$this->db->select('user_id')->from('user_registration')->get()->row();
    $user_id=(!empty($user_obj->user_id))?$user_obj->user_id:null;
    return $user_id;
   }//end method
}//end class
?>