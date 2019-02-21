<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth_Model extends CI_Model
{
  public $userName;
  public $userPassword;
  public $user_id;
  public $SD_User_Name;
  public $userpanel_user_id;

  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @author: aditya.php4u@gmail.com
  @last_modified_date: 9 jun 2017
  @desc: it's used to  check weather the user exists or not
  @param: username(String), password(String)
  @return: boolena
  */
  public function userExists($username,$password)
  {
      $where_condition="(email = '$username' OR username = '$username' OR user_id = '$username') and password='$password' and active_status='1'";
      $query = $this->db->get_where('user_registration', $where_condition);
    	if($query->num_rows() > 0)
    	{
      $res=$query->row();  
    	$this->userName=$res->username;
    	$this->userPassword=$res->password;
    	$this->user_id=$res->user_id;
      $this->SD_User_Name=$res->username;
      $this->userpanel_user_id=$res->user_id;
      $guest_ip   = $_SERVER['REMOTE_ADDR'];
      $fullName=$res->first_name." ".$res->last_name;
      $this->db->insert("visitor",array('id' =>NULL,'user_id'=>$res->user_id,'username'=>$res->username,'fullname'=>$fullName,'ipadd'=>$guest_ip));
    	return true;
    	}
      else 
    	return false;
   }//end method
}//end class
?>