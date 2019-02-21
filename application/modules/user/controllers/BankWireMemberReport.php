<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/ewallet
*/
class BankWireMemberReport extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->load->model("bank_wire_member_report_model",'member_model');
		$this->userId=$this->session->userdata('user_id');
	} 
	/*
	@Desc: It's used to view the pending member
	*/
	public function pendingMember()
	{
		$data['title']='Pending Member';
		$data['all_pending_member']=$this->member_model->getPendingMember($this->userId);
		_userLayout("bank-wire-member-mgmt/pending-member",$data);
	}
	/*
	@Desc: It's used to view the approved member
	*/
	public function approvedMember()
	{
		$data['title']='Approved Member';
		$data['all_approved_member']=$this->member_model->getApprovedMember($this->userId);
		_userLayout("bank-wire-member-mgmt/approved-member",$data);
	}
	/*
	@Desc: It's used to view the cancelled member
	*/
	public function cancelledMember()
	{
		$data['title']='Cancelled Member';
		$data['all_cancelled_member']=$this->member_model->getCancelledMember($this->userId);
		_userLayout("bank-wire-member-mgmt/cancelled-member",$data);
	}
	public function uploadProof($username=null)
	{
		if(!empty($this->input->post('btn')))
		{
		  $username=$this->input->post('username');
		  $total_rows=$this->db->select('id')->from('bank_wired_user_registration')->where(array('username'=>$username,'status !='=>'1'))->get()->num_rows();
		  if($total_rows>0)
		  {
          $image_upload_path='/images/';
	      $proof=adImageUpload($_FILES['proof'],1, $image_upload_path);
		  $this->db->update('bank_wired_user_registration',array('proof'=>$proof),array('username'=>$username,'status !='=>'1'));
		  $this->session->set_flashdata('flash_msg',"<h3 style='color:green;font-weight:bold'>Proof is uploaded successfully</h3>");
		  redirect(site_url().'user/BankWireMemberReport/uploadProof');
		  }
		  else 
		  {
		  	redirect(site_url().'user/BankWireMemberReport/uploadBankWireProof');
		  }
		}
		$data['username']=$username;
		_userLayout("bank-wire-member-mgmt/upload-bank-wire-proof",$data);
	}
}//end class
