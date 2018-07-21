<?php 
/** 
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Slider_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array()) {
        $this->db->select("sliders.*");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $data = $this->db->get("sliders");
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("sliders.*")
                    ->get_where("sliders", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    } 
} 
