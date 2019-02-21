<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/package_model
*/
class Package_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllPackages()
  {
    $res=$this->db->select('*')->from("package")->get();
    $result=(!empty($res->result()))?$res->result():array();
    return $result;
  }//end method  
  public function getPackage($package_id)
  {
    $resObj=$this->db->select('*')->from('package')->where(array('id'=>$package_id))->get();
    $result=(!empty($resObj))?$resObj->row():array();
    return $result;
  }
  /*
   @Desc: It's used to get all the active package
  */
  public function getAllActivePackage()
  {
    $packages=$this->db->select('*')->from('package')->where('status','1')->order_by('id','desc')->get()->result();
    return $packages;
  }
}//end class
?>