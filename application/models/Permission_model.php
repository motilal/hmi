<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permission_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array()) {
        $this->db->select("permissions.*");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $data = $this->db->get("permissions");
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("permissions.*")
                    ->get_where("permissions", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function group_options() {
        $sql = $this->db->select('DISTINCT(`group`) as name')->get('permissions');
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
