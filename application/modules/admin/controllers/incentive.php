<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Incentive extends Common_Controller 
{
	public function __construct()
	{
		
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		
	}

   public function index()
   {
	   $data['all_list']=$this->db->query("select a.*,b.username,c.name from incentive_achiever as a,user_registration as b,incentive as c where a.user_id=b.user_id and a.incentive_id=c.id")->result_array();	   
   	  _adminLayout("incentive-mgmt/incentive-list",$data);   
	  
   }

  
	
}
