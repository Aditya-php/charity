<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/commission_report_model
*/
class Commission_Report_Model extends Common_Model
{
	public function __construct()
	{
		//@call to parent CI_Model constructor
		parent::__construct();
	}
  	public function getDirectReferralCommission($user_id=null)
  	{

	    $directCommissionQuery=$this->db->query("select a.*,b.username,c.username as sender_username from credit_debit as a,user_registration as b,user_registration as c where a.reason='5' and a.user_id=b.user_id and a.sender_id=c.user_id");
	    $result=($directCommissionQuery->num_rows()>0)?$directCommissionQuery->result():array();
	    return $result;
  	}//end method  

  	public function getUnilevelCommission($user_id=null)
  	{
	    if(!empty($user_id))
	    {
	    	$where=array('u.user_id =' =>'$user_id', 'cd.reason =' =>'9');
	    }
	    else 
	    {
	    	$where=array('cd.reason =' =>'9');
	    }
	    $unilevelCommissionQuery=$this->db->select('cd.credit_amt as amount, cd.ttype , cd.TranDescription as description,cd.create_date, u.username,  u.user_id, cd.receiver_id')->from('credit_debit as cd')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    ->order_by('cd.id','DESC')
	    ->where($where)
	    ->get();
	    $result=($unilevelCommissionQuery->num_rows()>0)?$unilevelCommissionQuery->result():array();
	    return $result;
  	}//end method  
	
	
  	public function getmatrixcompleteCommission($user_id=null)
  	{
	    $matrixcompleteCommissionquery=$this->db->query("select a.*,b.username,c.username as sender_username from credit_debit as a,user_registration as b,user_registration as c where a.reason='6' and a.credit_amt!='0' and a.user_id=b.user_id and a.sender_id=c.user_id");
	    $result=($matrixcompleteCommissionquery->num_rows()>0)?$matrixcompleteCommissionquery->result():array();
	    return $result;
  	}//end method  

	 public function getmatrixstagelevelCommission($user_id=null)
  	{
	    $matrixstagelevelCommissionqry=$this->db->query("select a.*,b.username,c.username as sender_username from credit_debit as a,user_registration as b,user_registration as c where a.reason='37' and a.user_id=b.user_id and a.sender_id=c.user_id");
	    $result=($matrixstagelevelCommissionqry->num_rows()>0)?$matrixstagelevelCommissionqry->result():array();
	    return $result;
  	}//end method  

	
	
	
  	public function getMatchingCommission($user_id=null)
  	{
	    if(!empty($user_id))
	    {
	    	$where=array('u.user_id =' =>'$user_id', 'cd.reason =' =>'7');
	    }
	    else 
	    {
	    	$where=array('cd.reason =' =>'7');
	    }
	    $matchingCommissionQuery=$this->db->select('cd.credit_amt as amount, cd.ttype , cd.TranDescription as description,cd.create_date, u.username,u.user_id')->from('credit_debit as cd')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    ->order_by('cd.id','DESC')
	    ->where($where)
	    ->get();
	    $result=($matchingCommissionQuery->num_rows()>0)?$matchingCommissionQuery->result():array();
	    return $result;
  	}//end method  
  public function getRankBonus($user_id=null)
  {
	    if(!empty($user_id))
	    {
	    	$where=array('u.user_id =' =>'$user_id', 'cd.reason =' =>'10');
	    }
	    else 
	    {
	    	$where=array('cd.reason =' =>'10');
	    }
	    $rankBonusQuery=$this->db->select('cd.credit_amt as amount, cd.ttype , cd.TranDescription as description,cd.create_date, u.username, u.user_id')->from('credit_debit as cd')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    ->order_by('cd.id','DESC')
	    ->where($where)
	    ->get();
	    $result=($rankBonusQuery->num_rows()>0)?$rankBonusQuery->result():array();
	    return $result;
    //echo $this->db->last_query();
  }//end method  
  public function getRankAchieverReport($user_id=null)
  {
  	//SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log GROUP BY user_id ) order by id desc
  	//SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log where user_id='123456' GROUP BY user_id )
  	if(!empty($user_id))
  	{
  		$sql="SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log where user_id='$user_id' GROUP BY user_id )";
  	}
  	else 
  	{
  		$sql="select rl.id, rl.user_id, u.username,u.active_status,rl.rank_id, rl.rank_name, cr.credit_amt, rl.transaction_no, rl.updated_date 
			from (SELECT * FROM rank_log where id in (SELECT max(id) FROM rank_log GROUP BY user_id)) as rl 
			join user_registration as u on rl.user_id=u.user_id
			left join credit_debit as cr on cr.transaction_no=rl.transaction_no;";

  	}
  	$query=$this->db->query($sql);
  	//pr($query->result());
    return $query->result();
  }
  public function getTopEarnerReport($user_id=null)
  {
  	//note reason =6 is taken for binary commission
    if(!empty($user_id))
    {
    	$sql="SELECT cd.transaction_no, cd.user_id, u.username, u.active_status, sum(cd.credit_amt) as total_commission, cd.create_date FROM `credit_debit` as cd 
				join user_registration as u on u.user_id=cd.user_id 
				WHERE cd.reason='6' and cd.user_id='$user_id'  group by create_date,cd.user_id";
    }
    else 
    {
      	$sql="SELECT cd.transaction_no, cd.user_id, u.username, u.active_status, sum(cd.credit_amt) as total_commission, cd.create_date FROM `credit_debit` as cd 
  				join user_registration as u on u.user_id=cd.user_id 
  				WHERE cd.reason='6'  group by create_date,cd.user_id";
  				//echo $sql;
    }
    	$query=$this->db->query($sql);
    	$data=$query->result_array();
    	//pr($data);
    	for($i=0;$i<count($data);$i++)
    	{
    		$j=$i-1;
    		$ref_id=$data[$i]['user_id'];
    		if($i==0)
    		{
  	  		$date=$data[$i]['create_date'];
  	  		$result=$this->db->query("select * from user_registration where ref_id='$ref_id' and auto_registration_date<='$date'")->result();
  	  		$total_direct_member=count($result);
    		}
    		else 
    		{
    			$start_date=$data[$j]['create_date'];
    			$end_date=$data[$i]['create_date'];

  	  		$result=$this->db->query("select * from user_registration where ref_id='$ref_id' and auto_registration_date>='$start_date' and auto_registration_date<='$end_date'")->result();
  	  		$total_direct_member=count($result);
    		}
    		$data[$i]['total_direct_member']=$total_direct_member;
    	}
    	//pr($data);

    	for($i=0;$i<count($data);$i++)
    	{
    		$j=$i-1;
    		$income_id=$data[$i]['user_id'];
    		if($i==0)
    		{
  	  		$date=$data[$i]['create_date'];
  	  		$result=$this->db->query("select * from matrix_downline where income_id='$income_id' and l_date<='$date'")->result();
  	  		$total_team_member=count($result);
    		}
    		else 
    		{
    			$start_date=$data[$j]['create_date'];
    			$end_date=$data[$i]['create_date'];
  	  		$result=$this->db->query("select * from matrix_downline where income_id='$income_id' and l_date>='$start_date' and l_date<='$end_date'")->result();
  	  		$total_team_member=count($result);
    		}
    		$data[$i]['total_team_member']=$total_team_member;
    	}
      
      for($i=0;$i<count($data);$i++)
      {
      	for($j=0;$j<count($data);$j++)
      	{
      		if(!empty($data[$i]['create_date']) && !empty($data[$j]['create_date']) && $data[$i]['create_date']==$data[$j]['create_date'])
      		{
      			if($data[$i]['total_commission']>$data[$j]['total_commission'])
      			{
      				unset($data[$j]);
      			}
      			else if($data[$i]['total_commission']<$data[$j]['total_commission'])
      			{
      				unset($data[$i]);
      			}

      		}
      	}
      }//end for loop here
      //pr($data);
     return $data;
  }//end method
  public function getTopRecuriterReport()
  {
      //note reason =6 is taken for binary commission
      if(!empty($user_id))
      {
        $sql="SELECT cd.transaction_no, cd.user_id, u.username, u.active_status, sum(cd.credit_amt) as total_commission, cd.create_date FROM `credit_debit` as cd 
          join user_registration as u on u.user_id=cd.user_id 
          WHERE cd.reason='6' and cd.user_id='$user_id'  group by create_date,cd.user_id";
      }
      else 
      {
        $sql="SELECT cd.transaction_no, cd.user_id, u.username, u.active_status, sum(cd.credit_amt) as total_commission, cd.create_date FROM `credit_debit` as cd 
          join user_registration as u on u.user_id=cd.user_id 
          WHERE cd.reason='6'  group by create_date,cd.user_id";
          //echo $sql;
      }
      $query=$this->db->query($sql);
      $data=$query->result_array();
      //pr($data);
      for($i=0;$i<count($data);$i++)
      {
        $j=$i-1;
        $ref_id=$data[$i]['user_id'];
        if($i==0)
        {
          $date=$data[$i]['create_date'];
          $result=$this->db->query("select * from user_registration where ref_id='$ref_id' and auto_registration_date<='$date'")->result();
          $total_direct_member=count($result);
        }
        else 
        {
          $start_date=$data[$j]['create_date'];
          $end_date=$data[$i]['create_date'];

          $result=$this->db->query("select * from user_registration where ref_id='$ref_id' and auto_registration_date>='$start_date' and auto_registration_date<='$end_date'")->result();
          $total_direct_member=count($result);
        }
        $data[$i]['total_direct_member']=$total_direct_member;
      }
      //pr($data);

      for($i=0;$i<count($data);$i++)
      {
        $j=$i-1;
        $income_id=$data[$i]['user_id'];
        if($i==0)
        {
          $date=$data[$i]['create_date'];
          $result=$this->db->query("select * from matrix_downline where income_id='$income_id' and l_date<='$date'")->result();
          $total_team_member=count($result);
        }
        else 
        {
          $start_date=$data[$j]['create_date'];
          $end_date=$data[$i]['create_date'];
          $result=$this->db->query("select * from matrix_downline where income_id='$income_id' and l_date>='$start_date' and l_date<='$end_date'")->result();
          $total_team_member=count($result);
        }
        $data[$i]['total_team_member']=$total_team_member;
      }
      for($i=0;$i<count($data);$i++)
      {
        for($j=0;$j<count($data);$j++)
        {
          if(!empty($data[$i]['create_date']) && !empty($data[$j]['create_date']) && $data[$i]['create_date']==$data[$j]['create_date'])
          {
            if($data[$i]['total_team_member']+$data[$i]['total_direct_member']>$data[$j]['total_team_member']+$data[$j]['total_direct_member'])
            {
              unset($data[$j]);
            }
            else if($data[$i]['total_team_member']+$data[$i]['total_direct_member']<$data[$j]['total_team_member']+$data[$j]['total_direct_member'])
            {
              unset($data[$i]);
            }
          }
        }
      }//end for loop here
      //pr($data);
      //die;
     return $data;  	
  }//end method
}//end class
?>