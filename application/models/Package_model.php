<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Package_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array(), $limit = array(), $order = array(), $with_num_rows = false) {
        $this->db->select("p.*,pc.name as category_name,cities.name as city_name");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        if (!empty($limit)) {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        } else {
            $this->db->order_by('p.created', 'DESC');
        }
        $this->db->join('cities', 'cities.id=p.city', 'LEFT');
        $data = $this->db->join('packages_categories as pc', 'pc.id=p.category', 'LEFT')->get("packages as p");
        if ($with_num_rows == true) {
            $num_rows = $this->db->select('p.id')->where(!empty($condition) ? $condition : 1, TRUE)->join('packages_categories as pc', 'pc.id=p.category', 'LEFT')->count_all_results("packages as p");
            return (object) array("data" => $data, "num_rows" => $num_rows);
        }
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("packages.*")
                    ->get_where("packages", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function getBySlag($type = "") {
        if ($type != "") {
            $result = $this->db->select("packages.*")
                    ->get_where("packages", array("slug" => $type, "is_active" => 1));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function get_category_list($condition = array(), $order = array()) {
        $this->db->select("*");
        if (!empty($condition)) {
            $this->db->where($condition);
        }
        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        }
        $data = $this->db->get("packages_categories");
        return $data;
    }

    public function categories_options() {
        $sql = $this->db->select('name,id')->order_by('name', 'ASC')->where(array("is_active" => 1))->get('packages_categories');
        if ($sql->num_rows() > 0) {
            $array = array('' => 'Select Category');
            foreach ($sql->result() as $row) {
                $array[$row->id] = $row->name;
            }
            return $array;
        } else {
            return false;
        }
    }

    public function getCategoryById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("*")
                    ->get_where("packages_categories", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function packages_options($empty_element = false) {
        $sql = $this->db->select('name,id')->order_by('name', 'ASC')->where(array("is_active" => 1))->get('packages');
        $array = array();
        if ($empty_element) {
            $array[''] = 'Select Package';
        }
        if ($sql->num_rows() > 0) {
            foreach ($sql->result() as $row) {
                $array[$row->id] = $row->name;
            }
        }
        return $array;
    }

}
