<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/package
*/
class Package extends Common_Controller 
{
	private $user_id;
	/*
	@Constructor
	*/
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->user_id=$this->session->userdata('user_id');
		$this->load->helper("layout_helper");
		$this->load->helper('user_package_helper');
		$this->load->model('package_model');
	} 
	/*
	@Desc:It's shows the current user activated package
	*/
	public function myActivePackage()
	{
        $data['title']="Active Package";
        $data['breadcrumb']='<li class="active">Active Package</li>';
	    $data['my_active_ackage']=$this->package_model->getMyActivePackage($this->user_id);
	    $data['package_log']=$this->package_model->getUpgradedPackageLogInformation($this->user_id);
	    //pr($data['package_log']);
	   _userLayout("package-mgmt/active-package",$data);	
	}
	/*
	@Desc:It's shows the all active package list, excluded current user active package
	*/
	public function upgradePackage()
	{
	   	$account_model=$this->load->model('account_model');
	   	$user_details=$this->account_model->getUserDetails($this->user_id);
	   	$old_package_details=$this->package_model->getPackageDetails($user_details->pkg_id);
        $data['title']="Upgrade Package";
        $data['breadcrumb']='<li class="active">Upgrade Package</li>';
        if(!empty($old_package_details->amount) && $this->user_id!=COMP_USER_ID)
        {
        	$data['packages']=$this->package_model->getAllExcludedActivePackage($this->user_id,floatval($old_package_details->amount));
    	}
    	else 
    	{
    		 $data['packages']=$this->package_model->getAllActivePackage();
    	}
	   _userLayout("package-mgmt/upgrade-package",$data);	
	}
	/*
	@Desc: It's used to activate the new user package
	*/
	public function activatePackage($package_id)
	{
	   $this->package_model->upgradePackage($this->user_id,$package_id);
	   $this->session->set_flashdata("flash_msg",'<h5 class="panel-title" style="color:green">Package is activated successfully!</h5>');;	
	   redirect(site_url()."user/package/myActivePackage");
	   exit;
	}
}//end class
