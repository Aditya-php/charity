<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/marketing_tools_todel
*/
class Marketing_Tools_Model extends Common_Model
{
  	public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    public function getAllPublishedMarketingImages()
    {
      return $this->db->select("*")->from('marketing_images')->where('status','1')->order_by('create_date','desc')->get()->result();
    }
    public function getAllPublishedMarketingVideos()
    {
      return $this->db->select("*")->from('marketing_videos')->where('status','1')->order_by('create_date','desc')->get()->result();
    }
}//end class
?>