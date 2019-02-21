<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/ewallet
*/
class Incentive extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		
		$this->userId=$this->session->userdata('user_id');
	} 
	
	public function index()
   {
	   $data['title']='Incentive Report';
	   $data['all_list']=$this->db->query("select a.*,b.name from incentive_achiever as a,incentive as b where a.user_id='".$this->userId."' and  a.incentive_id=b.id")->result_array();	   
   	  _adminLayout("incentive-mgmt/incentive-list",$data);   
	  
   }

}//end 
