<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/payout_model
*/
class Payout_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
   /*
   @Desc: It's return all the payout request done by specific user
   */ 
   public function getAllPayoutRequest($user_id)
   {
    $allRequet=$this->db->select(array(
      'w.id',
      'w.request_id',
      'w.title',
      'w.amount',
      'w.status',
      'w.request_date',
      'w.response_date',
      ))->from('withdrawl_wallet_amount_request w')->where('w.user_id',$user_id)->get()->result();
    $request=(!empty($allRequet))?$allRequet:array();
    return $request;
   }//end method
   /*
   @Desc: It's return all the completed payout request done by specific user
   */ 
   public function getAllCompletedPayoutRequest($user_id)
   {
    $allRequet=$this->db->select(array(
      'w.id',
      'w.request_id',
      'w.title',
      'w.amount',
      'w.status',
      'w.request_date',
      'w.response_date',
      ))->from('withdrawl_wallet_amount_request w')->where(array('w.user_id'=>$user_id, 'w.status'=>'1'))->get()->result();
    $request=(!empty($allRequet))?$allRequet:array();
    return $request;
   }
   /*
   @Desc: It's return all the pending payout request done by specific user
   */ 
   public function getAllPendingPayoutRequest($user_id)
   {
    $allRequet=$this->db->select(array(
      'w.id',
      'w.request_id',
      'w.title',
      'w.amount',
      'w.status',
      'w.request_date',
      'w.response_date',
      ))->from('withdrawl_wallet_amount_request w')->where(array('w.user_id'=>$user_id, 'w.status'=>'0'))->get()->result();
    $request=(!empty($allRequet))?$allRequet:array();
    return $request;
   }
   /*
   @Desc: It's return all the cancelled payout request done by specific user
   */ 
   public function getAllCancelledPayoutRequest($user_id)
   {
    $allRequet=$this->db->select(array(
      'w.id',
      'w.request_id',
      'w.title',
      'w.amount',
      'w.status',
      'w.request_date',
      'w.response_date',
      ))->from('withdrawl_wallet_amount_request w')->where(array('w.user_id'=>$user_id, 'w.status'=>'2'))->get()->result();
    $request=(!empty($allRequet))?$allRequet:array();
    return $request;
   }
}//end class
?>