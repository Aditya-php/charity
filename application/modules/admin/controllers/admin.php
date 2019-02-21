<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/admin
*/
class Admin extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("dashboard_model");
	} 
	/*
	@Desc:It's used to view dashboard
	*/
	public function index()
	{
		$data=array();
		
		$data['total_payout_request']=$this->dashboard_model->getTotalNumberOfPayoutRequest();
		$data['total_payout_request_completion_rate']=$this->dashboard_model->getTotalPayoutRequestCompletionRate();
		$data['total_payout_request_amount']=$this->dashboard_model->getTotalPayoutRequestAmount();
		////////////////////////////////////
		$data['total_completed_payout_request']=$this->dashboard_model->getTotalNumberOfCompletedPayoutRequest();
		$data['total_completed_payout_request_amount']=$this->dashboard_model->getTotalCompletedPayoutRequestAmount();
		////////////////////////////////////
		$data['total_pending_payout_request']=$this->dashboard_model->getTotalNumberOfPendingPayoutRequest();
		$data['total_payout_request_pending_rate']=$this->dashboard_model->getTotalPayoutRequestPendingRate();
		$data['total_pending_payout_request_amount']=$this->dashboard_model->getTotalPendingPayoutRequestAmount();
		////////////////////////////////////
		$data['total_open_ticket']=$this->dashboard_model->getTotalOpenTicket();
		$data['total_closed_ticket']=$this->dashboard_model->getTotalClosedTicket();
		/////////////////////
		
		
	

		/////////////////////
		
		 $data['Commission_chart'] = $this->commission_chart();
		 
		
		
		_adminLayout("dashboard",$data);
	}
	
	
	public function ajaxalldata()
	{
		$ajaxdata['member_registered_today']=$this->dashboard_model->getRegisteredMemberByDate(date('Y-m-d'));
		$ajaxdata['this_week_registered_member']=$this->dashboard_model->getCurrentWeekRegisteredMember();
		$ajaxdata['this_month_registered_member']=$this->dashboard_model->getCurrentMonthRegisteredMember();
		$ajaxdata['total_member']=count($this->db->query("select user_id from user_registration where user_id!='".COMP_USER_ID."'")->result_array());
		
		$total_package_sold_amount=$this->dashboard_model->getTotalPackageSoldAmount();
		$ajaxdata['total_package_sold_amount']=currency().' '.number_format($total_package_sold_amount,2);	
		
		$TotalcompanyMatrixCommission=$this->dashboard_model->getTotalcompanyMatrixCommission(COMP_USER_ID);
		$ajaxdata['TotalcompanyMatrixCommission']=currency().' '.number_format($TotalcompanyMatrixCommission,2);
		
		$TotalcompanyMatrixCompleteCommission=$this->dashboard_model->getTotalcompanyMatrixCompleteCommission(COMP_USER_ID);
		$ajaxdata['TotalcompanyMatrixCompleteCommission']=currency().' '.number_format($TotalcompanyMatrixCompleteCommission,2);
		
		
		
			$ajaxdata['company_total_commission']=currency().' '.number_format($TotalcompanyMatrixCompleteCommission+$TotalcompanyMatrixCommission,2);

		
		$total_member_matrix_complete_commission=$this->dashboard_model->gettotal_member_matrix_complete_commission();
		$ajaxdata['total_member_matrix_complete_commission']=currency().' '.number_format($total_member_matrix_complete_commission,2);
	
		$total_all_member_matrix_commission=$this->dashboard_model->gettotal_all_member_matrix_commission();
		$ajaxdata['total_all_member_matrix_commission']=currency().' '.number_format($total_all_member_matrix_commission,2);
		
		$ajaxdata['Member_gross_commission']=currency().' '.number_format($total_member_matrix_complete_commission+$total_all_member_matrix_commission,2);
		
		$company_profit=$total_package_sold_amount-($total_member_matrix_complete_commission+$total_all_member_matrix_commission);
		$ajaxdata['company_total_profit']=currency().' '.number_format($company_profit,2);
		
	   echo json_encode($ajaxdata);
	}
	
	
	public function commission_chart()
	{
		
		//////////////////////////////////////// commision chart start/////////////
		
		 $comp_reg_month_res=$this->db->query("select registration_date from user_registration where user_id='".COMP_USER_ID."'")->row_array();
		
		 $current_date=date('Y-m-d');
		 $company_reg_date=$comp_reg_month_res['registration_date'];
		 $date1=date_create($company_reg_date);
		$date2=date_create($current_date);
		$diff=date_diff($date1,$date2);
		$days=$diff->format("%a");

		
		$first = date("m", strtotime($company_reg_date) );
        $second = date("m", strtotime($current_date) );	
		
		if($first!=$second && $days<30)
		{
	    $month=2;
		}
		else
		{
		 $month=ceil($days/30);	
		}
			
		
		if($month==0)
		{
			$month=1;
		}
		else if($month>=5)
		{
			$month=4;
			
		}
		
		$Commission_chart=array();
		
		
		if($month==1)
		{
		 $display_month_year=date('Y-F');
		 
		 $main_month_year=date('Y-m');
		 
		$start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
		
		
		 
         $all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
       $array1=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$Commission_chart[]=$array1;
		
		
		}
		else if($month==2)
		{
			
			$display_month_year=date("Y-F", strtotime("-1 months"));
			$main_month_year=date("Y-m", strtotime("-1 months"));
		 
		  $start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
			
			
			
	$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
       $array2=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$display_month_year=date('Y-F');
		 
		 $main_month_year=date('Y-m');
		 
		$start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
		 

		$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array1=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$Commission_chart[]=$array2;
		$Commission_chart[]=$array1;
		
		}
		else if($month==3)
		{
			
			$display_month_year=date("Y-F", strtotime("-2 months"));
			$main_month_year=date("Y-m", strtotime("-2 months"));
		 
		  $start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
			
			
			
	$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array3=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		
		$display_month_year=date("Y-F", strtotime("-1 months"));
			$main_month_year=date("Y-m", strtotime("-1 months"));
		 
		  $start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
			
			
			
	$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array2=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$display_month_year=date('Y-F');
		 
		 $main_month_year=date('Y-m');
		 
		$start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
		 
$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array1=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$Commission_chart[]=$array3;
		$Commission_chart[]=$array2;
		$Commission_chart[]=$array1;
		
		}
		else if($month==4)
		{
			
			$display_month_year=date("Y-F", strtotime("-3 months"));
			$main_month_year=date("Y-m", strtotime("-3 months"));
		 
		$start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
			
			
			
	$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array4=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
			
			$display_month_year=date("Y-F", strtotime("-2 months"));
			$main_month_year=date("Y-m", strtotime("-2 months"));
		 
		  $start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
			
			
			
	$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array3=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		
		$display_month_year=date("Y-F", strtotime("-1 months"));
			$main_month_year=date("Y-m", strtotime("-1 months"));
		 
		  $start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
			
			
			
	$all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
       $array2=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$display_month_year=date('Y-F');
		 
		 $main_month_year=date('Y-m');
		 
		$start_date=$main_month_year.'-01';
		$end_date=$main_month_year.'-31';
		 
        $all_com=$this->db->query("select (select sum(pkg_amount) from user_registration where registration_date BETWEEN '".$start_date."' and '".$end_date."' and user_id!='".COMP_USER_ID."') as total_pkg_sold,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='6' and user_id!='".COMP_USER_ID."') as total_matrix_complete_commission,(select sum(credit_amt) from credit_debit where  receive_date BETWEEN '".$start_date."' and '".$end_date."' and reason='37' and user_id!='".COMP_USER_ID."') as total_matrix_commission")->row_array();
		
		
		
		
		if(empty($all_com['total_pkg_sold']))
		{
			$all_com['total_pkg_sold']=0;
		}
		
		if(empty($all_com['total_matrix_complete_commission']))
		{
			$all_com['total_matrix_complete_commission']=0;
		}
		if(empty($all_com['total_matrix_commission']))
		{
			$all_com['total_matrix_commission']=0;
		}
		
		
		
		$company_profit=$all_com['total_pkg_sold']-($all_com['total_matrix_complete_commission']+$all_com['total_matrix_commission']);
		
		
       $array1=array('month'=>$display_month_year,'Package_sold'=>$all_com['total_pkg_sold'],'total_matrix_commission'=>$all_com['total_matrix_commission'],'total_matrix_complete_commission'=>$all_com['total_matrix_complete_commission'],'company_profit'=>$company_profit);
		
		$Commission_chart[]=$array4;
		$Commission_chart[]=$array3;
		$Commission_chart[]=$array2;
		$Commission_chart[]=$array1;
		
		}
		
		return $Commission_chart;
		//////////////////////////////////////// commision chart end/////////////
	}
	
}//end class
