<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/account_model
*/
class Account_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getUserDetails($user_id)
  {
    $res=$this->db->select('*')->from('user_registration')->where('user_id', $user_id)->or_where('username',$user_id)->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
  }//end method  

  public function getAdminDetails($user_id)
  {
    $res=$this->db->select(array('ad.id','ad.user_id','ad.username','ad.password','ad.email','ad.name','ad.image','ad.panel_title','ad.website_logo','ad.transaction_pwd','u.facebook_link', 'u.google_plus_link','u.linkedin_link'))->from('admin as ad')
    ->join('user_registration as u','u.user_id=ad.user_id')
    ->where('ad.user_id', $user_id)->get()->row();
    $res=(!empty($res))?$res:array();
    return $res;
  }//end method  
}//end class
?>