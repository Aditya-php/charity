<?php 
/*
	@author:Aditya
	@param:None
	@desc: this function is used to save the compensatation plan of the specific package for Direct commission type
	@return:none;
	@signature: void SaveDirectCommision()
*/
function saveDirectCommission()
	{
		$obj=& get_instance();
        //////
		$pkg_id=$obj->input->post('pkg_id');
		$type=$obj->input->post('type');
		$commission=$obj->input->post('commission');
		//////
		$where=array('pkg_id ='=>$pkg_id);
        $direct_commission=$obj->db->select('id')->from('direct_commission')->where($where)->get();
        if($direct_commission->num_rows()>0)
        {
		$data=array('type'=>$type,'commission'=>$commission);
		$obj->db->update("direct_commission",$data,$where);
        }
        else 
        {
		$data=array("pkg_id"=>$pkg_id,'type'=>$type,'commission'=>$commission);
		$obj->db->insert("direct_commission",$data);
        }
	}
?>