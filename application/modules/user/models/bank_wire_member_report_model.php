<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/account_model
*/
class Bank_Wire_Member_Report_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @Desc: It's used to get all the pending member on the basis of user id
  */  
  public function getPendingMember($user_id)
  {
   return $this->db->select('*')->from('bank_wired_user_registration')->where(array('ref_id'=>$user_id,'status'=>'0'))->get()->result();
  }
  /*
  @Desc: It's used to get all the approved member on the basis of user id
  */  
  public function getApprovedMember($user_id)
  {
   return $this->db->select('*')->from('bank_wired_user_registration')->where(array('ref_id'=>$user_id,'status'=>'1'))->get()->result();
  }
  /*
  @Desc: It's used to get all the cancelled member on the basis of user id
  */  
  public function getCancelledMember($user_id)
  {
   return $this->db->select('*')->from('bank_wired_user_registration')->where(array('ref_id'=>$user_id,'status'=>'2'))->get()->result();
  }
}//end class
?>