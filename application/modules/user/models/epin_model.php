<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/epin_model
*/
class Epin_Model extends Common_Model
{
	public function __construct()
	{
	    //@call to parent CI_Model constructor
	    parent::__construct();
	}
	public function getAllPendingEpinRequest($user_id)
	{
		return $this->db->select(array(
			'e.request_id',
			'p.title',
			'e.pkg_amount',
			'e.no_of_epin',
			'e.epin_amount',
			'e.payment_method',
			'e.payment_method',
			'e.bank_wire_proof_image',
			'e.request_date'
			))
		->join('package as p','e.pkg_id=p.id')
		->from('epin as e')
		->where(array('user_id'=>$user_id,'request_status'=>'0'))
		->get()
		->result();
	} 
	public function getAllApprovedEpinRequest($user_id)
	{
		return $this->db->select(array(
			'e.request_id',
			'p.title',
			'e.pkg_amount',
			'e.no_of_epin',
			'e.epin_amount',
			'e.payment_method',
			'e.bank_wire_proof_image',
			'e.request_date',
			'e.response_date'
			))
		->join('package as p','e.pkg_id=p.id')
		->from('epin as e')
		->where(array('user_id'=>$user_id,'request_status'=>'1'))
		->get()
		->result();
	} 
	public function getAllCancelledEpinRequest($user_id)
	{
		return $this->db->select(array(
			'e.request_id',
			'p.title',
			'e.pkg_amount',
			'e.no_of_epin',
			'e.epin_amount',
			'e.payment_method',
			'e.bank_wire_proof_image',
			'e.request_date',
			'e.response_date'
			))
		->join('package as p','e.pkg_id=p.id')
		->from('epin as e')
		->where(array('user_id'=>$user_id,'request_status'=>'2'))
		->get()
		->result();
	} 
	/*
	@Desc: It's used to get All the fresh pin 
	*/
    public function getAllFreshPin($user_id)
    {
    	return $this->db->select(array(
    		'em.id',
    		'em.epin_code',
    		'p.title',
    		'em.pkg_amount',
    		'em.create_date'
    		))->from('epin_meta as em')->join('package as p','p.id=em.pkg_id')->where(array('em.user_id'=>$user_id,'em.epin_status'=>'0'))->get()->result();
    }	
	/*
	@Desc: It's used to get All the used pin
	*/
    public function getAllUsedPin($user_id)
    {
    	return $this->db->select(array(
    		'em.id',
    		'em.epin_code',
    		'p.title',
    		'em.pkg_amount',
    		'em.register_username',
    		'e.response_date as create_date',
    		'em.status_change_date as used_date'
    		))->from('epin_meta as em')->join('package as p','p.id=em.pkg_id')->join('epin as e','em.epin_request_id=e.request_id and em.pkg_id=e.pkg_id')->join('user_registration as u','u.user_id=em.user_id')->where(array('em.user_id'=>$user_id,'em.epin_status'=>'1'))->get()->result();
    }	
	/*
	@Desc: It's used to get All the transferred pin
	*/
    public function getAllTransferredPin($user_id)
    {
    	
    	$query="select inners.id, inners.epin_code, inners.user_id, inners.title, inners.pkg_amount, inners.create_date as create_date, inners.transfer_date 
    	        ,u.username as transfer_username
    	        from(SELECT 
    	        em.id, em.epin_code, em.user_id, p.title, em.pkg_amount, e.response_date as create_date, em.status_change_date as transfer_date 
    	        from epin_meta as em 
    	        JOIN package as p ON p.id=em.pkg_id 
    	        JOIN epin as e ON em.epin_request_id=e.request_id and em.pkg_id=e.pkg_id 
    	        WHERE em.user_id = '$user_id' AND em.epin_status = '2') as inners join epin_meta as em1 on em1.epin_code=inners.epin_code join user_registration 
                as u on u.user_id=em1.user_id 
                where em1.user_id!='$user_id'";
    	$result_obj=$this->db->query($query);
        return $result_obj->result();
    }	
	/*
	@Desc: It's used to get All the withdrawl pin
	*/
    public function getAllWithdrawlPin($user_id)
    {
    	return $this->db->select(array(
    		'em.id',
    		'em.epin_code',
    		'p.title',
    		'em.pkg_amount',
    		'e.response_date as create_date',
    		'em.status_change_date as withdrawl_date'
    		))->from('epin_meta as em')->join('package as p','p.id=em.pkg_id')->join('epin as e','em.epin_request_id=e.request_id and em.pkg_id=e.pkg_id')->where(array('em.user_id'=>$user_id,'em.epin_status'=>'3'))->get()->result();
    }	
}//end class
?>