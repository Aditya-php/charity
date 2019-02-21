<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/stage_wise_member_model
*/
class Stage_Wise_Member_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllActiveMembers($rank_name)
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
			$sql->where_in('rank_name',array($rank_name));
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