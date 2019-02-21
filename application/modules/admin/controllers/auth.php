<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
@package admin/auth
*/
class Auth extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		/***/
		$this->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
		$this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
		$this->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
		$this->output->set_header('Pragma: no-cache');
		/***/
		$this->load->model("auth_model","auth");
	}
	/*
     @it's used for displaying login page if user is not already login otherwise redirect into admin back-office
	*/
	public function index()
	{
		$authInfo=$this->session->all_userdata();
		if(is_array($authInfo) && array_key_exists("auth",$authInfo))
		{
			if($authInfo['auth'])
			{
				$userType=$authInfo['userType'];
				if($userType==1)
				{
				 redirect(site_url()."admin/");	
				 exit;
				}
			}
			else 
			{
				$this->load->view("auth-mgmt/login");
			}
		}
		
		else 
		{
		    $this->load->view("auth-mgmt/login");
		}
    }	
    /*
      @it's used check weather the enter user exist or not if exist then make them login
    */	
	public function login()
	{
	  $username=$this->input->post("username");
      $password=$this->input->post("password");	  
	  if($this->auth->userExists($username,$password))
	  {
		  $userdata = array(
					   'username'  => $this->auth->userName,
					   'password'  => $this->auth->userPassword,
					   'userType'  =>1,
					   'user_id'   =>$this->auth->user_id,
					   'token_id'  =>$this->auth->token_id,
					   'auth'      => TRUE
				   );
		  $this->session->set_userdata($userdata); 
		  redirect(site_url()."admin/");
		  exit;
	  }
	  else 
	  {
		  if(!empty($username) && !empty($password))
		  {
			  $msg='<h5 style="color:red">Sorry entered username/password is wrong</h5>';
			  $this->session->set_flashdata('res',$msg);
		  }
		  redirect(site_url()."admin/auth");
		  exit;
	  }
	}
	/*
      @it's used to logout the user
    */	
	public function logout()
	{
		$userdata = array(
                   'username' =>'',
                   'password' =>'',
				   'userType' =>'',
				   'user_id'  =>'',
				   'token_id' =>'',
                   'auth'     =>''
               );
        $this->auth->logout($this->session->userdata('user_id'));
        $this->session->unset_userdata($userdata);
		$msg='<h5 style="color:green">you are successfully logged out</h5>';
		$this->session->set_flashdata('res',$msg);
		//$this->session->sess_destroy();
		redirect(site_url()."admin/auth");
		exit;
	}//end method
	public function username_check($username)
    {
        if(!$this->auth->isUserNameExist($username))
        {
            $this->form_validation->set_message('username_check', 'Sorry Username does not exist!');
            return FALSE;
        }
        else
        {
        	return TRUE;
        }
    }//end method
	public function forgotPassword()
	{
		if(!empty($this->input->post('btn')))
		{
			$username=$this->input->post('username');
			$this->form_validation->set_rules('username', 'Username', 'callback_username_check');
			if ($this->form_validation->run() == FALSE)
            {
                $this->load->view("auth-mgmt/forgot-password-username");
            }
            else
            {
	            $forgot_password_code=mt_rand(100000, 999999);
			    $this->session->set_userdata("forgot_password_code", $forgot_password_code);
			    $this->session->set_userdata("username", $username);
			    $email_info=$this->db->select('email')->from('admin')->where('username',$username)->get()->row();
			    $email=$email_info->email;
			    sendForgotPasswordEmailLinkToAdmin($email,$forgot_password_code);
			    redirect(site_url().'admin/auth/forgotPasswordNotify/');
			    exit;
            }
		}
		$this->load->view("auth-mgmt/forgot-password-username");
	}//end method
	public function forgotPasswordNotify()
	{
		if(!empty($this->session->userdata('forgot_password_code')))
		{
			echo '<a href="'.site_url().'admin/auth/resetPassword/'.$this->session->userdata('forgot_password_code').'">click</a>';
			$this->load->view('auth-mgmt/forgot-password-notify');
		}
		else 
		{
			redirect(site_url()."admin/auth/login");
			exit;
		}
	}//end method
	public function resetPassword($forgot_password_code=null)
	{
		if(!empty($this->input->post('btn')))
		{
			$username=$this->session->userdata('username');
			$password=$this->input->post('password');
			$password=hash('sha256', $password);
			$this->db->update("admin",array('password'=>$password),array('username'=>$username));
			redirect(site_url()."admin/auth/changePasswordConfirmation");
			exit;

		}
		if($forgot_password_code==$this->session->userdata('forgot_password_code'))
		{
			$this->load->view('auth-mgmt/reset-password');
		}
		else 
		{
			$this->session->set_flashdata('res','Sorry your forgot password code is expired!');
			redirect(site_url()."admin/auth/login");
			exit;
		}
	}//end method
	public function changePasswordConfirmation(){
		$this->load->view('auth-mgmt/change-password-confirmation');
	}//end method
}//end class

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */