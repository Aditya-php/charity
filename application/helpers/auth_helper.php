<?php 
/*
@author:Global MLM(aditya)
@date:7 Jun 2017
@param:none
@desc:this function is used for admin login authorization and redirect according to specific user type role
@return:none
*/
if(!function_exists("admin_auth"))
{
	function admin_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('auth'))
			{
				redirect(site_url()."admin/auth/");
				exit;
			}
			else if($obj->session->userdata('auth')) 
			{
				
				  $userType=$obj->session->userdata("userType");
				  if($userType==2)
				  {
					 redirect(site_url()."user"); 
					 exit;
				  }
			}
	}//end auth function
}
/*
@author:Global MLM(aditya)
@date:7 Jun 2017
@param:none
@desc:this function is used for user login authorization and redirect according to specific user type role
@return:none
*/
if(!function_exists("user_auth"))
{
	function user_auth()
	{
			$obj=& get_instance();
			/***/
			$obj->output->set_header('Last-Modified:'.gmdate('D, d M Y H:i:s').'GMT');
			$obj->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
			$obj->output->set_header('Cache-Control: post-check=0, pre-check=0',false);
			$obj->output->set_header('Pragma: no-cache');
			/***/
			if(!$obj->session->userdata('auth'))
			{
				redirect(site_url()."user/auth/");
				exit;
			}
			else if($obj->session->userdata('auth')) 
			{
				  $userType=$obj->session->userdata("userType");
				  if($userType==1)
				  {
					 redirect(site_url()."admin"); 
					 exit;
				  }
			}
	}//end auth function	
}
/*
@Desc: It's used to sent an email for forgot password link to admin, so that password can be reset
*/
function sendForgotPasswordEmailLinkToAdmin($email,$forgot_password_code)
{

    $email_data['from']='test@gmail.com';
    $email_data['to']=$email;
    $email_data['subject']='iRent Reset Password Link';
    $email_data['template-header-title']='iRent Online';
    $email_data['email_verification_msg']= "Please click here to reset your password<b><a href='".site_url()."admin/auth/resetPassword/".$forgot_password_code."'>click here</a></b>";
    $email_data['email-template']='admin-forgot-password-email-template';
    _sendEmail($email_data);
}//end function
/*
@Desc: It's used to sent an email for forgot password link to user, so that password can be reset
*/
function sendForgotPasswordEmailLinkToUser($email,$forgot_password_code)
{

    $email_data['from']='test@gmail.com';
    $email_data['to']=$email;
    $email_data['subject']='iRent Reset Password Link';
    $email_data['template-header-title']='iRent Online';
    $email_data['email_verification_msg']= "Please click here to reset your password<b><a href='".site_url()."admin/auth/resetPassword/".$forgot_password_code."'>click here</a></b>";
    $email_data['email-template']='user-forgot-password-email-template';
    _sendEmail($email_data);
}//end function
?>