<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/policy_model
*/
class Policy_Model extends Common_Model
{
  	public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  	public function getPrivacyPolicy()
    {
 		$result=$this->db->select('confidential_value')->from('confidential')->where('confidential_key','privacy_policy')->get()->row();
 		return $result->confidential_value;
    }
  	public function getTermsCondition()
    {
 		$result=$this->db->select('confidential_value')->from('confidential')->where('confidential_key','terms_and_condition')->get()->row();
 		return $result->confidential_value;
    }
}//end class
?>