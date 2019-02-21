<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/setting
*/
class PackageMgmt extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper('layout');
	} 
	public function addPackage()
	{
		_adminLayout("package-mgmt/add-package");
	}
	public function editPackage()
	{
		_adminLayout("package-mgmt/edit-package");
	}

}//end class
