<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/OrderManagement
*/
class OrderManagement extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
	} 
	/*
	@Desc:
	*/
	public function viewAllOrders()
	{
		$data=array();
	   _adminLayout("order-mgmt/view-all-orders",$data);	
	}
	/* end method */
	/*
	@Desc:
	*/
	public function orderInvoice()
	{
		$data=array();
	   _adminLayout("order-mgmt/order-invoice",$data);	
	}
	/* end method */

}//end class
