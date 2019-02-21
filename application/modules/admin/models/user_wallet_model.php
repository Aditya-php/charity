<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/User_wallet_model
*/
class User_Wallet_Model extends Common_Model
{
      public function __construct()
      {
            //@call to parent CI_Model constructor
            parent::__construct();
      }
      public function getEwalletBalance($user_id)
      {
           $res=$this->db->select('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
           $balance=(!empty($res->amount))?$res->amount:0;
           return $balance;   
      }//end method
      public function getAllUserWalletBalance()
      {

      	$result=$this->db->select(array('u.user_id', 'u.username', 'u.registration_date', 'u.rank_name', 'u.active_status', 'w.amount as balance'))
      	->from('user_registration as u')
      	->join('final_e_wallet as w', 'w.user_id=u.user_id')
      	->get()
      	->result();
      	//pr($result);
      	return $result;
      }
     /*
     @Desc: It's return the collection of all pending wallet deposit request
     */ 
     public function getAllPendingWalletDepositRequest()
     {
      $res=$this->db->select(array(
        'd.id', 
        'd.deposit_id', 
        'd.title',
        'd.amount as request_amount',
        'd.request_date',
        'd.response_date',
        'd.file_proof',
        'u.user_id',
        'u.username',
        'u.email',
        'u.contact_no',
        'ww.amount as ewallet_amount'
         ))
         ->from('deposit_wallet_amount_request as d')
         ->join('user_registration as u' ,'u.user_id=d.user_id')
         ->join('final_e_wallet as ww', 'ww.user_id=d.user_id')
         ->where(array('d.status'=>'0')) //statis 0 is used for pending request
         ->order_by('id', 'desc')
         ->get()->result();
         ;
         $result=(!empty($res))?$res:array();
         return $result;
     }
     /*
     @Desc: It's return the collection of all approved wallet deposit request
     */ 
     public function getAllApprovedWalletDepositRequest()
     {
      $res=$this->db->select(array(
        'd.id', 
        'd.deposit_id', 
        'd.title',
        'd.amount as request_amount',
        'd.request_date',
        'd.response_date',
        'd.file_proof',
        'u.user_id',
        'u.username',
        'u.email',
        'u.contact_no',
        'ww.amount as ewallet_amount'
         ))
         ->from('deposit_wallet_amount_request as d')
         ->join('user_registration as u' ,'u.user_id=d.user_id')
         ->join('final_e_wallet as ww', 'ww.user_id=d.user_id')
         ->where(array('d.status'=>'1'))//statis 1 is used for approved request
         ->order_by('id', 'desc')
         ->get()->result();
         ;
         $result=(!empty($res))?$res:array();
         return $result;
     }
   /*end method*/ 
     /*
     @Desc: It's return the collection of all pending wallet deposit request
     */ 
     public function getAllCancelledWalletDepositRequest()
     {
      $res=$this->db->select(array(
        'd.id', 
        'd.deposit_id', 
        'd.title',
        'd.amount as request_amount',
        'd.request_date',
        'd.response_date',
        'd.file_proof',
        'u.user_id',
        'u.username',
        'u.email',
        'u.contact_no',
        'ww.amount as ewallet_amount'
         ))
         ->from('deposit_wallet_amount_request as d')
         ->join('user_registration as u' ,'u.user_id=d.user_id')
         ->join('final_e_wallet as ww', 'ww.user_id=d.user_id')
         ->where(array('d.status'=>'2')) //statis 0 is used for pending request
         ->order_by('id', 'desc')
         ->get()->result();
         ;
         $result=(!empty($res))?$res:array();
         return $result;
     }//end method
}//end class
?>