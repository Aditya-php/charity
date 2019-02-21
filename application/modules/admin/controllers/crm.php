<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/crm
*/
class Crm extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("account_model");
	} 
	/*
	@Desc:
	*/
	public function dashboard()
	{
        $data=array();
	   _adminLayout(" crm-mgmt/dashboard",$data);	
	}

	/*
	@Desc:
	*/
	public function addLead()
	{
        $data=array();
	   _adminLayout(" crm-mgmt/add-lead",$data);	
	}
	/*
	@Desc:
	*/
	public function viewAllLead()
	{
        $data=array();
	   _adminLayout(" crm-mgmt/view-all-lead",$data);	
	}
	/*
	@Desc:
	*/
	public function convertedLead()
	{
        $data=array();
	   _adminLayout(" crm-mgmt/converted-lead",$data);	
	}
	/*
	@Desc:
	*/
	public function closeLostLead()
	{
        $data=array();
	   _adminLayout(" crm-mgmt/close-lost-lead",$data);	
	}


}//end class
