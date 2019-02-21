<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/PayoutReport
*/
class PayoutReport extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("payout_model");
	}//end constructor 
	public function activePayout()
	{
		$data=array();
		$data['all_active_payout']=$this->payout_model->getAllActivePayoutRequest();
		//pr($data['all_active_payout']);
		_adminLayout("payout-report-mgmt/active-payout",$data);
	}
	public function payoutCompleted()
	{
		$data=array();
		$data['all_completed_payout_request']=$this->payout_model->getAllCompletedPayoutRequest();
		//pr($this->payout_model->getAllCompletedPayoutRequest());die;
		_adminLayout("payout-report-mgmt/payout-completed",$data);
	}
	public function payoutCancelled()
	{
		$data=array();
		$data['all_cancelled_payout_request']=$this->payout_model->getAllCancelledPayoutRequest();
		_adminLayout("payout-report-mgmt/payout-cancelled",$data);
	}
	public function payoutGraph()
	{
		$data=array();
		_adminLayout("payout-report-mgmt/payout-graph",$data);
	}
	public function approvePayoutRequest($request_id, $user_id)
    { 
	$id      = ID_decode($request_id); 
	$user_id = ID_decode($user_id); 
	$this->db->update('withdrawl_wallet_amount_request', array('status' => '1','response_date' => date("Y-m-d H:i:s")), array('id' => $id));  
	
	$this->export_single_payoutdata($id, $user_id);
    }
    public function export_single_payoutdata($id, $user_id) 
	{    
    header("Content-type: text/csv");  
	header("Content-Disposition: attachment; filename=export_payed_member.csv");  
	header("Pragma: no-cache");   
	header("Expires: 0");   
	$content    = '';   
	$title      = ''; 
	$ii         = 1;  
	$userdetail = $this->db->query("select a.*,b.* from withdrawl_wallet_amount_request as a,user_registration as b where a.id='" . $id . "' and a.user_id=b.user_id")->result_array();   
	$content .= $ii . ",";   
	$content .= $userdetail[0]['request_id'] . ",";  
	$content .= $userdetail[0]['user_id'] . ",";   
	$content .= $userdetail[0]['title'] . ",";   
	$content .= $userdetail[0]['amount'] . ",";    
    $content .= $userdetail[0]['username'] . ",";  
	$content .= $userdetail[0]['email'] . ",";    
    $content .= $userdetail[0]['contact_no'] . ","; 
	if ($userdetail[0]['status'] == 0) 
	{       
$status = 'Pending';   
     }
	 else if ($userdetail[0]['status'] == 1) 
	 {   
 $status = 'Approved';   
 } 
 else if ($userdetail[0]['status'] == 2)
	 {       
 $status = 'Cancelled';   
 }     
 $content .= $status . ",";   
 $content .= $userdetail[0]['request_date'] . ",";  
 $content .= $userdetail[0]['response_date'] . ","; 
 if ($userdetail[0]['payment_method'] == 1) 
	 {     
 $method              = 'Bank Wire';   
 $bnk_name            = $userdetail[0]['bank_name'];   
 $branch_name         = $userdetail[0]['branch_name'];    
 $account_holder_name = $userdetail[0]['account_holder_name'];    
 $account_no          = $userdetail[0]['account_no'];         
 }		        $content .= $method . ",";     
 $content .= $bnk_name . ",";    
 $content .= $branch_name . ",";    
 $content .= $account_holder_name . ",";    
 $content .= $account_no . ",";        
 $content .= "\n";   
 $title .= "Sr.No ,Request Id,User Id,Title,Amount,Username,Email,Contact No,Status,Request Date,Response date ,Method,Bank Name,Branch Name,Account Holder Name,Account No " . "\n";  
 echo $title;     
 echo $content;     
 $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is approved successfully'); 
 } 
 public function allpayout()  
 {      
   $alldata = $this->input->post('alldata');    
   if (empty($alldata))
   {         
   $this->session->set_flashdata("error_msg", '<span class="text-semibold">Please checked checkbox for multiple data');            redirect(site_url() . "admin/PayoutReport/activePayout");  
   exit();       
   }
  
   foreach ($alldata as $all) 
   {   
   $this->db->update('withdrawl_wallet_amount_request', array('status' => '1','response_date' => date("Y-m-d H:i:s")), array('id' => $all));   
   }  
   $this->export_multiple_payoutdata($alldata);    
 } 
   
   public function export_multiple_payoutdata($alldata)  
   {  
   header("Content-type: text/csv");   
   header("Content-Disposition: attachment; filename=export_multiplepayed_member.csv");  
   header("Pragma: no-cache");    
   header("Expires: 0");     
   $content = '';     
   $title   = '';    
   $ii      = 1;   
   foreach ($alldata as $all)
   {        
   $userdetail = $this->db->query("select a.*,b.* from withdrawl_wallet_amount_request as a,user_registration as b where a.id='" . $all . "' and a.user_id=b.user_id")->result_array();   
   $content .= $ii . ",";   
   $content .= $userdetail[0]['request_id'] . ",";     
   $content .= $userdetail[0]['user_id'] . ",";      
   $content .= $userdetail[0]['title'] . ",";      
   $content .= $userdetail[0]['amount'] . ",";     
   $content .= $userdetail[0]['username'] . ",";    
   $content .= $userdetail[0]['email'] . ",";     
   $content .= $userdetail[0]['contact_no'] . ",";  
   if ($userdetail[0]['status'] == 0) 
   {         
       $status = 'Pending';     
       } 
	   else if ($userdetail[0]['status'] == 1) 
	   {       
   $status = 'Approved';    
   } 
   else if ($userdetail[0]['status'] == 2) 
   {             
   $status = 'Cancelled';     
   }         
   $content .= $status . ",";     
   $content .= $userdetail[0]['request_date'] . ",";    
   $content .= $userdetail[0]['response_date'] . ",";     
   if ($userdetail[0]['payment_method'] == 1) 
	   {          
   $method              = 'Bank Wire';        
   $bnk_name            = $userdetail[0]['bank_name'];  
   $branch_name         = $userdetail[0]['branch_name'];   
   $account_holder_name = $userdetail[0]['account_holder_name'];   
   $account_no          = $userdetail[0]['account_no'];       
       }          
   $content .= $method . ",";     
   $content .= $bnk_name . ",";    
   $content .= $branch_name . ",";   
   $content .= $account_holder_name . ",";     
   $content .= $account_no . ",";          
   $content .= "\n";      
   $ii++;      
   }       
   $title .= "Sr.No ,Request Id,User Id,Title,Amount,Username,Email,Contact No,Status,Request Date,Response date ,Method,Bank Name,Branch Name,Account Holder Name,Account No  " . "\n";    
   echo $title;      
   echo $content;   
   $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is approved successfully');  
   }
   
	public function cancelPayoutRequest($request_id)
	{
	    $id=ID_decode($request_id);
	    $this->db->update('withdrawl_wallet_amount_request', array('status'=>'2', 'response_date'=>date("Y-m-d H:i:s")), array('id'=>$id));
	    $request=$this->db->select('*')->from('withdrawl_wallet_amount_request')->where('id',$id)->get()->row();
	    $wallet=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$request->user_id)->get()->row();
	    $final_balance=$wallet->amount+$request->amount;
	    $this->db->update('final_e_wallet',array('amount'=>$final_balance),array('user_id'=>$request->user_id));
	    $insert_data_credit_debit=array(
	            'transaction_no'=>generateUniqueTranNo(),
	            'user_id'=>$request->user_id,
	            'credit_amt'=>$request->amount,
	            'balance'=>$final_balance,
	            'receiver_id'=>$request->user_id,
	            'sender_id'=>COMP_USER_ID,
	            'receive_date'=>date('d-m-Y'),
	            'ttype'=>'withdrawl request cancelled refund',
	            'TranDescription'=>'withdrawl request cancelld refund',
	            'status'=>'1', ///it's indicate credit status
	            'reason'=>'14' //it's indicate withdrawal request cancel refund
	            );//end credit debit data
	    $this->db->insert('credit_debit',$insert_data_credit_debit);
	    $this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Payout request is cancelled successfully');
	    redirect(site_url()."admin/PayoutReport/payoutCancelled");
	}
	
	public function getAjaxpayoutDetails($userid)
	{
	  	 $user_id=ID_decode($userid);
	 $result=$this->db->query("select * from user_registration where user_id='".$user_id."'")->row_array();
	
	
	 ?>
	 <h2 class="bg-blue" style="text-align:center;">
	  <?php echo $result['username']; ?> Bank Details
	 </h2>
	<table class="table table-responsive">
	<tr>
	<td><b>Account Holder Name:</b> </td><td><?php echo $result['account_holder_name']; ?></td>
	<td><b>Bank Name:</b> </td><td><?php echo $result['bank_name']; ?></td>
	<td><b>Account No.:</b> </td><td><?php echo $result['account_no']; ?></td>
	
	</tr>
	
    </table>	
	 <?php
	 
	}
	
}//end class