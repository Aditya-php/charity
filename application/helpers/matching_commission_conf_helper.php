<?php 
/*
	@author:Aditya
	@param:None
	@desc: this function is used to save the compensatation plan of the specific package for Matching commission type
	@return:none;
	@signature: void saveMatchingCommission()
*/
function saveMatchingCommission()
	{
		$obj=& get_instance();
        //////
		$pkg_id=$obj->input->post('pkg_id');
		
		$commission_type=$obj->input->post('commission_type');
		$level_type=$obj->input->post("level_type");
        if($level_type==0)
        {
        $commission=$obj->input->post("commission");
        }
        else
        {
        $commission=null;
        }
		//////
		$where=array('pkg_id ='=>$pkg_id);
        $direct_commission=$obj->db->select('id')->from('matching_commission')->where($where)->get();
        if($direct_commission->num_rows()>0)
        {
		$data=array('pkg_id'=>$pkg_id,'commission_type'=>$commission_type,'commission'=>$commission,'level_type'=>$level_type);
		$obj->db->update("matching_commission",$data,$where);
	    $matching_commission_id_obj=$obj->db->select('id')->from('matching_commission')->where($where)->get()->row();
        $obj->db->delete('matching_commission_meta', array('matching_commission_id' => $matching_commission_id_obj->id));
		if($level_type==1)
		  insertIntoMatchingCommissionMeta($level_type,$matching_commission_id_obj);   
        }
        else 
        {
		//$data=array("pkg_id"=>$pkg_id,'commission_type'=>$commission_type,'commission'=>$commission);
		$data=array('pkg_id'=>$pkg_id,'commission_type'=>$commission_type,'commission'=>$commission,'level_type'=>$level_type);
		$obj->db->insert("matching_commission",$data);
	    $matching_commission_id_obj=$obj->db->select('id')->from('matching_commission')->where($where)->get()->row();
	    if($level_type==1)
		  insertIntoMatchingCommissionMeta($level_type,$matching_commission_id_obj);
        }
	}//end function here
function insertIntoMatchingCommissionMeta($level_type=null,$matching_commission_id_obj)
{
		$obj=& get_instance();
		if($level_type==1)
	        {
	        	if(!empty($matching_commission_id_obj))
	        		$matching_commission_id=$matching_commission_id_obj->id;
	        	else 
	        		$matching_commission_id=null;
	        	$level_commission_array=$obj->input->post("level_commission");
	        	foreach ($level_commission_array as $level => $level_commission) 
	        	{

	        	  $obj->db->insert("matching_commission_meta",array('matching_commission_id'=>$matching_commission_id,'level'=>$level+1,'level_commission'=>$level_commission));
	        	}
	        }//end if        
}	
?>