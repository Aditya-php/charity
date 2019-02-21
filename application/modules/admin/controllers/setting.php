<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/setting
*/
class Setting extends Common_Controller
{
    public function __construct()
    {
        //@call to parent CI_Controller constructor
        parent::__construct();
        admin_auth();
        $this->load->helper('layout');
        $this->load->model('setting_model');
    }
    public function currencySetting($id = null)
    {
        $data['all_currency'] = $this->setting_model->getAllCurrency();
        if (!empty($id)) 
        {
            $currency         = $this->db->select('*')->from('currency')->where('id', ID_decode($id))->get()->row();
            $data['currency'] = $currency;
        }
        _adminLayout("setting-mgmt/currency-setting", $data);
    }
    /*
    @Desc:It's used for add new currency
    */
    public function addNewCurrency()
    {
        if (!empty($this->input->post('btn'))) 
        {
            if (!empty($this->input->post('id'))) 
            {
                $this->db->update('currency', array(
                    'currency' => $this->input->post('currency')
                ), array(
                    'id' => $this->input->post('id')
                ));
                $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Currency is edit Successfully');
            } 
            else 
            {
                $this->db->insert('currency', array(
                    'currency' => $this->input->post('currency')
                ));
                $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> New Currency is added Successfully');
            }
        }
        redirect(site_url() . "admin/setting/currencySetting");
        exit;
    } //end method
    /*
    @Desc:It's used for delete the currency
    */
    public function deleteCurrency($id)
    {
        $this->db->delete('currency', array(
            'id' => ID_decode($id)
        ));
        $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Currency is deleted Successfully');
        redirect(site_url() . "admin/setting/currencySetting");
        exit;
    } //end method
    /*
    @Desc:It's used for change currency status
    */
    public function changeCurrencyStatus($id)
    {
        $currency   = $this->db->select('active_status')->from('currency')->where('id', ID_decode($id))->get()->row();
        $set_status = ($currency->active_status == '1') ? '0' : '1';
        $this->db->update('currency', array(
            'active_status' => '0'
        ));
        $this->db->update('currency', array(
            'active_status' => $set_status
        ), array(
            'id' => ID_decode($id)
        ));
        $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Currency status is changed Successfully');
        redirect(site_url() . "admin/setting/currencySetting");
        exit;
    } //end method
    /*
    @Desc:It's used to view the user_id setting
    */
    public function userIdSetting()
    {
        $data['setting'] = $this->db->select('*')->from('user_id_setting')->where('id', 1)->get()->row();
        _adminLayout("setting-mgmt/user-id-setting", $data);
    } //end method
    /*
    @Desc:It's used to update the user_id setting
    */
    public function updateUserIdSetting()
    {
        if (!empty($this->input->post('btn'))) 
        {
            $type   = $this->input->post('type');
            $prefix = (!empty($this->input->post('prefix')))?$this->input->post('prefix'):null;
            $this->db->update('user_id_setting', array(
                'type' => $type,
                'prefix' => $prefix
            ), array(
                'id' => 1
            ));
            $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> User id setting is updated Successfully');
        }
        redirect(site_url() . "admin/setting/userIdSetting");
        exit;
    } //end method
    /*
    @Desc:It's used for view and update the Payment mode setting
    */
    public function paymentModeSetting()
    {
        $data = array();
        if (!empty($this->input->post('btn'))) 
        {
            $reg_method = $this->input->post('reg_method');
            $this->db->update("registration_method", array(
                'status' => 0
            ));
            if(!empty($reg_method) && count($reg_method)>0)
            {
                foreach ($reg_method as $key => $value) 
                {
                    $this->db->update("registration_method", array(
                        'status' => 1
                    ), array(
                        'id' => $value
                    ));
                }
            }
            $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payment mode is setted Successfully');
            redirect(site_url() . "admin/setting/paymentModeSetting");
            exit;
        }
        $data['all_reg_method'] = $this->setting_model->getAllRegistrationMethod();
        _adminLayout("setting-mgmt/payment-mode-setting", $data);
    } //end method
    /*
    @Desc:It's used to view and update the payout setting
    */
    public function payoutSetting()
    {
        if (!empty($this->input->post('btn'))) 
        {
            $this->db->update('payout_setting', array(
                'request_type' => $this->input->post('request_type')
            ), array(
                'id' => 1
            ));
            $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout setting is done Successfully');
            redirect(site_url() . "admin/setting/payoutSetting");
            exit;
        }
        $data['setting'] = $this->db->select('*')->from('payout_setting')->where('id', 1)->get()->row();
        _adminLayout("setting-mgmt/payout-setting", $data);
    } //end method
    /*
    @Desc:It's used to view and update the date format
    */
    public function dateFormatManagement()
    {
      if(!empty($this->input->post('btn')))
      {
      $date_format='';  
      $date_format_array=$this->input->post('date_format');
      for($i=0;$i<count($date_format_array);$i++)
      {
         if($date_format_array[$i]=='y')
         {
            $date_format_array[$i]=strtoupper($date_format_array[$i]);
         }
         $date_format .=$date_format_array[$i];
      }
      $this->db->update('date_format',array('date_format'=>$date_format),array('id'=>'1'));
      $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Date format is edit successfully');
      redirect(site_url()."admin/setting/dateFormatManagement");    
      exit; 
      }//end empty if btn clicked here
     $data['date_format']=str_split($this->setting_model->getDateFormat(),1);
     _adminLayout("setting-mgmt/date-format-management",$data);
    }//end method
} //end class