<?php 
/** 
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Page_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array()) {
        $this->db->select("pages.*");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        $data = $this->db->get("pages");
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("pages.*")
                    ->get_where("pages", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function getBySlag($type = "") {
        if ($type != "") {
            $result = $this->db->select("pages.*")
                    ->get_where("pages", array("slug" => $type, "status" => 1));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

} 
