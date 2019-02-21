<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/ewallet
*/
class Ewallet extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->load->model('ewallet_model');
		$this->load->model('member_model');
		$this->load->model('account_model');
		$this->userId=$this->session->userdata('user_id');
	} 
	/*
	@Desc: It's used to view the ewallet balance
	*/
	public function viewEwalletBalance()
	{
		$data['title']='Ewallet Balance';
		$data['ewallet_balance']=$this->ewallet_model->getEwalletBalance($this->userId);
		_userLayout("ewallet-mgmt/view-ewallet-balance",$data);
	}
	/*
	@Desc: Validation method
	*/
	public function check_valid_username()
	{
		$username=$this->input->post('username');
		
		if(empty($username))
		{
		$this->form_validation->set_message('check_valid_username','Please enter Username/userid!');
		  return false;
		}
		else 
		{
			$self_info=get_user_details($this->userId);
			
			$is_exists=$this->db->select('id')->from('user_registration')->where(array('username'=>$username))->or_where('user_id',$username)->get()->num_rows();
			
			$transfer_user=get_user_details($username);
			
			if($self_info->username==$username || $self_info->user_id==$username)
			{
				$this->form_validation->set_message('check_valid_username',"Fund can't be transfer to self member!");
				return false;	
			}
			if($is_exists<=0)
			{
				$this->form_validation->set_message('check_valid_username','Sorry entered  Username or userid does not exist!');
				return false;
			}
			if($transfer_user->active_status=='0')
			{
				$this->form_validation->set_message('check_valid_username','Sorry entered  Username or userid is not active right now!');
				return false;
			}
		}
		return true;
	}//end method
	/*
	@Desc:Validation method
	*/
	public function check_valid_tran_password($password)
	{
		$username=$this->input->post('username');
		
		
		if(empty($password))
		{
		$this->form_validation->set_message('check_valid_tran_password','Please enter Transaction Password!');
		  return false;
		}
		else 
		{

			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE `user_id` = '".$this->userId."' AND `t_code` = '$password'");
			
			
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_tran_password','Please enter valid Transaction Password!');
			  return false;
			}
		}
		return true;
	}//end method
	public function check_valid_amount($amount)
	{
	  $username=$this->input->post('username');
	  if(empty($amount))
	  {
		$this->form_validation->set_message('check_valid_amount','Please enter amount!');
		  return false;
	  }
	  else 
	  {
		  
		if(!is_numeric($amount) || $amount<=0)
		{
			$this->form_validation->set_message('check_valid_amount',"please enter valid amount!");
			return false;
		}			
	  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
	  	$exist_amount=$user->amount;
	  	if($amount>$exist_amount)
	  	{
		  $this->form_validation->set_message('check_valid_amount',"Sorry you don't have sufficient balance into your E-wallet");
		  return false;
	  	}
	  }
	  return true;
	}//end method
	/*
	@Desc: It's used to purchase the fund
	*/
	public function purchaseFund()
	{
	$data['title']='Purchase Fund';
	$data['current_balance']=$this->ewallet_model->getEwalletBalance($this->userId);
    if(!empty($this->input->post('btn')))
    {
	    $image_upload_path='/images/';
	    $deposit_proof=adImageUpload($_FILES['deposit_proof'],1, $image_upload_path);
	    $deposit_proof=(!empty($deposit_proof))?$deposit_proof:'';
       	$this->db->insert('deposit_wallet_amount_request',array(
       	'deposit_id'=>$this->generateUniqueDepositRequestId(),
       	'user_id'=>$this->userId,
       	'amount'=>$this->input->post('deposit_amount'),
       	'title'=>$this->input->post('deposit_title'),
       	'file_proof'=>$deposit_proof
       	));
        $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> You purchase fund request sent successfully!');
        redirect(site_url()."user/ewallet/purchaseFund");
     }//end submit if here
	_userLayout("ewallet-mgmt/purchase-fund",$data);
	}
	/*
	@Desc: It's used to transfer the ewallet fund
	*/
	public function ewalletFundTransfer()
	{
		$data['title']='E-Wallet Fund Transfer';
		if(!empty($this->input->post('btn')))
		{
		 $username=$this->input->post('username');
		 $amount=$this->input->post('amount');
		 $tran_password=$this->input->post('tran_password');
		 $this->load->library('form_validation');
		 
		 $this->form_validation->set_rules('username','Username','required');
		 $this->form_validation->set_rules('username','Username','callback_check_valid_username');
		 
		 $this->form_validation->set_rules('amount','Amount','callback_check_valid_amount');
		 
		 $this->form_validation->set_rules('tran_password','Username','callback_check_valid_tran_password');
		 
		 $this->form_validation->set_error_delimiters('<div class="col-md-12">
            <div class="alert alert-danger alert-styled-left alert-arrow-left alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>','</div>
				</div>');
		 
		 if(!$this->form_validation->run()==false)
		  {
		  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
		  	$final_balance=$user->amount-$amount;
		  	$this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$this->userId));
			$to_user=$this->member_model->getUserId($username);

			//@debit entry
			$this->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$this->userId,
					'credit_amt'=>null,
					'debit_amt'=>$amount,
					'balance'=>$final_balance,
					'admin_charge'=>'0',
					'receiver_id'=>$to_user,
					'sender_id'=>$this->userId,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'Fund Transfer Debit Amount',
					'TranDescription'=>'Fund Transfer Debit Amount',
					'status'=>'0',//debit amount
					'current_url'=>site_url(),
					'reason'=>'11'//debit amount for fund transfer
					));
		  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$to_user)->get()->row();
		  	$final_balance=$user->amount+$amount;
		  	$this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$to_user));
			//@credit entry
			$this->db->insert('credit_debit',array(
					'transaction_no'=>generateUniqueTranNo(),
					'user_id'=>$to_user,
					'credit_amt'=>$amount,
					'debit_amt'=>null,
					'balance'=>$final_balance,
					'admin_charge'=>'0',
					'receiver_id'=>$to_user,
					'sender_id'=>$this->userId,
					'receive_date'=>date('d-m-Y'),
					'ttype'=>'Fund Transfer Credit Amount',
					'TranDescription'=>'Fund Transfer Credit Amount',
					'status'=>'1',//credit amount
					'current_url'=>site_url(),
					'reason'=>'12'//credit amount by fund transfer
					));
	        $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span>fund transfer is done successfully!');
	        redirect(site_url()."user/ewallet/ewalletFundTransfer");
			 exit;
		  }//end form validation if here!
		}
		
        $data['all_active_members']=$this->db->select(array('u.user_id','u.username'))
                                             ->from('user_registration as u')
                                             ->where(array('u.active_status'=>'1'))
                                             ->get()->result();
		_userLayout("ewallet-mgmt/ewallet-fund-transfer",$data);
	}
	/*
	@Desc: It's used to generate unique deposit request id
	*/
	public function generateUniqueDepositRequestId()
	{
	    $random_number="D".mt_rand(100000, 999999);
	    if($this->db->select('deposit_id')->from('deposit_wallet_amount_request')->where('deposit_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueDepositRequestId();
	    }
	    return $random_number;
	}
	/*End method*/
	/*
	*/
	public function viewEwalletStatement()
	{
		$data=array();
        //$all_statements=$this->ewallet_model->getEwalletStatements($this->userId);
		//$data['all_statements']=$all_statements;
		_userLayout("ewallet-mgmt/view-ewallet-statement",$data);
	}//end method
	
	public function ajax_ewallet_statement()
	{
		$result=$this->ewallet_model->getAjaxEwalletStatements($this->userId);
		echo json_encode($result);
		
	}//end method
	public function allFundTransfer()
	{
		$data['all_statements']=$this->ewallet_model->getAllFundTransferStatement($this->userId);
		$data['title']='All Fund Transfer';
		_userLayout("ewallet-mgmt/all-fund-transfer",$data);
	}//end method

///////////////////////////
	/*
	@Desc: It's used to  request for wallet amount deposit
	*/
	public function depositWalletAmountRequestList()
	{

	    $data['deposit_request']=$this->ewallet_model->getDepositWalletAmountRequest($this->userId);

	    $data['title']="Deposit Wallet Amount Request List";
	    $data['breadcrumb']='<li class="active">Deposit Wallet Amount Request List</li>';
		_userLayout("ewallet-mgmt/deposit-wallet-amount-request-list",$data);
	}
	/*
	@Desc: It's used to  request for wallet amount deposit
	*/
	public function depositWalletAmountRequest()
	{
      $current_balance=$this->ewallet_model->getEwalletBalance($this->userId);
      if(!empty($this->input->post('btn')))
       {

	        $image_upload_path='/images/';
	        $deposit_proof=adImageUpload($_FILES['deposit_proof'],1, $image_upload_path);
	        $deposit_proof=(!empty($deposit_proof))?$deposit_proof:'';
       	   $this->db->insert('deposit_wallet_amount_request',array(
       		'deposit_id'=>$this->generateUniqueDepositRequestId(),
       		'user_id'=>$this->userId,
       		'amount'=>$this->input->post('deposit_amount'),
       		'title'=>$this->input->post('deposit_title'),
       		'file_proof'=>$deposit_proof
       		));
        $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Your deposit request is processed successfully!</h5>');
        redirect(site_url()."user/ewallet/depositWalletAmountRequestList");
       }//end submit if here
	    $data['title']="Deposit Wallet Amount Request";
	    $data['current_balance']=$current_balance;
	    $data['action']='add';
	    $data['action_url']='depositWalletAmountRequest';
	    $data['breadcrumb']='<li class="active">Deposit Wallet Amount Request</li>';
		_userLayout("ewallet-mgmt/deposit-wallet-amount-request",$data);
	}	
	public function getUserDetails()
	{
	  $username=$this->input->post('username');
	  $user_details=$this->account_model->getUserDetails($username);
	  $this->output ->set_content_type('application/json')->set_output(json_encode($user_details)); 
	}

}//end class
