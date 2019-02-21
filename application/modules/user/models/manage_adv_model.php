<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/manage_adv_model
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
    public function getAllPublishCategory()
    {
    	return $this->db->select('*')->from('adv_category')->where('status','1')->get()->result();
    }
    public function getAllAdv($user_id)
    {
    	return $this->db->select(array('ad.id','adc.title as category_title','ad.title as adv_title','ad.price as price','ad.descs','ad.status','ad.approval_status','ad.create_date'))
    	->from('adv as ad')
    	->join('adv_category as adc','adc.id=ad.category_id')
    	->where('ad.user_id',$user_id)
    	->get()
    	->result();
    }
    /*
    @Desc:It's used to get the specific advertisement on the basis of it's id
    */
    public function getAdv($adv_id)
    {
    	return $this->db->select(array('ad.id','ad.category_id','adc.title as category_title','ad.title as adv_title','ad.price as price','ad.image','ad.image1','ad.image2','ad.image3','ad.image4','ad.descs','ad.status','ad.approval_status','ad.create_date'))
    	->from('adv as ad')
    	->join('adv_category as adc','adc.id=ad.category_id')
    	->where('ad.id',$adv_id)
    	->get()
    	->row();
    }
    /*
    @desc: It's used to view all the request for specfic user
    */
    public function viewAllRequest($user_id)
    {
        return $this->db->select(array('ac.title as category_title','ad.title as adv_title','al.name','al.email','al.contact_no','al.message','al.create_date'))->from('adv_leads as al')
        ->join('adv as ad','ad.id=al.adv_id')
        ->join('adv_category as ac','ac.id=ad.category_id')
        ->where(array(
            'al.user_id'=>$user_id
          ))
        ->order_by('al.id','desc')
        ->get()
        ->result();
    }
    /*
    @desc: It's used to view all the request for specfic user
    */
    public function viewAllAdvRequest($user_id,$adv_id)
    {
        return $this->db->select(array('ac.title as category_title','ad.title as adv_title','al.name','al.email','al.contact_no','al.message','al.create_date'))->from('adv_leads as al')
        ->join('adv as ad','ad.id=al.adv_id')
        ->join('adv_category as ac','ac.id=ad.category_id')
        ->where(array(
            'al.user_id'=>$user_id,
            'al.adv_id'=>$adv_id
          ))
        ->order_by('al.id','desc')
        ->get()
        ->result();
    }
}//end class
?>