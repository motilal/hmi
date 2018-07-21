<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_config_items($condition = array()) {
        $result = $this->db->select("settings.*")
                ->get_where("settings", !empty($condition) ? $condition : array("is_active" => 1));
        return $result->num_rows() > 0 ? $result->result() : null;
    }

    public function item($config_key) {
        $result = $this->db->select("settings.value")
                ->get_where("settings", array("field_name" => $config_key));
        return $result->num_rows() > 0 ? $result->row()->value : null;
    }

}
