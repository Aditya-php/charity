<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MyGenealogy
*/
class MyGenealogy1 extends Common_Controller 
{
	private $userId;
	private $moduleName;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper("layout_helper");
		$this->load->model("unilevel_tree_model");
		$this->userId=$this->session->userdata('user_id');
		$this->moduleName=$this->router->fetch_module();
	} 
	/*
	@Desc: It's used to display the team view in unilevel/direct member tree format
	*/
	public function directReferralTree()
	{
		//$user_id=$this->session->userdata('user_id');
        $data['title']="Direct Referral Tree";
        $data['breadcrumb']='<li class="active">Direct Referral Tree</li>';
        $data['root']=$this->unilevel_tree_model->getUserDetails($this->userId);
        $data['all_direct_member']=$this->unilevel_tree_model->getAllDirectUser($this->userId);
	    $this->load->view("my-genealogy-mgmt/direct-referral-tree",$data);	
	}
	/*
    @desc: It's used to get all the child (direct member/unilevel tree) member on ajax request
	*/
	public function directAjaxTree($parent_id=null)
	{
        $data['root']=$this->unilevel_tree_model->getUserDetails($parent_id);
        $data['all_direct_member']=$this->unilevel_tree_model->getAllDirectUser($parent_id);
	    $this->load->view("my-genealogy-mgmt/direct_ajax_tree",$data);	

	}//end method
	/*
    @desc: It's used to get all the unilevel tree popup member info on ajax request
	*/
	public function directTreeAjaxPopupInfo($user_id)
	{
        $data['parent']=$this->unilevel_tree_model->getParentDetails($user_id);
        $data['sponsor']=$this->unilevel_tree_model->getSponsorDetails($user_id);
        $data['total_direct_downline_member']=$this->unilevel_tree_model->getTotalDirectDownline($user_id);
        $data['total_downline_member']=$this->unilevel_tree_model->getTotalDownlineMembers($user_id);
	    $this->load->view("my-genealogy-mgmt/unilevel-tree-ajax-popup-info",$data);	
	}
	public function tabularTree()
	{
        $this->load->helper('tabular_tree');
        $data['title']="Tabular Tree";
        $data['user_id']=$this->userId;
        $data['breadcrumb']='<li class="active">Upgrade Package</li>';
	   _userLayout("my-genealogy-mgmt/tabular-tree",$data);	
	}

	/*
	@Desc:It's used to display the feeder stage tree
	*/
	public function feederStageTree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}

	   $data['title']="WORKER Stage Tree";
	    $data['breadcrumb']='<li class="active">WORKER Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		
		
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		//end level2 if here!
		_userLayout("my-genealogy-mgmt1/feeder-stage-tree",$data);	
	}//end method
	/*
	@Desc:It's used to display the stage1 tree
	*/
	public function stage1Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	    $data['title']="SUPERVISOR Stage Tree";
	    $data['breadcrumb']='<li class="active">SUPERVISOR Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage1",$data);	
	}//end method

	/*
	@Desc:It's used to display the stage2 tree
	*/
	public function stage2Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	    $data['title']="MANAGER Stage Tree";
	    $data['breadcrumb']='<li class="active">MANAGER Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage2",$data);	
	}//end method

	/*
	@Desc:It's used to display the stage3 tree
	*/
	public function stage3Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	    $data['title']="GENERAL MANAGER Stage Tree";
	    $data['breadcrumb']='<li class="active">GENERAL MANAGER Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage3",$data);	
	}//end method
	/*
	@Desc:It's used to display the stage4 tree
	*/
	public function stage4Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	   $data['title']="ASSISTANT DIRECTOR Stage Tree";
	    $data['breadcrumb']='<li class="active">ASSISTANT DIRECTOR Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage4",$data);	
	}//end method
	/*
	@Desc:It's used to display the stage5 tree
	*/
	public function stage5Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	    $data['title']="DIRECTOR Stage Tree";
	    $data['breadcrumb']='<li class="active">DIRECTOR Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage5",$data);	
	}//end method
	/*
	@Desc:It's used to display the stage6 tree
	*/
	public function stage6Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	    $data['title']="ACTING CEO Stage Tree";
	    $data['breadcrumb']='<li class="active">ACTING CEO Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage6",$data);	
	}//end method
	
	
	public function stage7Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		
		/*----2nd level data-----*/
		if(!empty($level1_info_left[0]->user_id))
		{
			$level2_info_1_left1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right1=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_left[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
		
		if(!empty($level1_info_right[0]->user_id))
		{
			$level2_info_1_left2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'left','level'=>'1'))->get()->result();
			
			$level2_info_1_right2=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$level1_info_right[0]->user_id,'m.nom_leg_position'=>'right','level'=>'1'))->get()->result();
		}
	    $data['title']="CEO Stage Tree";
	    $data['breadcrumb']='<li class="active">CEO Stage Tree</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
	    ///level 1 data
		if(!empty($level1_info_left[0]))
		{
			$data['level1_username1']=$level1_info_left[0]->username;
			$data['level1_user_id1']=$level1_info_left[0]->user_id;
		}
		//
		if(!empty($level1_info_right[0]))
		{
			$data['level1_username2']=$level1_info_right[0]->username;
			$data['level1_user_id2']=$level1_info_right[0]->user_id;
		}
		//end level1 if here!
	    ///level 2 data
		////////////Left Member///////////
		if(!empty($level2_info_1_left1[0]))
		{
			$data['level2_username1']=$level2_info_1_left1[0]->username;
			$data['level2_user_id1']=$level2_info_1_left1[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right1[0]))
		{
			$data['level2_username2']=$level2_info_1_right1[0]->username;
			$data['level2_user_id2']=$level2_info_1_right1[0]->user_id;
		}
		//////////Right Member//////////////////////	
		if(!empty($level2_info_1_left2[0]))
		{
			$data['level2_username3']=$level2_info_1_left2[0]->username;
			$data['level2_user_id3']=$level2_info_1_left2[0]->user_id;
		}
		//
		if(!empty($level2_info_1_right2[0]))
		{
			$data['level2_username4']=$level2_info_1_right2[0]->username;
			$data['level2_user_id4']=$level2_info_1_right2[0]->user_id;			
		}
		_userLayout("my-genealogy-mgmt1/tree_stage7",$data);	
	}
	
}//end class
