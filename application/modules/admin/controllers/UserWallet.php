<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/UserWallet
*/
class UserWallet extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("user_wallet_model");
		$this->load->model("account_model");
		$this->load->model('member_model');
	}//end constructor 
	public function userWalletBalance()
	{
		$data=array();
		$data['all_user_wallet_balance']=$this->user_wallet_model->getAllUserWalletBalance();

		_adminLayout("user-wallet-mgmt/user-wallet-balance",$data);
	}
	public function manageUserWallet()
	{
		$data=array();
		_adminLayout("user-wallet-mgmt/manage-user-wallet",$data);
	}
	/*
    @Desc: It's accept ajax request to return or show user wallet balance
	*/
	public function getUserEwalletBalance($user_id)
	{
		
		//$user_detai=get_user_details($user_id);
		
		$userinfo=$this->account_model->getUserDetails($user_id);
		
		if(!empty($userinfo) && count($userinfo)>0)
		{
		$current_balance=$this->user_wallet_model->getEwalletBalance($userinfo->user_id);
		//@Note: 'user'=>'1' denotes that user exists
		$this->output->set_content_type('application/json')->set_output(json_encode(array('user'=>'1','balance'=>number_format($current_balance,2))));
		}
		else 
		{
		//@Note:'user'=>'0' denotes that user does not exists	
		 $this->output->set_content_type('application/json')->set_output(json_encode(array('user'=>'0')));	
		}
	}
	/*
	@Desc: It's used to add fund to user wallet
	*/
	public function addFundToUserWallet()
	{
		if(!empty($this->input->post('btn')))
		{
			$username=$this->input->post('username');
			$userinfo=$this->account_model->getUserDetails($username);
			if(empty($username))
			{
				$this->session->set_flashdata('error_msg','<h5>Please enter Username/UserID</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;	
			}
			if(empty($userinfo) || count($userinfo)<=0)
			{
				$this->session->set_flashdata('error_msg','<h5>Sorry entered user does not exist!</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;
			}
			$user_id=$userinfo->user_id;
			$amount=$this->input->post('amount');
			$desciption=$this->input->post('desciption');
			if(!is_numeric($amount) || $amount<=0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please enter valid amount!</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;
			}
			$transaction_password=$this->input->post('transaction_password');
			$company_details=get_user_details(COMP_USER_ID);
			if($transaction_password != $company_details->t_code)
			{
				$this->session->set_flashdata('error_msg','<h5>Please enter valid Transaction password!</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;
			}
			$current_user_balance=$this->user_wallet_model->getEwalletBalance($user_id);
            /*
			'1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update,'11'=>debit for fund transfer,'12'=> credit by fund transfer, '13'=>Debit Amount for Withdrawl wallet amount request, '14'=>withdrawal request cancel refund, '15'=>deposit request credit,'16'=>debit for Epin purchased from E-wallet,'17'=>Credit for add fund by admin, '18'=>Debit for deduct fund by admin,'19'=>fund transfer by admin to user,'20'=> fund add by admin to self,'21'=>Deduct user fund credit to admin
            */
			$updated_user_balance=$current_user_balance+$amount;
			//@Wallet balance is updated
			$this->db->update("final_e_wallet",array('amount'=>$updated_user_balance),array('user_id'=>$user_id));
			//'17'=>Credit for add fund by admin
			/*
			Note: status field '0'=>debit,'1'=>credit
			*/
			$this->db->insert('credit_debit',array(
							    'transaction_no'=>generateUniqueTranNo(),
							    'user_id'=>$user_id,
							    'credit_amt'=>$amount,
							    'debit_amt'=>'0',
							    'balance'=>$updated_user_balance,
							    'admin_charge'=>'0',
							    'receiver_id'=>$user_id,
							    'sender_id'=>COMP_USER_ID,
							    'receive_date'=>date('d-m-Y'),
							    'ttype'=>'Fund add by admin',
							    'TranDescription'=>'Fund add by admin',
							    'Cause'=>'Fund add by admin',
							    'Remark'=>'Fund add by admin',
							    'invoice_no'=>'',
							    'product_name'=>'',
							    'status'=>'1',
							    'ewallet_used_by'=>'',
							    'current_url'=>site_url(),
							    'reason'=>'17'
						        ));
				$this->session->set_flashdata('flash_msg','<span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet');
			redirect(site_url() . "admin/UserWallet/manageUserWallet");
			exit;

		}//end isset if
	}//end method
	/*
	@Desc: It's used to deduct fund from user wallet
	*/
	public function deductFundFromUserWallet()
	{
		if(!empty($this->input->post('btn')))
		{
			$username=$this->input->post('username');
			$userinfo=$this->account_model->getUserDetails($username);
			if(empty($username))
			{
				$this->session->set_flashdata('error_msg','<h5>Please enter Username/UserID</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;	
			}
			if(empty($userinfo) || count($userinfo)<=0)
			{
				$this->session->set_flashdata('error_msg','<h5>Sorry entered user does not exist!</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;
			}
			$user_id=$userinfo->user_id;
			$amount=$this->input->post('amount');
			$desciption=$this->input->post('desciption');
			if(!is_numeric($amount) || $amount<=0)
			{
				$this->session->set_flashdata('error_msg','<h5>Please enter valid amount!</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;
			}
			$transaction_password=$this->input->post('transaction_password');
			$company_details=get_user_details(COMP_USER_ID);
			if($transaction_password != $company_details->t_code)
			{
				$this->session->set_flashdata('error_msg','<h5>Please enter valid Transaction password!</h5>');
				redirect(site_url() . "admin/UserWallet/manageUserWallet");
				exit;
			}

			$current_user_balance=$this->user_wallet_model->getEwalletBalance($user_id);
			$updated_user_balance=$current_user_balance-$amount;
			//@Wallet balance is updated
			$this->db->update("final_e_wallet",array('amount'=>$updated_user_balance),array('user_id'=>$user_id));
			//'18'=>Debit for deduct fund by admin
			/*
			Note: status field '0'=>debit,'1'=>credit
			*/
			$this->db->insert('credit_debit',array(
						    'transaction_no'=>generateUniqueTranNo(),
						    'user_id'=>$user_id,
						    'credit_amt'=>0,
						    'debit_amt'=>$amount,
						    'balance'=>$updated_user_balance,
						    'admin_charge'=>'0',
						    'receiver_id'=>COMP_USER_ID,
						    'sender_id'=>$user_id,
						    'receive_date'=>date('d-m-Y'),
						    'ttype'=>'Fund deduct by admin',
						    'TranDescription'=>'Fund deduct by admin',
						    'Cause'=>'Fund deduct by admin',
						    'Remark'=>'Fund deduct by admin',
						    'invoice_no'=>'',
						    'product_name'=>'',
						    'status'=>'0',
						    'ewallet_used_by'=>'',
						    'current_url'=>site_url(),
						    'reason'=>'18'
					        ));
			$this->session->set_flashdata('flash_msg','<span class="text-semibold">Well done!</span> Amount Deduct Successfully in User Wallet');
			redirect(site_url() . "admin/UserWallet/manageUserWallet");
			exit;
		}
	}
	public function pendingDepositRequestList()
	{
		$data=array();
        $data['wallet_deposit_request']=$this->user_wallet_model->getAllPendingWalletDepositRequest();
		//pr($data['wallet_deposit_request']);
		_adminLayout("user-wallet-mgmt/pending-deposit-request",$data);
	}	
	public function approveDepositRequest($request_id)
	  {
	    $id=ID_decode($request_id);
	    $this->db->update(
	      'deposit_wallet_amount_request',
	      array('status'=>'1', 'response_date'=>date("Y-m-d H:i:s")),
	      array('id'=>$id)
	      );
	    $request=$this->db->select(array(
	      'd.id',
	      'd.amount as deposit_amount',
	      'w.amount as wallet_amount',
	      'w.user_id',
	      ))
	      ->from('deposit_wallet_amount_request as d')
	      ->join('final_e_wallet as w', 'w.user_id=d.user_id')
	      ->where('d.id', $id)
	      ->get()
	      ->row();
	    //pr($request);
	    $final_balance=$request->wallet_amount+$request->deposit_amount;
	    
	    $this->db->update("final_e_wallet",array('amount'=>$final_balance),array('user_id'=>$request->user_id));

	    $insert_data_credit_debit=array(
	            'transaction_no'=>generateUniqueTranNo(),
	            'user_id'=>$request->user_id,
	            'credit_amt'=>$request->deposit_amount,
	            'balance'=>$final_balance,
	            'receiver_id'=>$request->user_id,
	            'sender_id'=>COMP_USER_ID,
	            'receive_date'=>date('d-m-Y'),
	            'ttype'=>'Wallet Deposit Amount',
	            'TranDescription'=>'Wallet deposit amount is credit into member ewallet',
	            'deposit_id'=>$request->id,
	            'status'=>'1', ///it's indicate credit status
	            'reason'=>'15' //it's indicate deposit request credit
	    );//end credit debit data
	    $this->db->insert('credit_debit',$insert_data_credit_debit);
	    //echo $this->db->last_query();
	    $this->session->set_flashdata('flash_msg','<span class="text-semibold">Well done!</span> Deposit request is approved successfully');
	    redirect(site_url()."admin/UserWallet/approvedDepositRequestList");
	    exit;
	}  
	public function approvedDepositRequestList()
	{
		$data=array();
		$data['wallet_deposit_request']=$this->user_wallet_model->getAllApprovedWalletDepositRequest();
		_adminLayout("user-wallet-mgmt/approved-deposit-request",$data);
	}	
	public function cancelledDepositRequestList()
	{
		$data=array();
		$data['wallet_deposit_request']=$this->user_wallet_model->getAllCancelledWalletDepositRequest();
		_adminLayout("user-wallet-mgmt/cancelled-deposit-request",$data);
	}	
    public function cancelWalletDepositRequest($deposit_id)
    {
	    $id=ID_decode($deposit_id);
	    $this->db->update('deposit_wallet_amount_request', array('status'=>'2','response_date'=>date("Y-m-d H:i:s")), array('id'=>$id));
	    $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Pending wallet amount deposit request is cancelld!</h5>');
		$this->session->set_flashdata('flash_msg','<span class="text-semibold">Well done!</span> Deposit request is cancelled successfully');
		redirect(site_url()."admin/UserWallet/cancelledDepositRequestList");
		exit;
    }

}//end class