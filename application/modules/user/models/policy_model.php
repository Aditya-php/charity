<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/Policy_Model
*/
class Policy_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @Desc:It's used to return the privacy policy
  */
  public function getPrivacyPolicy()
    {
       $res=$this->db->select('confidential_value')->from('confidential')->where('confidential_key','privacy_policy')->get()->row();
       $confidential_value=$res->confidential_value;
       return $confidential_value;
    }    
  /*
  @Desc:It's used to return the terms and condition
  */
  public function getTermsCondition()
    {
       $res=$this->db->select('confidential_value')->from('confidential')->where('confidential_key','terms_and_condition')->get()->row();
       $confidential_value=$res->confidential_value;
       return $confidential_value;
    }    
}//end class
?>