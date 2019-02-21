<?php 
/*
@author:Global MLM(aditya)
@date:7 jun 2017
@desc:It's used for rendering the admin layout
@param:filename(string),data(assoc array)
@return:none
*/
if(!function_exists("_adminLayout"))
{
	function _adminLayout($filename,$data=null)
	{
		   $obj=& get_instance();
		   $obj->load->view("common/header");
		   $obj->load->view($filename,$data);
		   $obj->load->view("common/footer");

	}
}
/*
@author:Global MLM(aditya)
@date:7 jun 2017
@desc:It's used for rendering the user panel layout
@param:filename(string),data(assoc array)
@return:none
*/
if(!function_exists("_userLayout"))
{
	function _userLayout($filename,$data=null)
	{
		   $obj=& get_instance();
		   $obj->load->view("common/header");
		   $obj->load->view($filename,$data);
		   $obj->load->view("common/footer");
	}	
}
/*
@author:Global MLM(aditya)
@date:7 jun 2017
@desc:It's used for rendering the front layout
@param:filename(string),data(assoc array)
@return:none
*/
if(!function_exists("_frontLayout"))
{
	function _frontLayout($filename=null,$data=null)
	{
		   $obj=& get_instance();
		   $obj->load->view("common/header");
		   $obj->load->view($filename,$data);
	}	
}

?>