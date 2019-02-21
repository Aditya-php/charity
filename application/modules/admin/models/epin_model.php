<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/epin_model
*/
class Epin_Model extends Common_Model
{
	public function __construct()
	{
	    //@call to parent CI_Model constructor
	    parent::__construct();
	}
	public function getAllPendingEpinRequest()
	{
		return $this->db->select(array(
			'e.id',
			'e.request_id',
			'u.user_id',
			'u.username',
			'p.title',
			'e.pkg_amount',
			'e.no_of_epin',
			'e.epin_amount',
			'e.payment_method',
			'e.bank_wire_proof_image',
			'e.request_date'
			))
		->join('package as p','e.pkg_id=p.id')
		->join('user_registration as u','u.user_id=e.user_id')
		->from('epin as e')
		->where('request_status','0')
		->get()
		->result();
	} 
	public function getAllApprovedEpinRequest()
	{
		return $this->db->select(array(
			'e.id',
			'e.request_id',
			'u.user_id',
			'u.username',
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
		->join('user_registration as u','u.user_id=e.user_id')
		->from('epin as e')
		->where('request_status','1')
		->get()
		->result();
	} 
	public function getAllCancelledEpinRequest()
	{
		return $this->db->select(array(
			'e.id',
			'e.request_id',
			'u.user_id',
			'u.username',
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
		->join('user_registration as u','u.user_id=e.user_id')
		->from('epin as e')
		->where('request_status','2')
		->get()
		->result();
	} 
	/*
	@Desc: It's used to get All the fresh pin 
	*/
    public function getAllActivePin()
    {
		return $this->db->select(array(
			'em.id',
			'em.epin_request_id',
			'u.user_id',
			'u.username',
			'u.active_status',
			'em.epin_code',
			'p.title',
			'em.pkg_amount',
			'em.create_date'
			))
		->join('package as p','em.pkg_id=p.id')
		->join('user_registration as u','u.user_id=em.user_id')
		->from('epin_meta as em')
		->where('em.epin_status','0')
		->get()
		->result();
    }	
	/*
	@Desc: It's used to get All the used pin
	*/
    public function getAllUsedPin()
    {
		return $this->db->select(array(
			'em.id',
			'em.epin_request_id',
			'u.user_id',
			'u.username',
			'u.active_status',
			'em.epin_code',
			'p.title',
			'em.pkg_amount',
			'em.register_username',
			'em.create_date',
			'em.status_change_date as used_date'
			))
		->join('package as p','em.pkg_id=p.id')
		->join('user_registration as u','u.user_id=em.user_id')
		->from('epin_meta as em')
		->where('em.epin_status','1')//used epin
		->get()
		->result();
    }	
	/*
	@Desc: It's used to get All the transferred pin
	*/
    public function getAllTransferredPin($user_id=null)
    {
    	return $this->db->select(array(
			'em.id',
			'em.epin_request_id',
			'u.user_id source_user_id',
			'u.username source_username',
			'em1.user_id desti_userid',
			'u.active_status',
			'em.epin_code',
			'p.title',
			'em.pkg_amount',
			'em.create_date',
			'em.status_change_date as transferred_date'
			))
		->join('package as p','em.pkg_id=p.id')
		->join('user_registration as u','u.user_id=em.user_id')
		->join('epin_meta as em1','em1.epin_code=em.epin_code and em1.epin_status="0"')
		->from('epin_meta as em')
		->where('em.epin_status','2')//transferred epin
		->get()
		->result();
    }	
	/*
	@Desc: It's used to get All the used pin
	*/
    public function getAllBlockedPin()
    {
		return $this->db->select(array(
			'em.id',
			'em.epin_request_id',
			'u.user_id',
			'u.username',
			'u.active_status',
			'em.epin_code',
			'p.title',
			'em.pkg_amount',
			'em.create_date',
			'em.status_change_date as blocked_date'
			))
		->join('package as p','em.pkg_id=p.id')
		->join('user_registration as u','u.user_id=em.user_id')
		->from('epin_meta as em')
		->where('em.epin_status','4')//blocked epin
		->order_by('em.status_change_date','desc')
		->get()
		->result();
    }
    public function getAllWebsiteEpinRequest()
    {
    	return $this->db->select('*')->from('epin_request')->get()->result();
    }

}//end class
?>