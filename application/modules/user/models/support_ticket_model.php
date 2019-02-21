<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
 * @package user/teamreport_model
 */

class Support_Ticket_Model extends Common_Model {

    private $support = 'support';
    private $support_response = 'support_response';

    public function __construct() {
        //@call to parent CI_Model constructor
        parent::__construct();
    }

    /**
     * createTicket
     * @return boolean
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function createTicket($array) {
        try {
            $this->db->insert($this->support, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * getUserTicket
     * @return object
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function getUserTicket($user_id, $status = 1) {

        try {
            
            $select_field = "id, subject, user_id, description, ticket_no, created_at, updated_at, CASE WHEN status = '1' THEN 'Open Ticket' ELSE 'Close Ticket' END as status";
            //$select_field = array('subject', 'description', 'ticket_no', 'created_at');
            $where = array('user_id' => $user_id, 'status' => $status);
            $this->db->select($select_field, false);
            //$this->db->select($select_field);
            $this->db->from($this->support);
            $this->db->where($where);
            $obj_data = $this->db->get()->result_object();
            return (isset($obj_data) && !empty($obj_data) ? $obj_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    /**
     * viewTicket
     * @return object
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function viewTicket($support_id) {

        try {
            
            $select_field = "id, user_id, ticket_no, responser, response, created_at, updated_at, CASE WHEN status = '1' THEN 'Open Ticket' ELSE 'Close Ticket' END as status";
            //$select_field = array('subject', 'description', 'ticket_no', 'created_at');
            $where = array('ticket_no' => $support_id);
            $this->db->select($select_field, false);
            //$this->db->select($select_field);
            $this->db->from($this->support_response);
            $this->db->where($where);
            $obj_data = $this->db->get()->result_object();
            return (isset($obj_data) && !empty($obj_data) ? $obj_data : '');
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }
    
    /**
     * responseTicket
     * @return object
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function responseTicket($array) {

        try {
            $this->db->insert($this->support_response, $array);
            return $this->db->insert_id();
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

    /**
     * closeTicket
     * @return object
     * @since 0.1
     * @author Sandeep Kumar
     */
    public function closeTicket($array) {

        try {

            $this->db->where('ticket_no', $array['ticket_no']);
            return $this->db->update($this->support, array('status' => '0'));
        } catch (Exception $ex) {
            var_dump($ex->getMessage());
        }
    }

}

//end class
?>