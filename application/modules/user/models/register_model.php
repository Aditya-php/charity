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
  public function addBankWiredUser($registration_info,$bank_wired_proof=null)
  {
      $this->db->insert('bank_wired_user_registration',array(
          ///sponsor and account information
          'ref_id'=>(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456',
          'account_type'=>'2',
          'platform'=>(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:'1',
          
          'package_fee'=>(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:60,
          
          'username'=>(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'A',
          
          'password'=>(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123',
          
          't_code'=>(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123',
          //personal informtaion
          
          'first_name'=>(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null,
          
          'last_name'=>(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null,
          
          'email'=>(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null,
          
          'contact_no'=>(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null,
          
          'country'=>(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null,
          
          'state'=>(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null,
          
          'city'=>(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null,
          
          'address_line1'=>(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null,
          
          'date_of_birth'=>(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null,
          //bank account info
          
          'account_no'=>(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null,
          
          'branch_name'=>(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null,
          
          'bank_name'=>(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null,
          
          'account_holder_name'=>(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null,
          /////Proof
          'proof'=>(!empty($bank_wired_proof))?$bank_wired_proof:null,
		  'payment_method'=>'1'
		  
          ));
        $username=$registration_info['sponsor_and_account_info']['username'];
        $password=$registration_info['sponsor_and_account_info']['password'];
        
        $email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
        $transaction_pwd=$registration_info['sponsor_and_account_info']['t_code'];
        if(!empty($empty))
        {
          sendUploadProofEmailToUser($username,$password,$email,$transaction_pwd);
        }
  }//end method
   public function addBitCoinUser($registration_info,$bank_wired_proof=null)
  {
      $this->db->insert('bank_wired_user_registration',array(
          ///sponsor and account information
          'ref_id'=>(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456',
          'account_type'=>'2',
          'platform'=>(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:'1',
          
          'package_fee'=>(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:60,
          
          'username'=>(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'A',
          
          'password'=>(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123',
          
          't_code'=>(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123',
          //personal informtaion
          
          'first_name'=>(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null,
          
          'last_name'=>(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null,
          
          'email'=>(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null,
          
          'contact_no'=>(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null,
          
          'country'=>(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null,
          
          'state'=>(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null,
          
          'city'=>(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null,
          
          'address_line1'=>(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null,
          
          'date_of_birth'=>(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null,
          //bank account info
          
          'account_no'=>(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null,
          
          'branch_name'=>(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null,
          
          'bank_name'=>(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null,
          
          'account_holder_name'=>(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null,
          /////Proof
          'proof'=>(!empty($bank_wired_proof))?$bank_wired_proof:null,
		  'payment_method'=>'2'
          ));
        $username=$registration_info['sponsor_and_account_info']['username'];
        $password=$registration_info['sponsor_and_account_info']['password'];
        
        $email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
        $transaction_pwd=$registration_info['sponsor_and_account_info']['t_code'];
        if(!empty($empty))
        {
          sendUploadProofEmailToUser($username,$password,$email,$transaction_pwd);
        }
  }//end method
}//end class
?>