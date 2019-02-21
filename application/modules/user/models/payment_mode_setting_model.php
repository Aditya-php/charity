<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/payment_mode_setting_model
*/
class payment_mode_setting_model extends Common_Model
{
  public function __construct()
  {
    //@call to parent CI_Model constructor
    parent::__construct();
  }
  public function getBankWirePaymentDetailsList($user_id,$id=null)
  {
    if(!empty($id))
      return $this->db->select('*')->from('bank_wire_payment_details')->where(array('user_id'=>$user_id,'id'=>$id))->get()->row();
    else 
      return $this->db->select('*')->from('bank_wire_payment_details')->where('user_id',$user_id)->get()->result();


  }
  public function getMobileMoneyProviderList($user_id,$id=null)
  {
    if(!empty($id))
      return $this->db->select('*')->from('mobile_money_provider_payment_details')->where(array('user_id'=>$user_id,'id'=>$id))->get()->row();
    else
      return $this->db->select('*')->from('mobile_money_provider_payment_details')->where('user_id',$user_id)->get()->result();

  }
  public function getPayeerPaymentDetailsList($user_id,$id=null)
  {
    if(!empty($id))
      return $this->db->select('*')->from('payeer_payment_details')->where(array('user_id'=>$user_id,'id'=>$id))->get()->row();
    else 
      return $this->db->select('*')->from('payeer_payment_details')->where('user_id',$user_id)->get()->result();

  }
  public function getPerfecMoneyPaymentDetailsList($user_id,$id=null)
  {
    if(!empty($id))
      return $this->db->select('*')->from('perfect_money_payment_details')->where(array('user_id'=>$user_id,'id'=>$id))->get()->row();
    else 
      return $this->db->select('*')->from('perfect_money_payment_details')->where('user_id',$user_id)->get()->result();
  }
  public function getBitCoinPaymentDetailsList($user_id,$id=null)
  {
    if(!empty($id))
      return $this->db->select('*')->from('bit_coin_payment_details')->where(array('user_id'=>$user_id,'id'=>$id))->get()->row();
    else 
      return $this->db->select('*')->from('bit_coin_payment_details')->where('user_id',$user_id)->get()->result();
  }
}//end class
?>