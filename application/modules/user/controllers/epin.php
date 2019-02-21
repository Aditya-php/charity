<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/epin
*/
class Epin extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->userId=$this->session->userdata('user_id');
		$this->load->model('package_model');
		$this->load->model('epin_model');
		$this->load->model('ewallet_model');
		$this->load->model('account_model');
		$this->load->model('member_model');
		if(!isEpinEnabled())
		{
			redirect(site_url().'user/');
			exit;
		}
	} 
	/*
	@Desc: It's used to generate unique deposit request id
	*/
	public function generateUniqueEpinRequestId()
	{
	    $random_number="R".mt_rand(100000, 999999);
	    if($this->db->select('request_id')->from(' epin')->where('request_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueEpinRequestId();
	    }
	    return $random_number;
	}
	/*
	@Desc: It's used to purchase pin request
	*/
	public function purchasePin()
	{
		if(!empty($this->input->post('btn')))
		{
			$form_data=$this->input->post(null);
			$pkg_id_array=$form_data['pkg_id'];
			$epin_amount_array=$form_data['epin_amount'];
			$no_of_epin_array=$form_data['no_of_epin'];
			$request_id=$this->generateUniqueEpinRequestId();
			$payment_method=$this->input->post('select_payment_method');
			if($payment_method=='ewallet')
			{
				$pay_method='0';
				$bank_wire_proof_image=Null;
			}
			else if($payment_method=='bank_wire')
			{
				$pay_method='1';
			    $image_upload_path='/images/';
	            $bank_wire_proof_image=adImageUpload($_FILES['bank_wire_proof_image'],1, $image_upload_path);
			}
			if(!empty($pkg_id_array) && count($pkg_id_array)>0)
			{
				$purchase_pin_data=array();
				foreach ($pkg_id_array as $pkg_details) 
				{
				  $pkg_info=explode('_', $pkg_details);
				  $pkg_id=$pkg_info['0'];
				  $pkg_amount=$pkg_info['1'];
				  list($k1,$epin_amount)=each($epin_amount_array);
				  list($k2,$no_of_epin)=each($no_of_epin_array);
				  $purchase_pin_data[]=array(
				  	'request_id'=>$request_id,
				  	'user_id'=>$this->userId,
				  	'pkg_id'=>$pkg_id,
				  	'pkg_amount'=>$pkg_amount,
				  	'no_of_epin'=>$no_of_epin,
				  	'epin_amount'=>$epin_amount,
				  	'payment_method'=>$pay_method, //'0'=>Ewallet, '1'=>Bank/wire or manual
				  	'bank_wire_proof_image'=>$bank_wire_proof_image
				  	);
                  if($payment_method=='ewallet')
                  {
	                  $current_ewallet_balance=$this->ewallet_model->getEwalletBalance($this->userId)-$epin_amount;
					  $this->db->update('final_e_wallet',array('amount'=>$current_ewallet_balance),array('user_id'=>$this->userId));
					  $this->db->insert('credit_debit',array(
					  	'transaction_no'=>generateUniqueTranNo(),
					  	'user_id'=>$this->userId,
					  	'debit_amt'=>$epin_amount,
					  	'balance'=>$current_ewallet_balance,
					  	'receiver_id'=>COMP_USER_ID,
					  	'sender_id'=>$this->userId,
					  	'receive_date'=>date('d-m-Y'),
					  	'ttype'=>'Epin Request via Ewallet',
					  	'TranDescription'=>'Epin Request via Ewallet for request id '.$request_id,
					  	'product_name'=>$pkg_id,
					  	'status'=>'0',
					  	'reason'=>'16',//epin request from ewallet
					  	));	                  	
					}//end payment method if here
				}//end foreach
				$this->db->insert_batch('epin',$purchase_pin_data);
			}//end if
            $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Your Epin request is submitted successfully!</h5>');
			redirect(site_url().'user/epin/pendingEpinRequest');
		}//end btn if
		$data['title']='Purchase Pin';
		$user_info=$this->account_model->getUserDetails($this->userId);
		$data['tran_code']=$user_info->t_code;
		$data['ewallet_balance']=$this->ewallet_model->getEwalletBalance($this->userId);
		$data['all_active_package']=$this->package_model->getAllActivePackage();
		_userLayout("epin-mgmt/purchase-pin",$data);
	}
	/*
	@Desc: It's used to view all the pending pin request list
	*/
	public function pendingEpinRequest()
	{
		$data['title']='Pending Epin Request List';
		$data['all_pending_request']=$this->epin_model->getAllPendingEpinRequest($this->userId);
		_userLayout("epin-mgmt/pending-epin-request",$data);
	}
	/*
	@Desc: It's used to view all the approved pin request
	*/
	public function approvedEpinRequest()
	{
		$data['title']='Approved Epin Request List';
		$data['all_approved_request']=$this->epin_model->getAllApprovedEpinRequest($this->userId);
		_userLayout("epin-mgmt/approved-epin-request",$data);
	}
	/*
	@Desc: It's used to view all the fresh pin list
	*/
	public function cancelledEpinRequest()
	{
		$data['title']='Cancelled Epin Request';
		$data['all_cancelled_request']=$this->epin_model->getAllCancelledEpinRequest($this->userId);
		_userLayout("epin-mgmt/cancelled-epin-request",$data);
	}

	/*
	@Desc: It's used to view all the fresh pin list
	*/
	public function freshPinList()
	{
		$data['title']='Fresh Pin List';
		$data['all_fresh_epin']=$this->epin_model->getAllFreshPin($this->userId);
		//pr($data['all_fresh_epin']);
		_userLayout("epin-mgmt/fresh-pin-list",$data);
	}
	/*
	@Desc: It's used to view all the used pin list
	*/
	public function usedPinList()
	{
		$data['title']='Used Pin List';
		$data['all_used_epin']=$this->epin_model->getAllUsedPin($this->userId);
		_userLayout("epin-mgmt/used-pin-list",$data);
	}
	/*
	@Desc: Validation method to check weather the given username or user id exists or not.
	*/
	public function check_valid_username($username)
	{
		if(empty($username))
		{
		$this->form_validation->set_message('check_valid_username','Please enter Receiver Username/Userid!');
		  return false;
		}
		else 
		{
			if($username==$this->userId || $username==get_user_name($this->userId))
			{
				$this->form_validation->set_message('check_valid_username','Sorry Epin can not be assigned to self once again!');
				return false;
			}
			else 
			{
				$this->db->where('username',$username);
				$this->db->or_where('user_id',$username);
				$query=$this->db->select('*')->from('user_registration')->get();
				if($query->num_rows()<1)
				{
				$this->form_validation->set_message('check_valid_username','Please enter valid Receiver username/userid!');
				  return false;
				}
			}
		}
		return true;
	}//end method
	/*
	@Desc: Validation method to check weather the given epin code exists and is fresh pin or not.
	*/
	public function check_valid_epin_code($epin_code)
	{
		//$this->form_validation->set_message('check_valid_username','Please enter Receiver Username/Userid!');
		if(empty($epin_code))
		{
			$this->form_validation->set_message('check_valid_epin_code','Please enter epin code');
			return false;
		}
		else 
		{
			$res=$this->db->select('id')->from('epin_meta')->where(array('epin_code'=>$epin_code,'epin_status'=>'0','user_id'=>$this->userId))->get();
			if($res->num_rows()>0)
			{
				return true;
			}
			else 
			{
				$this->form_validation->set_message('check_valid_epin_code','Please enter valid epin code!');
				return false;
			}
		}
	}//end method
	/*
	@Desc:It's used to transfer epin to another user
	*/
	public function transferEpin($id=null)
	{
		$id=ID_decode($id);
		if(!empty($this->input->post('btn')))
		{
			$username=$this->input->post('username');
			$epin_code=$this->input->post('epin_code');
			$this->form_validation->set_rules('username','Username','callback_check_valid_username');
			$this->form_validation->set_rules('epin_code','Epin Code','callback_check_valid_epin_code');
			if(!$this->form_validation->run()==false)
			{
				$transfer_user_info=$this->db->select('user_id')->from('user_registration')->where('username',$username)->or_where('user_id',$username)->get()->row();
				$transfer_date=date('Y-m-d H:i:s');
				$epin_info=$this->db->select('*')->from('epin_meta')->where(array('epin_code'=>$epin_code,'user_id'=>$this->userId))->get()->row();
				$this->db->update('epin_meta',array('epin_status'=>'2','status_change_date'=>$transfer_date), array('epin_code'=>$epin_code,'user_id'=>$this->userId));
				$this->db->insert('epin_meta',array(
					'epin_request_id'=>$epin_info->epin_request_id,
					'sequence_number'=>'1',
					'epin_code'=>$epin_code,
					'user_id'=>$transfer_user_info->user_id,
					'source_user_id'=>$this->userId,
					'pkg_id'=>$epin_info->pkg_id,
					'pkg_amount'=>$epin_info->pkg_amount,
					'epin_status'=>'0',
					));
				$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span>Your Epin is transferred successfully!');	
				redirect(site_url()."user/epin/transferredPinList");
			}//end form validation if here
		}
		$data['title']='Transfer Pin';
		if(!empty($id))
		{
			$epin_info=$this->db->select('em.epin_code')->from('epin_meta as em')->where('id',$id)->get()->row();
			$data['epin_code']=$epin_info->epin_code;
		}
		$data['all_active_members']=$this->member_model->getAllActiveMembers();
		//pr($data['all_active_members']);
		_userLayout("epin-mgmt/transfer-pin",$data);
	}
	/*
	@Desc: It's used to view all the transferred pin list
	*/
	public function transferredPinList()
	{
		$data['title']='Transferred Pin List';
		$data['all_transferred_epin']=$this->epin_model->getAllTransferredPin($this->userId);
		_userLayout("epin-mgmt/transferred-pin-list",$data);
	}
}//end class
