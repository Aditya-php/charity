<?php 
/*
@desc: It returns the package information on the basis of package id
*/
if (!function_exists('getPackageInfo'))
{
    function getPackageInfo($package_id) 
    {
        $obj=& get_instance();
        $package_info=$obj->db->select('p.*')->from('package as p')->where('p.id',$package_id)->get()->row();
        return $package_info;
    }
}
?>