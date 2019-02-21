<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/manage_adv_model
*/
class Manage_Adv_Model extends Common_Model
{
    public function __construct()
    {
	    //@call to parent CI_Model constructor
	    parent::__construct();
    }
    public function getAllCategory()
    {
    	return $this->db->select('*')->from('adv_category')->get()->result();
    }
    /*
    @Desc:It's used to get the active advertisement
    */
    public function getAllActiveAdv()
    {
    	return $this->db->select(array('ad.id','adc.title as category_title','ad.title as adv_title','ad.descs','ad.status','ad.approval_status','ad.create_date'))
    	->from('adv as ad')
    	->join('adv_category as adc','adc.id=ad.category_id')
    	->where('ad.status','1')
    	->get()
    	->result();
    }
    /*
    @Desc:It's used to get the active approved advertisement
    */
	public function getAllActiveApprrovedAdv()
    {
    	return $this->db->select(array('ad.id','adc.title as category_title','ad.title as adv_title','ad.descs','ad.status','ad.approval_status','ad.create_date'))
    	->from('adv as ad')
    	->join('adv_category as adc','adc.id=ad.category_id')
    	->where(array('ad.status'=>'1','approval_status'=>'1'))
    	->get()
    	->result();
    }
    /*
    @Desc:It's used to get the active Disapproved advertisement
    */
 	public function getAllActiveDisapprrovedAdv()
    {
    	return $this->db->select(array('ad.id','adc.title as category_title','ad.title as adv_title','ad.descs','ad.status','ad.approval_status','ad.create_date'))
    	->from('adv as ad')
    	->join('adv_category as adc','adc.id=ad.category_id')
    	->where(array('ad.status'=>'1','approval_status'=>'0'))
    	->get()
    	->result();
    }
    /*
    @Desc:It's used to get the specific advertisement on the basis of it's id
    */
    public function getAdv($adv_id)
    {
    	return $this->db->select(array('ad.id','ad.category_id','adc.title as category_title','ad.title as adv_title','ad.image','ad.descs','ad.status','ad.approval_status','ad.create_date'))
    	->from('adv as ad')
    	->join('adv_category as adc','adc.id=ad.category_id')
    	->where('ad.id',$adv_id)
    	->get()
    	->row();
    }
}//end class
?>