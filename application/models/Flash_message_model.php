<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flash_message_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array()) {
        $this->db->select("flash_messages.*");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $data = $this->db->get("flash_messages");
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("flash_messages.*")
                    ->get_where("flash_messages", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function group_options() {
        $sql = $this->db->select('DISTINCT(`group`) as name')->get('flash_messages');
        if ($sql->num_rows() > 0) {
            $array = array();
            foreach ($sql->result() as $row) {
                $array[$row->name] = $row->name;
            }
            return $array;
        } else {
            return false;
        }
    }

}
