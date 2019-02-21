<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Network_Model extends Common_Model
{
  
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    /*
    @author   : Aditya
    @date     : 9 jun 2017
    @param    : root_id(int) 
    @desc     : It's used to get the genealogy tree element up to 3 level associated to specific root
    @return   : assoc array
    @signature: assoc_array getGenealogyTreeChildElement(int)
    */
    public function getGenealogyTreeChildElement($rootUserId)
    {
      /*
        root
        root_left
        root_left_left
        root_left_left_left
        root_left_left_right
        root_left_right     
        root_left_right_left
        root_left_right_right
        /////
        root_right
        root_right_left
        root_right_left_left
        root_right_left_right
        root_right_right
        root_right_right_left
        root_right_right_right
      */
        //$rootUserId='123456';
        $root_object=$this->db->get_where("user_registration", array('user_id' =>$rootUserId))->row();
        /*start left part object from here*/
        //root_left
        $root_left_object=$this->db->get_where("user_registration", array('nom_id'=>$root_object->user_id,'binary_pos'=>'left'));
        if(!empty($root_left_object))
          $root_left_object=$root_left_object->row();
        else 
          $root_left_object=NULL;
        //root_left_left
        if(!empty($root_left_object))
            $root_left_left_object=$this->db->get_where("user_registration", array('nom_id'=>$root_left_object->user_id,'binary_pos'=>'left'));
          else 
              $root_left_left_object=NULL;

        if(!empty($root_left_left_object))
          $root_left_left_object=$root_left_left_object->row();
        else 
          $root_left_left_object=NULL;
        //root_left_left_left
            if(!empty($root_left_left_object))
            $root_left_left_left_object=$this->db->get_where("user_registration", array('nom_id'=>$root_left_left_object->user_id,'binary_pos'=>'left'));
        else 
            $root_left_left_left_object=NULL; 
        
        if(!empty($root_left_left_left_object))
          $root_left_left_left_object=$root_left_left_left_object->row();
        else 
          $root_left_left_left_object=NULL;
            //root_left_left_right
        if(!empty($root_left_left_object))
            $root_left_left_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_left_left_object->user_id, 'binary_pos'=>'right'));
        else 
            $root_left_left_right_object=NULL;
          
        if(!empty($root_left_left_right_object))
          $root_left_left_right_object=$root_left_left_right_object->row();
        else 
          $root_left_left_right_object=NULL;
        //root_left_right
        if(!empty($root_left_object))
            $root_left_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_left_object->user_id, 'binary_pos'=>'right'));
        else 
            $root_left_right_object=NULL;
          
        if(!empty($root_left_right_object))
          $root_left_right_object=$root_left_right_object->row();
        else 
          $root_left_right_object=NULL;
        //root_left_right_left
        if(!empty($root_left_right_object))
            $root_left_right_left_object=$this->db->get_where("user_registration",array('nom_id'=>$root_left_right_object->user_id, 'binary_pos'=>'left'));
        else
            $root_left_right_left_object=NULL;
          
        if(!empty($root_left_right_left_object))
          $root_left_right_left_object=$root_left_right_left_object->row();
        else 
          $root_left_right_left_object=NULL;
        //root_left_right_right
        if(!empty($root_left_right_object))
            $root_left_right_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_left_right_object->user_id, 'binary_pos'=>'right'));
        else 
            $root_left_right_right_object=NULL;
          
        if(!empty($root_left_right_right_object))
          $root_left_right_right_object=$root_left_right_right_object->row();
        else 
          $root_left_right_right_object=NULL;
        /*end left part object over here*/
        /*start right part object from here*/
        //root_right
        $root_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_object->user_id, 'binary_pos'=>'right'));
        if(!empty($root_right_object))
          $root_right_object=$root_right_object->row();
        else 
          $root_right_object=NULL;
        //root_right_left
        if(!empty($root_right_object))
            $root_right_left_object=$this->db->get_where("user_registration",array('nom_id'=>$root_right_object->user_id, 'binary_pos'=>'left'));
        else 
            $root_right_left_object=NULL;
          
        if(!empty($root_right_left_object))
          $root_right_left_object=$root_right_left_object->row();
        else 
          $root_right_left_object=NULL;
        //root_right_left_left
        if(!empty($root_right_left_object))
            $root_right_left_left_object=$this->db->get_where("user_registration",array('nom_id'=>$root_right_left_object->user_id, 'binary_pos'=>'left'));
          else 
              $root_right_left_left_object=NULL;

        if(!empty($root_right_left_left_object))
          $root_right_left_left_object=$root_right_left_left_object->row();
        else 
          $root_right_left_left_object=NULL;
        //root_right_left_right
        if(!empty($root_right_left_object))
           $root_right_left_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_right_left_object->user_id, 'binary_pos'=>'right'));
        else 
           $root_right_left_right_object=NULL;
          
        if(!empty($root_right_left_right_object))
          $root_right_left_right_object=$root_right_left_right_object->row();
        else 
          $root_right_left_right_object=NULL;
        //root_right_right
        if(!empty($root_right_object))
            $root_right_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_right_object->user_id, 'binary_pos'=>'right'));
        else 
            $root_right_right_object=NULL;
          
        if(!empty($root_right_right_object))
          $root_right_right_object=$root_right_right_object->row();
        else 
          $root_right_right_object=NULL;
        //root_right_right_left
        if(!empty($root_right_right_object))
            $root_right_right_left_object=$this->db->get_where("user_registration",array('nom_id'=>$root_right_right_object->user_id, 'binary_pos'=>'left'));
        else 
            $root_right_right_left_object=NULL;
          
        if(!empty($root_right_right_left_object))
          $root_right_right_left_object=$root_right_right_left_object->row();
        else 
          $root_right_right_left_object=NULL;
        //root_right_right_right
        if(!empty($root_right_right_object))
            $root_right_right_right_object=$this->db->get_where("user_registration",array('nom_id'=>$root_right_right_object->user_id, 'binary_pos'=>'right'));
        else 
            $root_right_right_right_object=NULL;
          
        if(!empty($root_right_right_right_object))
          $root_right_right_right_object=$root_right_right_right_object->row();
        else 
          $root_right_right_right_object=NULL;
        /*end right part object over here*/
        $data=array(
                       'root_object' =>$root_object,
                        //left part
                       'root_left_object'               =>$root_left_object,
                       'root_left_left_object'          =>$root_left_left_object,
                       'root_left_left_left_object'     =>$root_left_left_left_object,
                       'root_left_left_right_object'    =>$root_left_left_right_object,
                       'root_left_right_object'         =>$root_left_right_object,
                       'root_left_right_left_object'    =>$root_left_right_left_object,
                       'root_left_right_right_object'   =>$root_left_right_right_object,
                        //right part
                       'root_right_object'              =>$root_right_object,
                       'root_right_left_object'         =>$root_right_left_object,
                       'root_right_left_left_object'    =>$root_right_left_left_object,
                       'root_right_left_right_object'   =>$root_right_left_right_object,
                       'root_right_right_object'        =>$root_right_right_object,
                       'root_right_right_left_object'   =>$root_right_right_left_object,
                       'root_right_right_right_object'  =>$root_right_right_right_object
                    );
        return $data;
    }
}//end class
?>