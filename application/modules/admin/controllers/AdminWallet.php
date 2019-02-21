<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/adminwallet
*/
class AdminWallet extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("admin_wallet_model");
	}//end constructor 
	public function viewAminWalletReport()
	{
		$data=array();
		$data['all_statements']=$this->admin_wallet_model->getEwalletStatements(COMP_USER_ID);
		_adminLayout("admin-wallet-mgmt/wallet-report",$data);
	}
	/*
	@Desc: It's used to view the ewallet balance
	*/
	public function viewEwalletBalance()
	{
		$data['ewallet_balance']=$this->admin_wallet_model->getEwalletBalance(COMP_USER_ID);
		_adminLayout("admin-wallet-mgmt/view-ewallet-balance",$data);
	}
	public function viewAminWalletGraph()
	{
		$data=array();
		_adminLayout("admin-wallet-mgmt/wallet-graph",$data);
	}	
}//end class