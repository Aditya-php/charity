<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/MessagePanel
*/
class MessagePanel extends Common_Controller 
{
	private $userId;
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
		user_auth();
		$this->load->helper('layout');
		$this->load->model('member_model');
		$this->load->model('message_panel_model');
		$this->userId=$this->session->userdata('user_id');
	} 
	public function inbox()
	{
		$data=array();
		$data['all_inbox_msg']=$this->message_panel_model->getAllInboxMessage($this->userId);
		_adminLayout("message-panel/inbox",$data);
	}
	function deleteInboxMessage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("message",array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is deleted successfully.');
		redirect(site_url() . "user/MessagePanel/inbox");
		exit;
	}
    function generateMessageId()
    {
        $random_number="M".mt_rand(100000, 999999);
        if($this->db->select('message_id')->from('message')->where('message_id',$random_number)->get()->num_rows()>0)
        {
          $this->generateMessageId();
        }
        return $random_number;
	}//end function
	public function composeMessage()
	{
		if(!empty($this->input->post("btn")))
		{
			$all_users=$this->input->post('users');
			//pr($all_users);
			$subject=$this->input->post('subject');
			$message=$this->input->post('message');
			$message_id=$this->generateMessageId();
			$attachment='';
			if(!empty($_FILES['attachment']))
			{
				$image_upload_path='/images/';
			    $attachment=adImageUpload($_FILES['attachment'],1, $image_upload_path);
			}
			////////////////////////////////
			foreach($all_users as $user_id)
			{
				$compose_to[]=array(
					'message_id'=>$message_id,
					'user_id'=>$user_id,
					'subject'=>$subject,
					'message'=>$message,
					'reciever_id'=>$user_id,
					'sender_id'=>$this->userId,
					'reciever_name'=>get_user_name($user_id),
					'sender_name'=>get_user_name($this->userId),
					'attachment'=>$attachment
					);
			}
			$this->db->insert_batch("message",$compose_to);
			$this->db->insert("message",array(
					'message_id'=>$message_id,
					'user_id'=>$this->userId,
					'subject'=>$subject,
					'message'=>$message,
					'sender_id'=>$this->userId,
					'sender_name'=>get_user_name($this->userId),
					'attachment'=>$attachment
					));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is sent successfully');
			redirect(site_url() . "user/MessagePanel/sentMessage");
			exit;
		}
		$data=array();
		$data['user_id']=$this->userId;
		//$data['all_active_members']=$this->member_model->getAllActiveMembers();
		$data['all_active_members']=$this->db->select('*')->from('user_registration')->where('active_status','1')->get()->result();
		_adminLayout("message-panel/compose-message",$data);
	}//end method
	public function sentMessage()
	{
		$data=array();
		$data['all_sent_msg']=$this->message_panel_model->getAllSentMessage($this->userId);
		_adminLayout("message-panel/sent-message",$data);
	}
	function deleteSentMessage($id)
	{
		$id=ID_decode($id);
		$this->db->delete("message",array('id'=>$id));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Well done!</span> Message is deleted successfully.');
		redirect(site_url() . "user/MessagePanel/sentMessage");
		exit;
	}
	public function readMessage($message_id=null)
	{
		$message_id=(!empty($message_id))?$message_id:$this->input->post('msg_id');
		$id=ID_decode($message_id);
		sleep(1);
		$msg=$this->db->select('m.*')->from('message as m')->where('id',$id)->get()->row();
		$this->output->set_content_type('application/json')->set_output(json_encode($msg));
	}
}//end class
