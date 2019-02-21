<?php 
/*
  @author   : Aditya
*/
/*
@desc: It's return the team type name for specfic team;
*/
if (!function_exists('getAllChildCategory')){
    function getAllChildCategory($parent_cat) 
    {
        $obj=& get_instance();
        $all_child_id=array();
        while($parent_cat!='')
        {
            $info=$obj->db->select(array('sc.id','sc.category_name','sc.create_date','sc.status','sm.category_id'))->from('shop_category_meta as sm')
            ->join('shop_category as sc','sc.id=sm.category_id')
            ->where(array('sm.parent_id'=>$parent_cat,'sm.category_id !='=>$parent_cat))->get()->row();
            if(!empty($info->category_id))
            {
                $all_child_id[]=$info;
            }
            $parent_cat=(!empty($info->category_id))?$info->category_id:'';
        }//end while
        return $all_child_id;
    }
}

if (!function_exists('getAllParentCategory')){
    function getAllParentCategory($child_cat) 
    {
        $obj=& get_instance();
        $all_parent_id=array();
        $i=0;
        while($child_cat!='')
        {
            $i++;
            $info=$obj->db->select(array('sc.id','sc.category_name','sc.create_date','sc.status','sm.category_id','sm.parent_id'))->from('shop_category_meta as sm')
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
    }
}

if (!function_exists('getParentBreadCrumb')){
    function getParentBreadCrumb($child_cat) 
    {
        $child_cat=getAllParentCategory($child_cat);
        asort($child_cat);
        $str='';
        foreach ($child_cat as $cat) 
        {
          $str .=$cat->category_name."/";
        }
        return $str;
    }
}

?>