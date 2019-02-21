<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/message_panel_model
*/
class Message_Panel_Model extends Common_Model
{
	public function __construct()
	{
	    //@call to parent CI_Model constructor
	    parent::__construct();
	}
	public function getAllSentMessage($user_id)
	{
		$query="select tbl1.id,tbl1.message_id,tbl1.user_id,tbl1.subject,tbl1.message,tbl1.sender_name,tbl1.reciever_id,tbl.receiver_name,tbl1.ts,tbl1.attachment
				from(SELECT `m`.`message_id`, group_concat(`m1`.`reciever_name`) as receiver_name
				FROM (`message` as m) 
				join message as m1 on m1.message_id=m.message_id
				WHERE `m`.`user_id` = '".$user_id."' AND `m`.`sender_id` = '".$user_id."' and `m1`.`reciever_id` != ''
				group by m1.message_id ORDER BY m1.id desc
		     	) as tbl 
		     	join message as tbl1 on tbl.message_id=tbl1.message_id where tbl1.user_id='".$user_id."' order by tbl1.id desc";
     	$all_sent_msg_info=$this->db->query($query);
     	$all_sent_msg=$all_sent_msg_info->result();
		return $all_sent_msg;
	} 
	public function getAllInboxMessage($user_id)
	{
		return $this->db->select('*')->from('message')->where(array('user_id'=>$user_id,'reciever_id'=>$user_id))->order_by('id','desc')->get()->result();
	} 
}//end class
?>