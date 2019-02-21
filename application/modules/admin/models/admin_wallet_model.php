<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/admin_wallet_model
*/
class Admin_Wallet_Model extends Common_Model
{
    public function __construct()
    {
	    //@call to parent CI_Model constructor
	    parent::__construct();
    }
  	public function getEwalletStatements($user_id)
    {
	    $statementQuery=$this->db->select('cd.transaction_no,cd.status, cd.user_id, cd.credit_amt, cd.debit_amt, cd.balance, cd.ttype as title, cd.TranDescription as description, cd.create_date as date, cd.receiver_id,cd.sender_id,cd.reason')->from('credit_debit as cd')
	    ->join('user_registration as u', 'u.user_id=cd.user_id')
	    ->order_by('cd.id','DESC')
	    ->where('u.user_id',$user_id)
	    ->get();
	    $result=$statementQuery->result();
	    $result=(!empty($result))?$result:array();
	    return $result;
    }//end method
 	public function getEwalletBalance($user_id)
  	{
	     $res=$this->db->select('amount')->from('final_e_wallet')->where('user_id', $user_id)->get()->row();
	     $balance=(!empty($res->amount))?$res->amount:0;
	     return $balance;   
  	}//end method
}//end class
?>