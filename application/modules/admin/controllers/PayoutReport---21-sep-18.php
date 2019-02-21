<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/PayoutReport
*/
class PayoutReport extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("payout_model");
	}//end constructor 
	public function activePayout()
	{
		$data=array();
		$data['all_active_payout']=$this->payout_model->getAllActivePayoutRequest();
		//pr($data['all_active_payout']);
		_adminLayout("payout-report-mgmt/active-payout",$data);
	}
	public function payoutCompleted()
	{
		$data=array();
		$data['all_completed_payout_request']=$this->payout_model->getAllCompletedPayoutRequest();
		//pr($this->payout_model->getAllCompletedPayoutRequest());die;
		_adminLayout("payout-report-mgmt/payout-completed",$data);
	}
	public function payoutCancelled()
	{
		$data=array();
		$data['all_cancelled_payout_request']=$this->payout_model->getAllCancelledPayoutRequest();
		_adminLayout("payout-report-mgmt/payout-cancelled",$data);
	}
	public function payoutGraph()
	{
		$data=array();
		_adminLayout("payout-report-mgmt/payout-graph",$data);
	}
	public function approvePayoutRequest($request_id)
	{
	    $id=ID_decode($request_id);
	    $this->db->update(
	      'withdrawl_wallet_amount_request',
	      array('status'=>'1', 'response_date'=>date("Y-m-d H:i:s")),
	      array('id'=>$id)
	      );
	    $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is approved successfully');
	    redirect(site_url()."admin/PayoutReport/payoutCompleted");
	}
	public function cancelPayoutRequest($request_id)
	{
	    $id=ID_decode($request_id);
	    $this->db->update('withdrawl_wallet_amount_request', array('status'=>'2', 'response_date'=>date("Y-m-d H:i:s")), array('id'=>$id));
	    $request=$this->db->select('*')->from('withdrawl_wallet_amount_request')->where('id',$id)->get()->row();
	    $wallet=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$request->user_id)->get()->row();
	    $final_balance=$wallet->amount+$request->amount;
	    $this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$request->user_id));
	    $insert_data_credit_debit=array(
	            'transaction_no'=>generateUniqueTranNo(),
	            'user_id'=>$request->user_id,
	            'credit_amt'=>$request->amount,
	            'balance'=>$final_balance,
	            'receiver_id'=>$request->user_id,
	            'sender_id'=>COMP_USER_ID,
	            'receive_date'=>date('d-m-Y'),
	            'ttype'=>'withdrawl request cancelled refund',
	            'TranDescription'=>'withdrawl request cancelld refund',
	            'status'=>'1', ///it's indicate credit status
	            'reason'=>'14' //it's indicate withdrawal request cancel refund
	            );//end credit debit data
	    $this->db->insert('credit_debit',$insert_data_credit_debit);
	    $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is cancelled successfully');
	    redirect(site_url()."admin/PayoutReport/payoutCancelled");
	}
}//end class