<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/setting_model
*/
class Setting_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllCurrency()
	{
      $all_currency=$this->db->select('*')->from('currency')->get()->result();
      $all_currency=(!empty($all_currency))?$all_currency:array();
      return $all_currency;
	}//end method  
  public function getActiveCurrency()
  {
      $currency=$this->db->select('currency')->from('currency')->where('active_status','1')->get()->row();
      $currency=(!empty($currency->currency))?$currency->currency:'';
      return $currency;
  }//end method
  public function getDateFormat()
  {
    $date_format=$this->db->select('date_format')->from('date_format')->where('id','1')->get()->row();
    
    $date_format=$date_format->date_format;
    return $date_format;
  }//end method
  public function getAllRegistrationMethod()
  {
    $reg_method=$this->db->select('*')->from('registration_method')->get();
    $result=(!empty($reg_method->result()))?$reg_method->result():array();
    return $result;
  }
  /*
  @Desc:It's used to get the bank wire details
  */
  public function getBankWireDetails()
  {
     return $this->db->select('*')->from('bank_wired_detail')->where('id',1)->get()->row();    
  }
  /*
  @Desc: It's used to add or update bank_wire details
  */
  public function addBankWiredDetails($bank_wire_details)
  {
    $this->db->update('bank_wired_detail',$bank_wire_details,array('id'=>1));
  }
}//end class
?>