<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/register_model
*/
class Register_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  /*
  @Desc: It's used to register new member
  */
  public function getDirectReferralMemberList()
  {

  }
  /*
  @Desc: It;s used to get all the registration method enable by admin
  */
  public function getAllEnabledRegistrationMethod()
  {
    $registration_method=$this->db->select('*')->from('registration_method')->where('status','1')->get()->result();
    $registration_method=(!empty($registration_method))?$registration_method:array();
    return $registration_method;
  }//end function 
  public function addBankWiredUser($new_member_data)
  {
      /*
      $new_member_data=array(
        'ref_id'=>$this->userId,
        'binary_pos'=>$binary_pos,
        'platform'=>$platform,
        'package_fee'=>$package_fee,
        'username'=>$username,
        'password'=>$password,
        't_code'=>$t_code,
        'first_name'=>$first_name,
        'last_name'=>$last_name,
        'email'=>$email,
        'contact_no'=>$contact_no,
        'country'=>$country,
        'state'=>$state,
        'city'=>$city,
        'zip_code'=>$zip_code,
        'address_line1'=>$address_line1,
        'account_no'=>$account_no,
        'branch_name'=>$branch_name,
        'bank_name'=>$bank_name,
        'ifsc_code'=>$ifsc_code,
        'account_holder_name'=>$account_holder_name,
        'registration_method'=>$registration_method,
        'registration_method_name'=>$registration_method_name,
        'proof'=>$bank_wired_proof;
        );
      */      
      $this->db->insert('bank_wired_user_registration',$new_member_data);
  }
}//end class
?>