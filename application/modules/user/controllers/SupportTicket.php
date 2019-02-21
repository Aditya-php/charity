<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  @package admin/SupportTicket
 */

class SupportTicket extends Common_Controller {

    private $userId;

    public function __construct() {
        //@call to parent CI_Controller constructor
        parent::__construct();
        user_auth();
        $this->load->helper('layout');
        $this->userId = $this->session->userdata('user_id');
        $this->load->model('support_ticket_model');
    }

    /**
     * openTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function openTicket() {
        try {

            if (isPostBack()) {

                if ($this->form_validation->run('open_ticket')) {

                    $rand = rand(100000,999999);

                    $post = $this->input->post();
                    $post['user_id'] = $this->userId;
                    $post['ticket_no'] = $rand;
                    unset($post['ticket_url']);
                    unset($post['submit']);

                    if (!empty($_FILES['attachment']['name'])) {

                        /* $path = FCPATH . 'images/' . $post['old_image'];
                          if (!empty($post['old_image'])) {
                          if (file_exists($path)) {
                          unlink($path);
                          }
                          } */

                        $config['upload_path'] = 'images/';
                        $config['allowed_types'] = 'jpg|jpeg|png';
                        $config['max_size'] = 2097152;
                        $config['max_width'] = 1024;
                        $config['max_height'] = 768;

                        $this->load->library('upload', $config);

                        if (!$this->upload->do_upload('attachment')) {

                            $errors = $this->upload->display_errors();
                            echo json_encode(['msg' => $errors, 'type' => 'error']);
                            exit;
                        } else {

                            $data = array('upload_data' => $this->upload->data());
                        }
                        $post['attachment'] = $_FILES['attachment']['name'];
                    } else {

                        $post['attachment'] = '';
                    }

                    if ($this->support_ticket_model->createTicket($post)) {

                        
						echo json_encode(['msg' => 'Ticket created successfully.', 'type' => 'success']);
                        exit;
                    }
                } else {

                    $errors = validation_errors();
                    echo json_encode(['msg' => $errors, 'type' => 'error']);
                    exit;
                }
            } else {

                $ticket_obj = $this->support_ticket_model->getUserTicket($this->userId, 1);
                $data['ticket_obj'] = $ticket_obj;

                _adminLayout("support-ticket/open-ticket", $data);
            }
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * closedTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function closedTicket() {
        try {
            $ticket_obj = $this->support_ticket_model->getUserTicket($this->userId, 0);
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
            _adminLayout("support-ticket/view-ticket", $data);
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    /**
     * responseTicket
     * @return json
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function responseTicket() {
        try {
            
            if (isPostBack()) {
                
                if ($this->form_validation->run('response_ticket')) {

                   
                    $post = $this->input->post();
                    $post['user_id'] = $this->userId;
                    $post['responser'] = 'Member';
                    unset($post['ticket_url']);
                    unset($post['submit']);
                    if ($this->support_ticket_model->responseTicket($post)) {
                        
                        echo json_encode(['msg' => 'Reply send Successfully.', 'type' => 'success']);
                        exit;
                    }
                } else {
                    $errors = validation_errors();
                    echo json_encode(['msg' => $errors, 'type' => 'error']);
                    exit;
                }
            }
        } catch (Exception $ex) {
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

}

//end class
