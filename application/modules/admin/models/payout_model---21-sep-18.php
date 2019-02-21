<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/payout_model
*/
class Payout_Model extends Common_Model
{
  public function __construct()
  {
    //@call to parent CI_Model constructor
    parent::__construct();
  }
  public function getAllMemberWalletAmount()
   {
   	$res=$this->db->select(array('u.*', 'w.amount'))->from('user_registration as u')->join('final_e_wallet as w','w.user_id=u.user_id')->order_by('u.id','desc')->get()->result();
   	$result=(!empty($res) && count($res)>0)?$res:array();
   	return $result;
   }
   /*
   @Desc: It's return the collection of all pending wallet withdrawl request
   */ 
   public function getAllActivePayoutRequest()
   {
    $res=$this->db->select(array(
      'w.id', 
      'w.request_id', 
      'w.title',
      'w.amount as request_amount',
      'w.request_date',
      'w.response_date',
      'u.user_id',
      'u.username',
      'u.email',
      'u.contact_no',
      'ww.amount as ewallet_amount'
       ))
       ->from('withdrawl_wallet_amount_request as w')
       ->join('user_registration as u' ,'u.user_id=w.user_id')
       ->join('final_e_wallet as ww', 'ww.user_id=u.user_id')
       ->where(array('w.status'=>'0')) //statis 0 is used for pending request
       ->order_by('id', 'desc')
       ->get()->result();
       ;
       $result=(!empty($res))?$res:array();
       return $result;
   }
   /*
   @Desc: It's return the collection of all approved wallet withdrawl request
   */ 
   public function getAllCompletedPayoutRequest()
   {
    $res=$this->db->select(array(
      'w.id', 
      'w.request_id', 
      'w.title',
      'w.amount as request_amount',
      'w.request_date',
      'w.response_date',
      'u.user_id',
      'u.username',
      'u.email',
      'u.contact_no',
      'ww.amount as ewallet_amount'
       ))
       ->from('withdrawl_wallet_amount_request as w')
       ->join('user_registration as u' ,'u.user_id=w.user_id')
       ->join('final_e_wallet as ww', 'ww.user_id=u.user_id')
       ->where(array('w.status'=>'1'))//statis 1 is used for approved request
       ->order_by('id', 'desc')
       ->get()->result();
       ;
       $result=(!empty($res))?$res:array();
       return $result;
   }
   /*
   @Desc: It's return the collection of all Cancelled wallet withdrawl request
   */ 
   public function getAllCancelledPayoutRequest()
   {
    $res=$this->db->select(array(
      'w.id', 
      'w.request_id', 
      'w.title',
      'w.amount as request_amount',
      'w.request_date',
      'w.response_date',
      'u.user_id',
      'u.username',
      'u.email',
      'u.contact_no',
      'ww.amount as ewallet_amount'
       ))
       ->from('withdrawl_wallet_amount_request as w')
       ->join('user_registration as u' ,'u.user_id=w.user_id')
       ->join('final_e_wallet as ww', 'ww.user_id=u.user_id')
       ->where(array('w.status'=>'2')) //statis 0 is used for pending request
       ->order_by('id', 'desc')
       ->get()->result();
       ;
       $result=(!empty($res))?$res:array();
       return $result;
   }//end method   
}//end class
?>