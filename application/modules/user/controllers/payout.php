<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/payout
*/
class Payout extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('ewallet_model');
		$this->load->model('payout_model');
	} 
	/*
	@Desc: It's used to generate unique withdrawl request id
	*/
	public function generateUniqueWithdrawlRequestId()
	{
	    $random_number="M".mt_rand(100000, 999999);
	    if($this->db->select('request_id')->from('withdrawl_wallet_amount_request')->where('request_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueWithdrawlRequestId();
	    }
	    return $random_number;
	}
	/*
	@Desc:Validation method
	*/
	public function check_valid_tran_password($password)
	{
		if(empty($password))
		{
		$this->form_validation->set_message('check_valid_tran_password','Please enter Transaction Password!');
		  return false;
		}
		else 
		{
			$query=$this->db->query("SELECT * FROM (`user_registration`) WHERE (`user_id` = '$this->userId') AND `t_code` = '$password'");
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_tran_password','Please enter valid Transaction Password!');
			  return false;
			}
		}
		return true;
	}//end method
	public function check_valid_request_amount($amount)
	{
	  if(empty($amount))
	  {
		$this->form_validation->set_message('check_valid_amount','Please enter amount!');
		  return false;
	  }
	  else 
	  {
	  	$user=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$this->userId)->get()->row();
	  	$exist_amount=$user->amount;
	  	if($amount>$exist_amount)
	  	{
		  $this->form_validation->set_message('check_valid_amount',"Sorry you don't have sufficent balance into your ewallet");
			  return false;
        return false;
	  	}
	  }
	  return true;
	}//end method
	/*
	@Desc: It's used to Withdrawl Fund from Ewallet
	*/
	public function withdrawlMyFund()    
	{  
	$current_balance = $this->ewallet_model->getEwalletBalance($this->userId);   
	if (!empty($this->input->post('btn'))) 
	{  
           $request_title  = $this->input->post('request_title'); 
           $request_amount = $this->input->post("request_amount"); 
           $payout_method  = $this->input->post("payout_method");   
		   if ($payout_method == '') 
		   {
			   $this->session->set_flashdata("error_msg", '<h5 class="panel-title" style="color:green">Please choose payment method</h5>');
			   redirect(site_url() . "user/payout/withdrawlMyFund"); 
               exit();   
			   }       
			   $result1 = $this->db->query("select * from user_registration where user_id='" . $this->userId . "'")->result_array();     
			   if ($payout_method == 1) 	
				   {    
if ($result1[0]['bank_name'] == '' || $result1[0]['branch_name'] == '' || $result1[0]['account_holder_name'] == '' || $result1[0]['account_no'] == '')
				   {
					   $this->session->set_flashdata("error_msg", '<h5 class="panel-title" style="color:green">Please fill your bank detail  in profile section</h5>');    
					   redirect(site_url() . "user/payout/withdrawlMyFund"); 
					   exit();  
					} 
					} 
					$final_balance = $current_balance - $request_amount;          
					$this->load->library('form_validation');           
					$this->form_validation->set_rules('request_amount', 'Request Amount', 'callback_check_valid_request_amount');                    $this->form_validation->set_rules('tran_password', 'Username', 'callback_check_valid_tran_password');                        $this->form_validation->set_rules('tran_password', 'Username', 'callback_check_valid_amount');                                   if (!$this->form_validation->run() == false) 
					{  
				$this->db->insert('withdrawl_wallet_amount_request', array('request_id' => $this->generateUniqueWithdrawlRequestId(),'amount' => $request_amount,'user_id' => $this->userId,'title' => $request_title,'payment_method' => $payout_method)); 
				$this->db->update('final_e_wallet', array('amount' => $final_balance), array('user_id' => $this->userId)); 

				$insert_data_credit_debit = array(
				'transaction_no' => generateUniqueTranNo(),
				'user_id' => $this->userId,
				'debit_amt' => $request_amount,
				'balance' => $final_balance,
				'receiver_id' => $this->userId,
				'sender_id' => $this->userId,
				'receive_date' => date('d-m-Y'),
				'ttype' => 'Withdrawal Request amount',
				'TranDescription' => 'Withdrawal Request amount deduction',
				'status' => '0',
				'reason' => '13'
				);
				
				$this->db->insert('credit_debit',$insert_data_credit_debit); 
				
				$this->session->set_flashdata("flash_msg", '<h5 class="panel-title" style="color:green">Your withdrawl request is processed successfully!</h5>');       
				redirect(site_url() . "user/payout/withdrawlMyFund");        
				}     
				}    
				$data['title']  = 'Withdrawl My Fund';    
				$data['current_balance'] = $current_balance;   
				_userLayout("payout-mgmt/withdrawl-my-fund", $data);  
				}
	
	public function completedPayoutRequestList()
	{
		$data['title']='Payout Completed';
		$data['all_completed_request']=$this->payout_model->getAllCompletedPayoutRequest($this->userId);
		_userLayout("payout-mgmt/completed-payout-request-list",$data);
	}
	/*
	@Desc: It's used to view the pending payout request list
	*/
	public function pendingPayoutRequestList()
	{
		$data['title']='Pending Payout';
		$data['all_pending_request']=$this->payout_model->getAllPendingPayoutRequest($this->userId);
		_userLayout("payout-mgmt/pending-payout-request-list",$data);
	}
	/*
	@Desc: It's used to view the cancelled payout request list
	*/
	public function cancelledPayoutRequestList()
	{
		$data['title']='Cancelled Payout';
		$data['all_cancelled_request']=$this->payout_model->getAllCancelledPayoutRequest($this->userId);
		_userLayout("payout-mgmt/cancelled-payout-request-list",$data);
	}

}//end class
