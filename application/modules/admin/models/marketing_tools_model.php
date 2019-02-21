<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/marketing_tools_todel
*/
class Marketing_Tools_Model extends Common_Model
{
  	public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  	public function getAllMarketingImages()
    {
    	return $this->db->select("*")->from('marketing_images')->order_by('create_date','desc')->get()->result();
    }
  	public function getAllMarketingVideos()
    {
    	return $this->db->select("*")->from('marketing_videos')->order_by('create_date','desc')->get()->result();
    }
}//end class
?>