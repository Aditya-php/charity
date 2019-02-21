<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/unilevel_tree_model
*/
class Unilevel_Tree_Model extends Common_Model
{
      public function __construct()
      {
            //@call to parent CI_Model constructor
            parent::__construct();
      }
      public function getUserDetails($user_id)
      {
        $user=$this->db->select('*')->from('user_registration')->where('user_id',$user_id)->get()->row();
        return $user;
      }
      public function getAllDirectUser($ref_id)
      {
        $all_direct_member=$this->db->select('*')->from('user_registration')->where('ref_id',$ref_id)->get()->result();
        return $all_direct_member;
      }
      public function getTotalDirectDownline($user_id)
      {
        $total_direct_downline_members=$this->db->select('id')->from('user_registration')->where('ref_id',$user_id)->get()->num_rows();
        return $total_direct_downline_members;
      }
      public function getTotalDownlineMembers($user_id)
      {
        $total_downline_members=$this->db->select('id')->from('user_registration')->where('nom_id',$user_id)->get()->num_rows();
        return $total_downline_members;
      }
      public function getParentDetails($user_id)
      {
        $user=$this->db->select('nom_id')->from('user_registration')->where('user_id',$user_id)->get()->row();
        $parent_details=$this->getUserDetails($user->nom_id);
        return $parent_details;
      }
      public function getSponsorDetails($user_id)
      {
        $user=$this->db->select('ref_id')->from('user_registration')->where('user_id',$user_id)->get()->row();
        $sponsor_details=$this->getUserDetails($user->ref_id);
        return $sponsor_details;
      }
}//end class
?>