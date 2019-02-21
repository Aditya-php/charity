<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/member_model
*/
class Member_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
  public function getAllMembers()
    {
      $userQuery=$this->db->select('u.id,u.user_id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
      ->join('package as p', 'p.id=u.pkg_id')
      ->join('final_e_wallet as w', 'w.user_id=u.user_id')
      ->join('user_registration as u1', 'u.ref_id=u1.user_id' || 'u1.ref_id="'.COMP_REF_ID.'"')
      ->join('user_registration as u2', 'u.nom_id=u2.user_id' || 'u1.nom_id="'.COMP_NOM_ID.'"')
      ->group_by('u.username')
      ->order_by('id')
      ->get();
      $result=$userQuery->result();
      $result=(!empty($result))?$result:array();
      return $result;
    }//end method 
  public function getAllActiveMembers()
   {
    $userQuery=$this->db->select('u.id,u.user_id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
      ->join('package as p', 'p.id=u.pkg_id')
      ->join('final_e_wallet as w', 'w.user_id=u.user_id')
      ->join('user_registration as u1', 'u.ref_id=u1.user_id' || 'u1.ref_id="'.COMP_REF_ID.'"')
      ->join('user_registration as u2', 'u.nom_id=u2.user_id' || 'u1.nom_id="'.COMP_NOM_ID.'"')
      ->group_by('u.username')
      ->order_by('id')
      ->where('u.active_status','1')
      ->get();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
  public function getAllInActiveMembers()
   {
    $userQuery=$this->db->select('u.id,u.user_id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
      ->join('package as p', 'p.id=u.pkg_id')
      ->join('final_e_wallet as w', 'w.user_id=u.user_id')
      ->join('user_registration as u1', 'u.ref_id=u1.user_id' || 'u1.ref_id="'.COMP_REF_ID.'"')
      ->join('user_registration as u2', 'u.nom_id=u2.user_id' || 'u1.nom_id="'.COMP_NOM_ID.'"')
      ->group_by('u.username')
      ->order_by('id')
      ->where('u.active_status','0')
      ->get();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
  public function getAllDirectMember($user_id)
   {
    $userQuery=$this->db->select('u.id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
    ->join('package as p', 'p.id=u.pkg_id')
    ->join('final_e_wallet as w', 'w.user_id=u.user_id')
    ->join('user_registration as u1', 'u.ref_id=u1.user_id')
    ->join('user_registration as u2', 'u.nom_id=u2.user_id')
    ->where('u.ref_id',$user_id)
    ->get();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
  public function getAllDownlineMembers($user_id)
   {
    $userQuery=$this->db->select('u.id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,l.level,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
    ->join('package as p', 'p.id=u.pkg_id')
    ->join('level_income_binary as l', 'l.income_id=u.user_id')
    ->join('final_e_wallet as w', 'w.user_id=u.user_id')
    ->join('user_registration as u1', 'u.ref_id=u1.user_id')
    ->join('user_registration as u2', 'u.nom_id=u2.user_id')
    ->where('u.ref_id',$user_id)
    ->get();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
   public function getUserId($username)
   {
    $this->db->where('username',$username);
    $this->db->or_where('user_id',$username);
    $user_obj=$this->db->select('user_id')->from('user_registration')->get()->row();
    $user_id=(!empty($user_obj->user_id))?$user_obj->user_id:null;
    return $user_id;
   }//end method
}//end class
?>