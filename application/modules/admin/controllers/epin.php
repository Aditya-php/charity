<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/epin
*/
class Epin extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model('package_model');
		$this->load->model('epin_model');
		$this->load->model('user_wallet_model');
		$this->load->model('account_model');
		$this->load->model('member_model');
		if(!isEpinEnabled())
		{
			redirect(site_url().'admin/');
			exit;
		}
	} 
	/*
	@Desc: It's used to generate unique deposit request id
	*/
	public function generateUniqueEpinRequestId()
	{
	    $random_number="R".mt_rand(100000, 999999);
	    if($this->db->select('request_id')->from('epin')->where('request_id',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueEpinRequestId();
	    }
	    return $random_number;
	}
	/*
	@Desc: It's used to generate unique epin id
	*/
	public function generateUniqueEpinCode()
	{
	    $seed = str_split('abcdefghijklmnopqrstuvwxyz'
                 .'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
                 ); // and any other characters
		shuffle($seed); // probably optional since array_is randomized; this may be redundant
		$rand = '';
		foreach (array_rand($seed, 4) as $k) $rand .= $seed[$k];
		
		$random_number="HDG".mt_rand(1000,9999)."".$rand;
	    if($this->db->select('epin_code')->from('epin_meta')->where('epin_code',$random_number)->get()->num_rows()>0)
	    {
	      $this->generateUniqueEpinCode();
	    }
	    return $random_number;
	}
	/*
	@Desc: It's used to view all the pending pin request list
	*/
	public function pendingEpinRequestList()
	{
		$data['title']='Pending Epin Request List';
		$data['all_pending_request']=$this->epin_model->getAllPendingEpinRequest();
		/*
		echo "<pre>";
          print_r($data['all_pending_request']);
		echo "</pre>";
		*/
		_adminLayout("epin-mgmt/pending-epin-request",$data);
	}
    public function approveEpinRequest($id)
    {
    	$id=ID_decode($id);
    	$this->db->update('epin',array('request_status'=>'1','response_date'=>date('Y-m-d H:i:s')),array('id'=>$id));
    	$epin_info=$this->db->select('*')->from('epin')->where('id',$id)->get()->row();
    	for($i=1;$i<=$epin_info->no_of_epin;$i++)
    	{
          $this->db->insert('epin_meta',array(
          	'epin_request_id'=>$epin_info->request_id,
          	'sequence_number'=>$i,
          	'epin_code'=>$this->generateUniqueEpinCode(),
          	'user_id'=>$epin_info->user_id,
          	'source_user_id'=>'comp',
          	'pkg_id'=>$epin_info->pkg_id,
          	'pkg_amount'=>$epin_info->pkg_amount,
          	'epin_status'=>'0',//0=>pending
          ));		
    	}
    	$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New pending pin request is approved successfully!</h5>');
    	redirect(site_url().'admin/epin/approvedEpinRequestList');
    }
	/*
	@Desc: It's used to view all the approved pin request
	*/
	public function approvedEpinRequestList()
	{
		$data['title']='Approved Epin Request List';
		$data['all_approved_request']=$this->epin_model->getAllApprovedEpinRequest();
		/*
		echo "<pre>";
          print_r($data['all_approved_request']);
		echo "</pre>";
		*/
		_adminLayout("epin-mgmt/approved-epin-request",$data);
	}
    public function cancelEpinRequest($id)
    {
    	$id=ID_decode($id);
    	$this->db->update('epin',array('request_status'=>'2','response_date'=>date('Y-m-d H:i:s')),array('id'=>$id));
    	$this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">New pending pin request is cancelled successfully!</h5>');
    	redirect(site_url().'admin/epin/cancelledEpinRequestList');
    }
    public function cancelledEpinRequestList()
    {
		$data['title']='Cancelled Epin Request List';
		$data['cancelled_epin_request']=$this->epin_model->getAllCancelledEpinRequest();
		_adminLayout("epin-mgmt/cancelled-epin-request",$data);
    }
    public function createNewPin()
    {
		if(!empty($this->input->post('btn')))
		{
			$form_data=$this->input->post(null);
			$pkg_id_array=$form_data['pkg_id'];
			$epin_amount_array=$form_data['epin_amount'];
			$no_of_epin_array=$form_data['no_of_epin'];
			$request_id=$this->generateUniqueEpinRequestId();
			$payment_method=$this->input->post('select_payment_method');
			$payment_method="ewallet";
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
				  for($i=1;$i<=$no_of_epin;$i++)
				  {
					  $purchase_pin_data[]=array(
					  	'epin_request_id'=>$request_id,
					  	'sequence_number'=>$i,
					  	'epin_code'=>$this->generateUniqueEpinCode(),
					  	'user_id'=>COMP_USER_ID,
					  	'source_user_id'=>'comp',
					  	'pkg_id'=>$pkg_id,
					  	'pkg_amount'=>$pkg_amount,
					  	'epin_status'=>'0',//0=>pending
					  	);
				  }
                  if($payment_method=='ewallet')
                  {
	                  $current_ewallet_balance=$this->user_wallet_model->getEwalletBalance(COMP_USER_ID)-$epin_amount;
					  $this->db->update('final_e_wallet',array('amount'=>$current_ewallet_balance),array('user_id'=>COMP_USER_ID));
					  $this->db->insert('credit_debit',array(
					  	'transaction_no'=>generateUniqueTranNo(),
					  	'user_id'=>COMP_USER_ID,
					  	'credit_amt'=>0,
					  	'debit_amt'=>$epin_amount,
					  	'balance'=>$current_ewallet_balance,
					  	'receiver_id'=>COMP_USER_ID,
					  	'sender_id'=>COMP_USER_ID,
					  	'receive_date'=>date('d-m-Y'),
					  	'ttype'=>'Epin Created By Admin',
					  	'TranDescription'=>'Epin Created By Admin',
					  	'product_name'=>$pkg_id,
					  	'status'=>'0',
					  	'reason'=>'22',//epin created by admin
					  	));	                  	
					}//end payment method if here
				}//end foreach
				$this->db->insert_batch('epin_meta',$purchase_pin_data);
			}//end pkg id if array 
	    	$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> New Epin is created Successfully');
			redirect(site_url().'admin/epin/activePinList');
    	}//end btn empty check if
		$data['title']='Purchase Pin';
		$user_info=$this->account_model->getUserDetails(COMP_USER_ID);
		$data['tran_code']=$user_info->t_code;
		$data['ewallet_balance']=$this->user_wallet_model->getEwalletBalance(COMP_USER_ID);
		$data['all_active_package']=$this->package_model->getAllActivePackage();
		_adminLayout("epin-mgmt/create-new-epin",$data);    
	}//end method
	/*
	@Desc: It's used to view all the active pin list
	*/
	public function activePinList()
	{
		$data['title']='Active Pin List';
		$data['all_active_pin']=$this->epin_model->getAllActivePin();
		//pr($data['all_active_pin']);
		_adminLayout("epin-mgmt/active-pin-list",$data);
	}
	/*
	@Desc: It's used to view all the used pin list
	*/
	public function usedPinList()
	{
		$data['title']='Used Pin List';
		$data['all_used_epin']=$this->epin_model->getAllUsedPin();
		_adminLayout("epin-mgmt/used-pin-list",$data);
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
			$epin_code=$this->input->post('epin_code');
			if(!empty($epin_code))
			{
			  $epin_info=$this->db->select('user_id')->from('epin_meta')->where(array('epin_code'=>$epin_code, 'epin_status'=>'0'))->get()->row();
			  $epin_user_id=$epin_info->user_id;
			  
			}	
			if((!empty($epin_user_id) && $epin_user_id==COMP_USER_ID && ($username==COMP_USER_ID || $username==COMP_USERNAME)))
			{
				$this->form_validation->set_message('check_valid_username','Sorry Epin can not be assigned to self once again!');
				return false;
			}
			if((!empty($epin_user_id) && ($epin_user_id==$username || $epin_user_id==get_user_id($username))))
			{
				$this->form_validation->set_message('check_valid_username','Sorry Epin can not be assigned to same member once again!');
				return false;
			}

			$this->db->where('username',$username);
			$this->db->or_where('user_id',$username);
			$query=$this->db->select('*')->from('user_registration')->get();
			if($query->num_rows()<1)
			{
			$this->form_validation->set_message('check_valid_username','Please enter valid Receiver username/userid!');
			  return false;
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
			$res=$this->db->select('id')->from('epin_meta')->where(array('epin_code'=>$epin_code,'epin_status'=>'0'))->get();
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
	public function transferEpin($epin_code=null)
	{
		//$id=ID_decode($id);
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
				$epin_info=$this->db->select('*')->from('epin_meta')->where(array('epin_code'=>$epin_code))->get()->row();
				$this->db->update('epin_meta',array('epin_status'=>'2','status_change_date'=>$transfer_date), array('epin_code'=>$epin_code));
				$this->db->insert('epin_meta',array(
					'epin_request_id'=>$epin_info->epin_request_id,
					'sequence_number'=>'1',
					'epin_code'=>$epin_code,
					'user_id'=>$transfer_user_info->user_id,
					'source_user_id'=>$epin_info->user_id,
					'pkg_id'=>$epin_info->pkg_id,
					'pkg_amount'=>$epin_info->pkg_amount,
					'epin_status'=>'0',
					));
				$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span>Your Epin is transferred successfully.');
				redirect(site_url()."admin/epin/transferEpin");
			}//end form validation if here
		}
		$data['title']='Transfer Pin';
		$data['all_active_members']=$this->member_model->getAllActiveMembers();
		//pr($data['all_active_members']);
		if(!empty($epin_code))
		{
			$data['epin_code']=$epin_code;
		}
		_adminLayout("epin-mgmt/transfer-pin",$data);
	}
	/*
	@Desc: It's used to view all the transferred pin list
	*/
	public function transferredPinList()
	{
		$data['title']='Transferred Pin List';
		$data['all_transferred_epin']=$this->epin_model->getAllTransferredPin();
		//pr($data['all_transferred_epin']);
		_adminLayout("epin-mgmt/transferred-pin-list",$data);
	}
	/*
	@Desc: It's used to view all the withdrawl pin list
	*/
	public function withdrawlPinList()
	{
		$data['title']='Withdrawl Pin List';
		_adminLayout("epin-mgmt/withdrawl-pin-list",$data);
	}
	public function deleteBlockEpinList()
	{
		$data['title']='Delete OR Block Pin';
		$data['all_blocked_epin']=$this->epin_model->getAllBlockedPin();
		//pr($data['all_blocked_epin']);
		_adminLayout("epin-mgmt/delete-block-pin",$data);
	}
	public function blockEpin($epin_id)
	{
		$id=ID_decode($epin_id);
		$this->db->update("epin_meta",array('epin_status'=>'4','status_change_date'=>date('Y-m-d H:i:s')),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Epin is blocked successfully.');
		redirect(site_url()."admin/epin/deleteBlockEpinList");
	}
	public function unBlockEpin($epin_id)
	{
		$id=ID_decode($epin_id);
		$this->db->update("epin_meta",array('epin_status'=>'0'),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Epin is unblocked successfully.');
		redirect(site_url()."admin/epin/activePinList");
	}
	public function deleteEpin($epin_id)
	{
		$id=ID_decode($epin_id);
		$this->db->delete('epin_meta',array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Epin is deleted successfully.');
		redirect(site_url()."admin/epin/deleteBlockEpinList");
	}
	/*
	*/
	public function showWebsiteEpinRequest()
	{
		$data=array();
		$data['website_epin_request']=$this->epin_model->getAllWebsiteEpinRequest();
		_adminLayout("epin-mgmt/show-website-epin-request",$data);
	}
	public function changeWebsiteEpinRequestStatus($id)
	{
		$data=array();
		$id=ID_decode($id);
		$request=$this->db->select('status')->from('epin_request')->where('id',$id)->get()->row();
		if($request->status=='1')
		{
			$status='0';
		}
		else 
		{
			$status='1';
		}
		$this->db->update('epin_request',array('status'=>$status),array('id'=>$id));
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> Request Status is changed successfully.');
		redirect(site_url()."admin/epin/showWebsiteEpinRequest");
		exit;
	}
}//end class
