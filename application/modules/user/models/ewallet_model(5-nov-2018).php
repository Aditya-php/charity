<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/ewallet_model
*/
class Ewallet_Model extends Common_Model
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
  public function getEwalletStatements($user_id)
   {
      $statementQuery=$this->db->select('cd.transaction_no,cd.status, cd.user_id, cd.credit_amt, cd.debit_amt, cd.balance, cd.ttype as title, cd.TranDescription as description, cd.create_date as date,cd.reason,cd.receiver_id,cd.sender_id,cd.level')->from('credit_debit as cd')
      ->join('user_registration as u', 'u.user_id=cd.user_id')
      ->order_by('cd.id','DESC')
      ->where('u.user_id',$user_id)
      ->get();
      $result=$statementQuery->result();
      $result=(!empty($result))?$result:array();
      return $result;
   }//end method
   public function getAllFundTransferStatement($user_id)
   {
    $query="select u.username,cd.transaction_no, cd.credit_amt, cd.debit_amt, cd.receiver_id, cd.sender_id,cd.status, cd.receive_date from credit_debit as cd left join user_registration as u on u.user_id=cd.user_id where cd.user_id='$user_id' and (cd.reason='11') order by cd.id desc";
    $query=$this->db->query($query);
    //echo $this->db->last_query();
    //die;
    $result=(!empty($query->result()))?$query->result():array();
    return $result;
   }//end method  
  /*
   @Desc: It's return collection of all the withdrawl request for specific user
   */ 
   public function getDepositWalletAmountRequest($user_id)
   {
    $allRequet=$this->db->select(array(
      'd.id',
      'd.deposit_id',
      'd.amount',
      'd.title',
      'd.file_proof',
      'd.status',
      'd.request_date',
      'd.response_date'
      ))->from('deposit_wallet_amount_request d')->where('user_id',$user_id)->order_by('id', 'desc')->get()->result();
    $request=(!empty($allRequet))?$allRequet:array();
    return $request;
   }//end method
}//end class
?>