<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/StoreManagement
*/
class StoreManagement extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->helper("store_helper");
		$this->load->model("store_management_model");
	} 
	/*
	@Desc:
	*/
	public function addProductCategory($cat_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
		  $parent_id=$this->input->post('parent_id');
		  
		  $category_name=$this->input->post('category_name');
		  
		  $this->db->insert('shop_category',array('category_name'=>$category_name));
		  
		  $category_info=$this->db->select_max('id')->from('shop_category')->get()->row();
		  
		  $category_id=$category_info->id;
		  $parent_id=(!empty($parent_id))?$parent_id:$category_id;
		  $this->db->insert('shop_category_meta',array(
			  	'parent_id'=>$parent_id,
			  	'category_id'=>$category_id
			  	));
		  $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> New category is created successfully');
		  redirect(site_url()."admin/StoreManagement/productCategoriesList");
		  exit;
		}
		$data=array();
		if(!empty($cat_id))
		{
			echo $data['category_id']=ID_decode($cat_id);
		}
		$data['all_shop_category']=$this->store_management_model->getAllRelatedShopCategory();
		//pr($data['all_shop_category']);
	   _adminLayout("store-mgmt/add-category",$data);	
	}
	/* end method */
	/*
	@Desc:
	*/
	public function editProductCategory($cat_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
		  $parent_id=$this->input->post('parent_id');
		  $category_name=$this->input->post('category_name');
		  $this->db->insert('shop_category',array('category_name'=>$category_name));
		  $category_info=$this->db->select_max('id')->from('shop_category')->get()->row();
		  $category_id=$category_info->id;
		  $parent_id=(!empty($parent_id))?$parent_id:$category_id;
		  $this->db->insert('shop_category_meta',array(
		  	'parent_id'=>$parent_id,
		  	'category_id'=>$category_id
		  	));
		  $this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> New category is created successfully');
		  redirect(site_url()."admin/StoreManagement/productCategoriesList");
		  exit;
		}
		$data=array();
		if(!empty($cat_id))
		{
			$data['category_id']=ID_decode($cat_id);
		}
		$data['all_shop_category']=$this->store_management_model->getAllShopCategory();
	   _adminLayout("store-mgmt/edit-category",$data);	
	}
	/* end method */
	public function deleteProductCategory($cat_id=null)
	{
		$id=ID_decode($cat_id);
		$all_child_id=array();
		while($id!='')
		{
			 $all_child_id[]=$id;
			 $info=$this->db->select('*')->from('shop_category_meta')->where('parent_id',$id)->get()->row();
			 $id=(!empty($info->category_id))?$info->category_id:'';
		}
		$this->db->where_in('category_id',$all_child_id)->delete('shop_category_meta');
		$this->db->where_in('id',$all_child_id)->delete('shop_category');
		$this->db->where_in('product_category',$all_child_id)->delete('shop_product');
		$this->session->set_flashdata("flash_msg",'<span class="text-semibold">Well done!</span> category is deleted successfully');
		redirect(site_url()."admin/StoreManagement/productCategoriesList");
		exit;
	}
	/*
	@Desc:
	*/
	public function productCategoriesList($cat_id=null)
	{
		$data=array();
		$data['all_shop_category']=$this->store_management_model->getAllShopCategory();
	   _adminLayout("store-mgmt/categories-list",$data);	
	}
	/* end method */
	/*
	@Desc:
	*/
	public function addNewProduct($cat_id=null)
	{
		if(!empty($this->input->post('btn')))
		{
		  redirect(site_url()."admin/StoreManagement/addNewProduct");
		  exit;
		}
		$data=array();
		$data['all_shop_category']=$this->store_management_model->getAllRelatedShopCategory();
		if(!empty($cat_id))
		{
			$data['category_id']=ID_decode($cat_id);
		}
	   _adminLayout("store-mgmt/add-new-product",$data);	
	}
	/* end method */
	/*
	@Desc:
	*/
	public function allProductsList()
	{
		$data=array();
	   _adminLayout("store-mgmt/all-products-list",$data);	
	}
	/* end method */
	/*
	@Desc:
	*/
	public function stockManagementList()
	{
		$data=array();
	   _adminLayout("store-mgmt/stock-management-list",$data);	
	}
	/* end method */
	/*
	@Desc:
	*/
	public function visitStore()
	{
		$data=array();
	   _adminLayout("store-mgmt/visit-store",$data);	
	}
	/* end method */
}//end class
