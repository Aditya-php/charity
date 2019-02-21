<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rank_Model extends Common_Model
{
  public $userName;
  public $userPassword;
  public $user_id;
  public $token_id;
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
    $password=hash("sha256",$password);
  	$query = $this->db->get_where('admin', array('username' => $username,"password"=>$password));
  	if ($query->num_rows() > 0)
  	{
    $res=$query->row();
  	$this->userName=$res->username;
  	$this->userPassword=$res->password;
  	$this->user_id=$res->user_id;
    $this->token_id = md5($res->user_id);
    $update_array = array('last_login'=>date('Y-m-d H:i:s'),'login_status'=>1);
    $this->db->update("admin",$update_array,array('username'=>$username,'password'=>$password));
    return true;
  	}
    else 
  	return false;
  }//end method
  public function getAllRanks()
  {
     $res=$this->db->select('*')->from("rank")->get();
     $result=(!empty($res->result()))?$res->result():array();
     return $result;
  }//end method
  /*
  @author: aditya.php4u@gmail.com
  @last_modified_date: 9 jun 2017
  @desc: it's used to update login_status as well as last_logout date filed at the time of logout
  @param: user_id(String)
  @return: none
  */
  public function logout($user_id)
  {
    $update_array = array('last_logout'=>date('Y-m-d H:i:s'),'login_status'=>0);
    $this->db->update("admin",$update_array,array('user_id'=>$user_id));
  }//end method
}//end class
?>