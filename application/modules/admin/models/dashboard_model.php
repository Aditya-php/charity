<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/dashboard_model
*/
class Dashboard_Model extends Common_Model
{
    public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    /*
    @Desc:It's used to get registered member by date wise, so that total number of registered member can be identified of any day
    */
    public function getRegisteredMemberByDate($date=null)
    {
      $query="SELECT `id`,`registration_date` FROM (`user_registration`)
      WHERE `active_status` = '1' and user_id!='".COMP_USER_ID."'
      AND STR_TO_DATE(`registration_date`, '%Y-%m-%d') = STR_TO_DATE('".$date."','%Y-%m-%d')";
      
      $result=$this->db->query($query);
      $result=$result->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getCurrentWeekRegisteredMember()
    {
      $current_date=date('Y-m-d');//current date
      $start_date=date('Y-m-d', strtotime('-7 days', strtotime($current_date)));
      
      $query="SELECT `id`,`registration_date` FROM (`user_registration`)
      WHERE `active_status` = '1' and user_id!='".COMP_USER_ID."'
      AND STR_TO_DATE(`registration_date`, '%Y-%m-%d') >= STR_TO_DATE('".$start_date."','%Y-%m-%d')
      AND STR_TO_DATE(`registration_date`, '%Y-%m-%d') <= STR_TO_DATE('".$current_date."','%Y-%m-%d')";
      
      $result=$this->db->query($query);
      $result=$result->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getCurrentMonthRegisteredMember()
    {
      $query="SELECT `id`,`registration_date`
        FROM user_registration
        WHERE user_id!='".COMP_USER_ID."' and MONTH(STR_TO_DATE(`registration_date`, '%Y-%m-%d')) = MONTH(CURRENT_DATE())
        AND YEAR(STR_TO_DATE(`registration_date`, '%Y-%m-%d')) = YEAR(CURRENT_DATE())";
      
      $result=$this->db->query($query);
      $result=$result->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getTotalNumberOfPayoutRequest()
    {
      $result=$this->db->select('id')->from('withdrawl_wallet_amount_request')->get()->result();
      return count($result);
    }
    /*
    @Desc:
    */
    public function getTotalPayoutRequestCompletionRate()
    {
      $total_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->get()->result();
      $completed_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','1')->get()->result();
      $total_completed_request=count($completed_request);
      if(count($total_request)==0)
      {
        $result=100;
      }
      else 
      {
        $result=number_format(($total_completed_request*100)/count($total_request),2);
      }
      return $result;
    }
    /*
    @Desc:
    */
    public function getTotalPayoutRequestPendingRate()
    {
      $total_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->get()->result();
      $pending_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','0')->get()->result();
      $total_pending_request=count($pending_request);
      if(count($total_request)==0)
      {
        $result=0;
      }
      else 
      {
        $result=number_format(($total_pending_request*100)/count($total_request),2);
      }
      return $result;
    }

    /*
    @Desc:
    */
    public function getTotalPayoutRequestAmount()
    {

      $request=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->get()->row();
      return number_format($request->amount,2);
    }
    /*
    @Desc:
    */
    public function getTotalCompletedPayoutRequestAmount()
    {

      $request=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where('status','1')->get()->row();
      return number_format($request->amount,2);
    }
    /*
    @Desc:
    */
    public function getTotalNumberOfCompletedPayoutRequest()
    {
      $completed_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','1')->get()->result();
      $total_completed_request=count($completed_request);
      return $total_completed_request; 
    }
    /*
    @Desc:
    */
    public function getTotalPendingPayoutRequestAmount()
    {
      $request=$this->db->select_sum('amount')->from('withdrawl_wallet_amount_request')->where('status','0')->get()->row();
      return number_format($request->amount,2);
    }
    /*
    @Desc:
    */
    public function getTotalNumberOfPendingPayoutRequest()
    {
      $pending_request=$this->db->select('id')->from('withdrawl_wallet_amount_request')->where('status','0')->get()->result();
      $total_pending_request=count($pending_request);
      return $total_pending_request; 
    }
    
    /*
    @Desc:
    */
    public function getTotalCompanyProfit()
    {
      $package_sold_info=$this->db->select_sum('amount')->from('user_package_log')->get()->row();
      $package_sold_amount=$package_sold_info->amount;
      $commission_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where('user_id',COMP_USER_ID)->where_in('reason',array('5','6','7','9'))->get()->row();
      $commission_amount=$commission_info->credit_amt;
      $total_company_profit=number_format($package_sold_amount+$commission_amount,2);
      return $total_company_profit;
    }
    /*
    @Desc:
    */
    public function getTotalPaidCommission()
    {
      /*
      '6'=>credit for binary commission, 
      '5'=>credit for direct commission,
      '7'=>credit for matching commission,
      '9'=>credit for unilevel commission,
      */
      $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where_in('reason',array('5','6','7','9'))->get()->row();
      $total_paid_commission=$credit_amount_info->credit_amt;
      return $total_paid_commission;
    }
    /*
    @Desc:
    */
    public function getTotalOpenTicket()
    {
      $open_ticket_info=$this->db->select('id')->from('support')->where('status','0')->get()->result();
      $total_open_ticket=count($open_ticket_info);
      return $total_open_ticket;
    }
    /*
    @Desc:
    */
    public function getTotalClosedTicket()
    {
      $closed_ticket_info=$this->db->select('id')->from('support')->where('status','1')->get()->result();
      $total_closed_ticket=count($closed_ticket_info);
      //die;
      return $total_closed_ticket;
    }
	/*
	@Desc:
	*/
	public function getTotalPackageSoldAmount()
    {
      $total_registration=$this->db->query("select sum(pkg_amount) as total_package from user_registration where user_id!='".COMP_USER_ID."'")->row_array();
      return $total_registration['total_package'];
    }
	public function getUserTotalDirectCommission($user_id)
	{
	  $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id))->where_in('reason',array('5'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;

	}
	public function getTotalcompanyMatrixCompleteCommission($user_id)
	{
	  $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id))->where_in('reason',array('6'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  
	  return $credit_amount;
	}
	
	public function getTotalcompanyMatrixCommission($user_id)
	{
	  $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id))->where_in('reason',array('37'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  
	  return $credit_amount;
	}
	
	public function getUserTotalReffRecycleCommission($user_id)
	{
	  $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id'=>$user_id))->where_in('reason',array('25'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  
	  return $credit_amount;
	}
	////////////
	public function getAllUserTotalDirectCommission()
	{
	  $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('5'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;	
	}
	public function gettotal_member_matrix_complete_commission()
	{
	   $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('6'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;
	}
	
	public function gettotal_all_member_matrix_commission()
	{
	   $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('37'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;
	}
	
	public function getAllUserTotalReffRecycleCommission()
	{
	   $credit_amount_info=$this->db->select_sum('credit_amt')->from('credit_debit')->where(array('user_id !='=>COMP_USER_ID))->where_in('reason',array('25'))->get()->row();
	  $credit_amount=(!empty($credit_amount_info->credit_amt))?$credit_amount_info->credit_amt:0;
	  return $credit_amount;
	}
	//////////////
}//end class
?>