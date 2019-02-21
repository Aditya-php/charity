<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/store_management_model
*/
class Store_Management_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllShopCategory()
  {
  	return $this->db->select('*')->from('shop_category')->order_by('id','desc')->get()->result();
  }  
  public function getAllRelatedShopCategory($cat_id=null)
  {
		$all_parent_category=array();
		if(!empty($cat_id))
		{
		$this->db->where('s.id',$cat_id);
		}
		$all_parent_category=$this->db->select('s.*')->from('shop_category as s')
		->join('shop_category_meta as sm','sm.category_id = s.id and sm.category_id=sm.parent_id')
		->get()
		->result();
        $all_child_id=array();
        foreach($all_parent_category as $parent) 
        {
			$id=$parent->id;
			while($id!='')
			{
				
				 $info=$this->db->select('shop.id,shop.category_name,shop.create_date,shop.status,sm.category_id')->from('shop_category_meta as sm')
				 ->join('shop_category as shop','shop.id=sm.category_id')
				 ->where(array('sm.parent_id'=>$id,'sm.category_id !='=>$id))->get()->row();
				 if(!empty($info->category_id))
				 {
				 	$parent->child[]=$info;
				 }
				 $id=(!empty($info->category_id))?$info->category_id:'';
			}//end while
        }//end foreach
        return $all_parent_category;
   }//end method
   public function getAllChildCategory($parent_cat)
   {
		$all_child_id=array();
		while($parent_cat!='')
		{
			$info=$this->db->select(array('sc.id','sc.category_name','sc.create_date','sc.status','sm.category_id'))->from('shop_category_meta as sm')
			->join('shop_category as sc','sc.id=sm.category_id')
			->where(array('sm.parent_id'=>$parent_cat,'sm.category_id !='=>$parent_cat))->get()->row();
			if(!empty($info->category_id))
			{
				$all_child_id[]=$info;
			}
			$parent_cat=(!empty($info->category_id))?$info->category_id:'';
		}//end while
		return $all_child_id;
   }//end method
   public function getAllParentCategory($child_cat)
   {
		$all_parent_id=array();
		$i=0;
		while($child_cat!='')
		{
			$i++;
			$info=$this->db->select(array('sc.id','sc.category_name','sc.create_date','sc.status','sm.category_id','sm.parent_id'))->from('shop_category_meta as sm')
			->join('shop_category as sc','sc.id=sm.parent_id')
			
			->order_by('sc.id','desc')
			->where(array('sm.parent_id !='=>$child_cat, 'sm.category_id ='=>$child_cat))
			->get()->row();
			
			if(!empty($info->parent_id))
			{
				$all_parent_id[]=$info;
			}
			$child_cat=(!empty($info->parent_id))?$info->parent_id:'';
			//echo $child_cat;
		}//end while
		return $all_parent_id;
   }//end method

}//end class
?>