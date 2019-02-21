<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/IncomeReport_Model
*/
class IncomeReport_Model extends Common_Model
{
    public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    /*
    @Desc: It's used to get the direct referral commission or sponsor commission
    */
    public function getDirectReferralCommission($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.create_date',
        'cd.unique_identity'
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.sender_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'5'))->get()->result();
    }
    /*
    @Desc: It's used to get the unilevel commission
    */
    public function getLevelCommission($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.create_date',
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'9'))->get()->result();
    }
    /*
    @Desc: It's used to get the binary commission
    */
    public function getBinaryCommission($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.create_date',
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'6'))->get()->result();
    }
    /*
    @Desc: It's used to get the matching commission
    */
    public function getMatchingCommission($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.create_date',
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'7'))->get()->result();
    }

    /*
    @Desc: It's used to get the rank bonus
    */
    public function getRankUpdateBonus($user_id)
    {
      return $this->db->select(array(
        'u.user_id',
        'u.username',
        'cd.credit_amt',
        'cd.ttype',
        'cd.Remark',
        'cd.create_date',
        ))->from('credit_debit as cd')->join('user_registration as u','u.user_id=cd.user_id')->order_by('cd.id','desc')->where(array('cd.user_id'=>$user_id,'cd.reason'=>'10'))->get()->result();

    }
   /*
   @Desc:It's used to return the total commision on the basis of user_id
   */
   public function getTotalCommission($user_id)
   {
    /*
    '5'=>credit for direct commission, 
    '6'=>credit for binary commission, 
    '7'=>credit for matching commission, '
     9'=>credit for unilevel commission, 
    //'10'=>credit for rank bonus update,
    */
    $total_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        ))
        ->where_in('cd.reason',array('5','6','7','9'))
        ->get()
        ->row();
    $total_commission=$total_commission->credit_amt;
    return $total_commission;    
   }
   /*
   @Desc:It's used to return the total direct commision on the basis of user_id
   */
   public function getTotalDirectCommission($user_id)
   {
    $total_direct_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'5'
        ))
        ->get()
        ->row();
    return $total_direct_commission->credit_amt;
   }
   /*
   @Desc:It's used to return the total unilevel commision on the basis of user_id
   */
   public function getTotalUnilevelCommission($user_id)
   {
    $total_unilevel_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'9'
        ))
        ->get()
        ->row();
    return $total_unilevel_commission->credit_amt;
   }
   /*
   @Desc:It's used to return the total binary commision on the basis of user_id
   */
   public function getTotalBinaryCommission($user_id)
   {
    $total_binary_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'6'
        ))
        ->get()
        ->row();
    return $total_binary_commission->credit_amt;
   }
   /*
   @Desc:It's used to return the total matching commision on the basis of user_id
   */
   public function getTotalMatchingCommission($user_id)
   {
    $total_matching_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
        'cd.user_id'=>$user_id,
        'cd.status'=>'1',
        'cd.reason'=>'7'
        ))
        ->get()
        ->row();
    return $total_matching_commission->credit_amt;
   }

   /*
   @Desc:It's used to get the matrix commission on the basis of user_id
   */
   public function getMatrixCommission($user_id)
   {
	    $res=$this->db->query("select a.*,b.username  from credit_debit as a,user_registration as b where a.user_id='".$user_id."' and a.reason='6' and a.credit_amt!='0' and  a.user_id=b.user_id")->result();
		
      return $res;

   }
   /*
   @Desc:It's used to return the total matrix commision on the basis of user_id
   */
   public function getTotalMatrixCommission($user_id)
   {
      $total_matrix_commission=$this->db->select_sum('credit_amt')->from('credit_debit as cd')->where(array(
          'cd.user_id'=>$user_id,
          'cd.status'=>'1',
          'cd.reason'=>'6'
          ))
          ->get()
          ->row();
      return $total_matrix_commission->credit_amt;
   }    
}//end class
?>