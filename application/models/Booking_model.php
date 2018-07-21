<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Booking_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array(), $limit = array(), $order = array(), $with_num_rows = false) {
        $this->db->select("b.*,CONCAT_WS(' ',u.first_name,u.last_name) as user_name,p.name as package_name", FALSE);
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        if (!empty($limit)) {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        } else {
            $this->db->order_by('b.created', 'DESC');
        }
        $this->db->join('users as u', 'u.id=b.user_id', 'LEFT');
        $data = $this->db->join('packages as p', 'p.id=b.package_id', 'LEFT')->get("booking as b");
        if ($with_num_rows == true) {
            $num_rows = $this->db->select('b.id')->join('users as u', 'u.id=b.user_id', 'LEFT')->join('packages as p', 'p.id=b.package_id', 'LEFT')->where(!empty($condition) ? $condition : 1, TRUE)->count_all_results("booking as b");
            return (object) array("data" => $data, "num_rows" => $num_rows);
        }
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("booking.*")
                    ->get_where("booking", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

}
