<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package user/package_model
*/
class Package_Model extends Common_Model
{
  public function __construct()
  {
        //@call to parent CI_Model constructor
        parent::__construct();
  }
  /*
   @Desc: It's used to get all the details of specfic package on the basis of package id
  */
  public function getPackageDetails($package_id)
  {
    $package_details=$this->db->select('*')->from('package')->where('id',$package_id)->get()->row();
    return $package_details;
  }
  /*
   @Desc: It's used to get all the package weather activated or deactivated
  */
  public function getAllPackage()
  {
    $packages=$this->db->select('*')->from('package')->order_by('id','desc')->get()->result();
    return $packages;
  }
  /*
   @Desc: It's used to get all the active package
  */
  public function getAllActivePackage()
  {
    $packages=$this->db->select('*')->from('package')->where('status','1')->order_by('id','desc')->get()->result();
    return $packages;
  }
  /*
   @Desc: It's used to get my activated package
  */
  public function getMyActivePackage($user_id)
  {
    $package=$this->db->select('p.*')->from('package as p')->join('user_registration as u', 'p.id=u.pkg_id')->where('user_id',$user_id)->order_by('p.id','desc')->get()->row();
    return $package;
  }  
  /*
   @Desc: It's used to get all the activated package excluded my active package and also which have more amount to your currenct active pacakge 
  */
  public function getAllExcludedActivePackage($user_id,$current_package_amount)
  {
    $packages=$this->db->select('p.*')->from('package as p')->join('user_registration as u', 'p.id!=u.pkg_id')->where(array('u.user_id'=>$user_id, 'p.status'=>'1', 'p.amount >='=>$current_package_amount))->order_by('p.id','desc')->get()->result();
    return $packages;
  }  
  public function upgradePackage($user_id,$new_package_id)
  {
    $res=$this->db->select('*')->from('user_registration')->where('user_id', $user_id)->get()->row();
    $old_package_id=$res->pkg_id;
    //updating user_registration user  package information
    $this->db->update('user_registration',array('pkg_id'=>$new_package_id),array('user_id'=>$user_id));
    //inserting new active package entry into user_package_log
    $package_info=$this->db->select('amount')->from('package')->where('id', $new_package_id)->get()->row();
    $package_amount=$package_info->amount;
    


    $this->db->insert('user_package_log',array(
      'user_id'=>$user_id,
      'old_package_id'=>$old_package_id,
      'new_package_id'=>$new_package_id,
      'amount'=>$package_amount,
      'active_status'=>'1',
      'purchased_date'=>date('Y-m-d H:i:s')
      ));
    //updating old package entry as inactive package into user_package_log
   //$this->db->update('user_package_log',array('active_status'=>'0'),array('user_id'=>$user_id, 'old_package_id'=>$old_package_id));

     $ewallet_info=$this->db->select('amount')->from('final_e_wallet')->where('user_id',$user_id)->get()->result();
     $current_balance=$ewallet_info->amount;
     $final_balance=$current_balance-$package_amount;
     $this->db->update('final_e_wallet', array('amount'=>$final_balance),array('user_id'=>$user_id));
            $insert_data_credit_debit=array(
              'transaction_no'=>generateUniqueTranNo(),
              'user_id'=>$user_id,
              'debit_amt'=>$package_amount,
              'balance'=>$final_balance,
              'receiver_id'=>COMP_USER_ID,
              'sender_id'=>$user_id,
              'receive_date'=>date('d-m-Y'),
              'ttype'=>'Debit for package upgrade',
              'TranDescription'=>'Debit for package upgrade',
              'status'=>'0', ///it's indicate debit status
              'reason'=>'23' //Debit Amount for package upgrade
              );
            $this->db->insert('credit_debit',$insert_data_credit_debit);

    return true;
  }//end method  
  public function getUpgradedPackageLogInformation($user_id)
  {
    $package_log_information=$this->db->select(array('p.*','log.old_package_id','log.new_package_id','log.purchased_date'))->from('package as p')->join('user_package_log as log','log.old_package_id=p.id')->where('log.user_id',$user_id)->order_by('log.id','desc')->get()->result();
     return $package_log_information;
  }
  public function getAllPackages()
  {
    $res=$this->db->select('*')->from("package")->get();
    $result=(!empty($res->result()))?$res->result():array();
    return $result;
  }//end method  
  public function getPackage($package_id)
  {
    $resObj=$this->db->select('*')->from('package')->where(array('id'=>$package_id))->get();
    $result=(!empty($resObj))?$resObj->row():array();
    return $result;
  }

}//end class
?>