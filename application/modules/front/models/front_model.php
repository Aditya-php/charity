<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/Front_Model
*/
class Front_Model extends Common_Model
{
  public function __construct()
  {
        //@call to parent CI_Model constructor
        parent::__construct();
  }
   /*
  @Desc: It's used to just check weather the username or user_id is exist
  */
  public function isUserExist($username)
  {
    $where="(username='$username' || user_id='$username')";
    $total=$this->db->select('id')->from('user_registration')->where($where)->get()->num_rows();
    $where="(username='$username') and (status='0' || status='1')";
    $total1=$this->db->select('id')->from('bank_wired_user_registration')->where($where)->get()->num_rows();
    if($total>0 || $total1>0)
      return true;
    else
      return false;
  }//end method
  public function getBankWirePaymentDetailsList($user_id)
  {
     return $this->db->select('*')->from('bank_wire_payment_details')->where('user_id',$user_id)->get()->result();
  }
  public function getMobileMoneyProviderList($user_id,$id=null)
  {
    return $this->db->select('*')->from('mobile_money_provider_payment_details')->where('user_id',$user_id)->get()->result();
  }
 public function getBitCoinPaymentDetailsList($user_id,$id=null)
  {
     return $this->db->select('*')->from('bit_coin_payment_details')->where('user_id',$user_id)->get()->result();
  }

  public function isUserEmailExist($email)
  {
    $total=$this->db->select('id')->from('user_registration')->where('email',$email)->get()->num_rows();
    if($total>0)
      return true;
    else
      return false;
  }//end method
}//end class
?>