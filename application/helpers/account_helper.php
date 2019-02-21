<?php 
/*
  @author   : Aditya
*/
/*
@desc: It's return the team type name for specfic team;
*/
if (!function_exists('getTeamTypeName')){
    function getProfileInfo() 
    {
        $obj=& get_instance();
        $obj->load->model('account_model');
        $user_id=$obj->session->userdata('user_id');
        $user=$obj->account_model->getAdminDetails($user_id);
        return $user;
    }
}

if (!function_exists('getTeamTypeName')){
    function getUserProfileInfo() 
    {
        $obj=& get_instance();
        $obj->load->model('account_model');
        $user_id=$obj->session->userdata('user_id');
        $user=$obj->account_model->getUserDetails($user_id);
        return $user;
    }
}

?>