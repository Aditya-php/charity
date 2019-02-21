<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/payment_mode_setting
*/
class Payment_Mode_Setting extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->userId=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->model("account_model");
		$this->load->model("payment_mode_setting_model");
		$this->moduleName=$this->router->fetch_module();
	} 
	////////////
	public function bankWirePaymentDetailsList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['bank_wire_payment_details']=$this->payment_mode_setting_model->getBankWirePaymentDetailsList($this->userId);
		_adminLayout("payment-mode-setting-mgmt/bank-wire-payment-details-list",$data);
	}
	public function addBankWirePaymentDetails()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$bank_name=$this->input->post('bank_name');
			$account_name=$this->input->post('account_name');
			$account_no=$this->input->post('bank_name');
			$this->db->insert('bank_wire_payment_details',array(
				'user_id'=>$this->userId,
				'bank_name'=>$bank_name,
				'account_name'=>$account_name,
				'account_no'=>$account_no
				));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Bank wire details is added successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/bankWirePaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		_adminLayout("payment-mode-setting-mgmt/add-bank-wire-payment-details",$data);
	}
	public function editBankWirePaymentDetails($id)
	{
		$id=ID_decode($id);
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$row_id=$this->input->post('id');
			$bank_name=$this->input->post('bank_name');
			$account_name=$this->input->post('account_name');
			$account_no=$this->input->post('account_no');
			$this->db->update('bank_wire_payment_details',array(
				'bank_name'=>$bank_name,
				'account_name'=>$account_name,
				'account_no'=>$account_no
				),array('user_id'=>$this->userId,'id'=>$row_id));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Bank wire details is edited successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/bankWirePaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		$data['bank_wire_payment_details']=$this->payment_mode_setting_model->getBankWirePaymentDetailsList($this->userId,$id);

		_adminLayout("payment-mode-setting-mgmt/edit-bank-wire-payment-details",$data);
	}
	function deleteBankWirePaymentDetails($id)
	{
		$id=ID_decode($id);
		$this->db->delete('bank_wire_payment_details',array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Bank wire details is deleted successfully!');
		redirect(site_url().$this->moduleName."/payment_mode_setting/bankWirePaymentDetailsList");
		exit;
	}	
	//////////////////
	////////////
	public function mobileMoneyProviderList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getMobileMoneyProviderList($this->userId);
		//pr($data['payment_details']);
		_adminLayout("payment-mode-setting-mgmt/mobile-money-provider-list",$data);
	}
	public function addMobileMoneyProviderDetails()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$money_provider_id=$this->input->post('money_provider_id');
			$mobile_number=$this->input->post('mobile_number');
			$money_provider_array=array(
										'1'=>'Orange',
										'2'=>'MTN',
										'3'=>'Moov'
										);
			$money_provider_name=$money_provider_array[$money_provider_id];
			$this->db->insert('mobile_money_provider_payment_details',array(
				'user_id'=>$this->userId,
				'money_provider_id'=>$money_provider_id,
				'money_provider_name'=>$money_provider_name,
				'mobile_number'=>$mobile_number
				));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Mobile Money provider details is added successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/mobileMoneyProviderList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		_adminLayout("payment-mode-setting-mgmt/add-mobile-money-provider-details",$data);
	}
	public function editMobileMoneyProviderDetails($id)
	{
		$id=ID_decode($id);
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$row_id=$this->input->post('id');
			$money_provider_id=$this->input->post('money_provider_id');
			$mobile_number=$this->input->post('mobile_number');
			$money_provider_array=array(
										'1'=>'Orange',
										'2'=>'MTN',
										'3'=>'Moov'
										);
			$money_provider_name=$money_provider_array[$money_provider_id];
			
			$this->db->update('mobile_money_provider_payment_details',array(
				'money_provider_id'=>$money_provider_id,
				'money_provider_name'=>$money_provider_name,
				'mobile_number'=>$mobile_number
				),array('user_id'=>$this->userId,'id'=>$row_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Mobile Money provider details is edited successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/mobileMoneyProviderList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getMobileMoneyProviderList($this->userId,$id);
		_adminLayout("payment-mode-setting-mgmt/edit-mobile-money-provider-details",$data);
	}
	function deleteMobileMoneyProviderPaymentDetails($id)
	{
		$id=ID_decode($id);
		$this->db->delete('mobile_money_provider_payment_details',array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Mobile Money provider details is deleted successfully!');
		redirect(site_url().$this->moduleName."/payment_mode_setting/mobileMoneyProviderList");
		exit;
	}
	//////////////////
	////////////
	public function payeerPaymentDetailsList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getPayeerPaymentDetailsList($this->userId);
		_adminLayout("payment-mode-setting-mgmt/payeer-payment-details-List",$data);
	}
	public function addPayeerPaymentDetails()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$payeer_id=$this->input->post('payeer_id');
			$this->db->insert('payeer_payment_details',array(
				'user_id'=>$this->userId,
				'payeer_id'=>$payeer_id,
				));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payeer Payment details is added successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/payeerPaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		_adminLayout("payment-mode-setting-mgmt/add-payeer-payment-details",$data);
	}
	public function editPayeerPaymentDetails($id)
	{
		$id=ID_decode($id);
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$row_id=$this->input->post('id');
			
			$payeer_id=$this->input->post('payeer_id');
			
			$this->db->update('payeer_payment_details',array(
				'payeer_id'=>$payeer_id,
				),array('user_id'=>$this->userId,'id'=>$row_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payeer Payment details is edited successfully!');

			redirect(site_url().$this->moduleName."/payment_mode_setting/payeerPaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getPayeerPaymentDetailsList($this->userId,$id);
		_adminLayout("payment-mode-setting-mgmt/edit-payeer-payment-details",$data);
	}
	function deletePayeerPaymentDetails($id)
	{
		$id=ID_decode($id);
		$this->db->delete('payeer_payment_details',array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payeer Payment details is deleted successfully!');
		redirect(site_url().$this->moduleName."/payment_mode_setting/payeerPaymentDetailsList");
		exit;
	}
	////////////
	public function perfectMoneyPaymentDetailsList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getPerfecMoneyPaymentDetailsList($this->userId);
		_adminLayout("payment-mode-setting-mgmt/perfect-money-payment-details-list",$data);
	}
	public function addPerfectMoneyPaymentDetails()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$perfect_money_id=$this->input->post('perfect_money_id');
			$this->db->insert('perfect_money_payment_details',array(
				'user_id'=>$this->userId,
				'perfect_money_id'=>$perfect_money_id,
				));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Perfect money details is added successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/perfectMoneyPaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		_adminLayout("payment-mode-setting-mgmt/add-perfect-money-payment-details",$data);
	}
	public function editPerfectMoneyPaymentDetails($id)
	{
		$id=ID_decode($id);
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$row_id=$this->input->post('id');
			
			$perfect_money_id=$this->input->post('perfect_money_id');
			
			$this->db->update('perfect_money_payment_details',array(
				'perfect_money_id'=>$perfect_money_id,
				),array('user_id'=>$this->userId,'id'=>$row_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Perfect Money details is edited successfully!');

			redirect(site_url().$this->moduleName."/payment_mode_setting/perfectMoneyPaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getPerfecMoneyPaymentDetailsList($this->userId,$id);
		_adminLayout("payment-mode-setting-mgmt/edit-perfect-money-payment-details",$data);
	}
	function deletePerfectMoneyPaymentDetails($id)
	{
		$id=ID_decode($id);
		$this->db->delete('perfect_money_payment_details',array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Perfect Money Payment details is deleted successfully!');
		redirect(site_url().$this->moduleName."/payment_mode_setting/perfectMoneyPaymentDetailsList");
		exit;
	}
	//////////////////
	//////Bit Coin Payment Details//////
	public function bitCoinPaymentDetailsList()
	{
		$data=array();
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getBitCoinPaymentDetailsList($this->userId);
		_adminLayout("payment-mode-setting-mgmt/bit-coin-payment-details-list",$data);
	}
	public function addBitCoinPaymentDetails()
	{
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$bit_coin_id=$this->input->post('bit_coin_id');
			$this->db->insert('bit_coin_payment_details',array(
				'user_id'=>$this->userId,
				'bit_coin_id'=>$bit_coin_id,
				));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Bit Coin Payment details is added successfully!');
			redirect(site_url().$this->moduleName."/payment_mode_setting/bitCoinPaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		_adminLayout("payment-mode-setting-mgmt/add-bit-coin-payment-details",$data);
	}
	public function editBitCoinPaymentDetails($id)
	{
		$id=ID_decode($id);
		$data=array();
		if(!empty($this->input->post('btn')))
		{
			$row_id=$this->input->post('id');
			
			$bit_coin_id=$this->input->post('bit_coin_id');
			
			$this->db->update('bit_coin_payment_details',array(
				'bit_coin_id'=>$bit_coin_id,
				),array('user_id'=>$this->userId,'id'=>$row_id));

			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Bit Coin Payment details is edited successfully!');

			redirect(site_url().$this->moduleName."/payment_mode_setting/bitCoinPaymentDetailsList");
			exit;
		}
		$data['module_name']=$this->moduleName;
		$data['payment_details']=$this->payment_mode_setting_model->getBitCoinPaymentDetailsList($this->userId,$id);
		_adminLayout("payment-mode-setting-mgmt/edit-bit-coin-payment-details",$data);
	}
	function deleteBitCoinPaymentDetails($id)
	{
		$id=ID_decode($id);
		$this->db->delete('bit_coin_payment_details',array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Bit Coin Payment details is deleted successfully!');
		redirect(site_url().$this->moduleName."/payment_mode_setting/bitCoinPaymentDetailsList");
		exit;
	}
	//////////////////

}//end class
