<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/SupportTicket
*/
require FCPATH . 'vendor/autoload.php';

class SupportTicket extends Common_Controller 
{
	private $userId;

	public function __construct()
	{
		//@call to parent CI_Controller constructor

		parent::__construct();
		admin_auth();
		$this->load->model('support_ticket_model');
		$this->userId = $this->session->userdata('user_id');
		
		$this->load->helper('layout');
		
	}

public function notify()
{
    _adminLayout("support-ticket/notify");
}


	public function openTicket()
	{


        $ticket_obj = $this->support_ticket_model->getUserTicket('', '1');
        $data['ticket_obj'] = $ticket_obj;
		_adminLayout("support-ticket/open-ticket", $data);
	}
	
	/**
     * closedTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function closedTicket() {
        try {
            $ticket_obj = $this->support_ticket_model->getUserTicket('', '0');
            $data['ticket_obj'] = $ticket_obj;
            _adminLayout("support-ticket/closed-ticket", $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

	/**
     * viewTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function viewTicket($id) {
        try {
          
          $ticket_no = base64_decode($id);

            $ticket_obj = $this->support_ticket_model->viewTicket($ticket_no);
            $data['ticket_obj'] = $ticket_obj;
            $data['ticket_no'] = $ticket_no;
            
            $data['fetch_data']=$this->db->query("select * from support where ticket_no='".$ticket_no."' ")->row_array();
            
            _adminLayout("support-ticket/view-ticket", $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
public function trigger_event()
    {
        // Load the library.
        // You can also autoload the library by adding it to config/autoload.php

        $this->load->library('ci_pusher');

        $pusher = $this->ci_pusher->get_pusher();


        // Set message
        $data['message'] = 'This message was sent at ' . date('Y-m-d H:i:s');

        // Send message
       
        $event = $pusher->trigger('support-ticket', 'support-messages', $data);

        if ($event === TRUE)
        {
            echo 'Event triggered successfully!';
        }
        else
        {
            echo 'Ouch, something happend. Could not trigger event.';
        }
        _adminLayout("support-ticket/notify");
    }
    /**
     * responseTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function responseTicket() {
        try {
                if (isPostBack()) 
                {
                    if ($this->form_validation->run('response_ticket')) 
                    {
                        $post = $this->input->post();
                        $post['user_id'] = $this->userId;
                        $post['responser'] = 'Admin';
                        unset($post['ticket_url']);
                        unset($post['submit']);
                       $this->support_ticket_model->responseTicket($post);
                        $this->load->library('ci_pusher');

                        $pusher = $this->ci_pusher->get_pusher();


                        // Set message
                        $data['message'] = 'response by admin first';

                        // Send message
                        $event = $pusher->trigger('support-tickets', 'support-message', $data);

                        echo json_encode(['msg' => 'Reply send Successfully.', 'type' => 'success']);
                        exit;
                        //}
                    } 
                    else 
                    {
                        $errors = validation_errors();
                        echo json_encode(['msg' => $errors, 'type' => 'error']);
                        exit;
                    }
                }
        } 
        catch (Exception $ex) 
        {
            var_dump($ex->getMessage());
        }
    }

    /**
     * closeTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function closeTicket() {
        try {

            if (isPostBack()) {
                
                
                    $post = $this->input->post();
                    unset($post['ticket_listing']);
                    unset($post['url_close']);
                    unset($post['submit']);
                    if ($this->support_ticket_model->closeTicket($post)) {
                        echo json_encode(['msg' => 'Ticket Close Successfully.', 'type' => 'success']);
                        exit;
                    }
                
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
}//end class
