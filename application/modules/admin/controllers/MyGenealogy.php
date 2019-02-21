<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MyGenealogy
*/
class MyGenealogy extends Common_Controller 
{
	private $userId;
	private $moduleName;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		admin_auth();
		$this->load->helper("layout_helper");
		$this->load->model("network_model");
		$this->load->model("member_model");
		$this->load->model("package_model");
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
	   _adminLayout("my-genealogy-mgmt/tabular-tree",$data);	
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
		
	    $data['title']="WORKER TREE";
	    $data['breadcrumb']='<li class="active">WORKER TREE</li>';
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
		//_userLayout("my-genealogy-mgmt/feeder-stage-tree",$data);	
		 $this->load->view("my-genealogy-mgmt/feeder-stage-tree",$data);	
	}//end method
	public function ajaxFeederStageTree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_downline as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////root user details
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

		$this->load->view("my-genealogy-mgmt/ajax-feeder-stage-tree",$data);
	}
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
		/*----first level data-----*/

	    $data['title']="SUPERVISOR TREE";
	    $data['breadcrumb']='<li class="active">SUPERVISOR TREE</li>';
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
	  $this->load->view("my-genealogy-mgmt/stage1-tree",$data);	
	}//end method
	public function ajaxStage1Tree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage1 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
		/////
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
		$this->load->view("my-genealogy-mgmt/ajax-stage1-tree",$data);
	}
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

	    $data['title']="MANAGER TREE";
	    $data['breadcrumb']='<li class="active">MANAGER TREE</li>';
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
		 $this->load->view("my-genealogy-mgmt/stage2-tree",$data);
	}//end method
	public function ajaxStage2Tree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage2 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		 /////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
		/////
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
		$this->load->view("my-genealogy-mgmt/ajax-stage2-tree",$data);
	}
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

	    $data['title']="GENERAL MANAGER TREE";
	    $data['breadcrumb']='<li class="active">GENERAL MANAGER TREE</li>';
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
		 $this->load->view("my-genealogy-mgmt/stage3-tree",$data);
	}//end method
	public function ajaxStage3Tree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage3 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
		/////
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
		$this->load->view("my-genealogy-mgmt/ajax-stage3-tree",$data);
	}
	/*
	@Desc:It's used to display the stage4 tree
	*/
	public function stage4Tree($user_id=null)
	{
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////////////////////////
	    $data['title']="ASSISTANT DIRECTOR TREE";
	    $data['breadcrumb']='<li class="active">ASSISTANT DIRECTOR TREE</li>';
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
		 $this->load->view("my-genealogy-mgmt/stage4-tree",$data);
	}//end method
	public function ajaxStage4Tree($user_id=null)
	{
		$user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage4 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////root user details
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
		$this->load->view("my-genealogy-mgmt/ajax-stage4-tree",$data);
	}
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
		//////////////////////

	    $data['title']="DIRECTOR TREE";
	    $data['breadcrumb']='<li class="active">DIRECTOR TREE</li>';
		/////
		$data['main_user_id']=$user_id;
		$data['main_username']=$main_user->username;
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
		 $this->load->view("my-genealogy-mgmt/stage5-tree",$data);
	}//end method
	public function ajaxStage5Tree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage5 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		//////////////////////
		/////root user details
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
		$this->load->view("my-genealogy-mgmt/ajax-stage5-tree",$data);
	}
	/*
	@Desc:It's used to display the stage6 tree
	*/
	public function stage6Tree($user_id=null)
	{
	    $data=array();
		$user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();

	    $data['title']="ACTING CEO TREE";
	    $data['breadcrumb']='<li class="active">ACTING CEO TREE</li>';
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
		 $this->load->view("my-genealogy-mgmt/stage6-tree",$data);
	}//end method
	public function ajaxStage6Tree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage6 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////root user details
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
		$this->load->view("my-genealogy-mgmt/ajax-stage6-tree",$data);
	}
	
	
	public function stage7Tree($user_id=null)
	{
	    $data=array();
		$user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();

	    $data['title']="CEO TREE";
	    $data['breadcrumb']='<li class="active">CEO AMBASAADOR TREE</li>';
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
		 $this->load->view("my-genealogy-mgmt/stage7-tree",$data);
	}//end method
	public function ajaxStage7Tree($user_id=null)
	{
		$data=array();
	    $user_id=(!empty($user_id))?ID_decode($user_id):$this->userId;
		$main_user=$this->db->select('username')->from('user_registration')->where('user_id',$user_id)->get()->row();
		/*----first level data-----*/
	    
		$level1_info_left=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'left'))->get()->result();
		//pr($level1_info_left);
		
		$level1_info_right=$this->db->select(array('u.username','u.user_id'))->from('matrix_stage7 as m')->join('user_registration as u','u.user_id=m.down_id')->where(array('income_id'=>$user_id, 'level'=>'1','m.nom_leg_position'=>'right'))->get()->result();
		/////root user details
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
		$this->load->view("my-genealogy-mgmt/ajax-stage7-tree",$data);
	}
	
}//end class
