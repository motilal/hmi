<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_list($condition = array(), $limit = array(), $order = array(), $with_num_rows = false) {
        $this->db->select("users.*,ug.group_id,grp.name as group name");
        if (!empty($condition) || $condition != "") {
            $this->db->where($condition);
        }
        if (!empty($limit)) {
            $this->db->limit($limit['limit'], $limit['start']);
        }
        if (!empty($order)) {
            $this->db->order_by($order[0], $order[1]);
        } else {
            $this->db->order_by('created_on', 'DESC');
        }
        $this->db->join("users_groups as ug", "users.id = ug.user_id", "left");
        $this->db->join("groups as grp", "ug.group_id = grp.id", "left");
        $this->db->group_by('users.id');
        $data = $this->db->get("users");
        if ($with_num_rows == true) {
            $num_rows = $this->db->select('users.id')
                            ->join("users_groups as ug", "users.id = ug.user_id", "left")
                            ->join("groups as grp", "ug.group_id = grp.id", "left")
                            ->where(!empty($condition) ? $condition : 1, TRUE)
                            ->get("users")->num_rows();
            return (object) array("data" => $data, "num_rows" => $num_rows);
        }
        return $data;
    }

    public function getById($id) {
        if (is_numeric($id) && $id > 0) {
            $result = $this->db->select("events.*")
                    ->get_where("events", array("id" => $id));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function getBySlag($type = "") {
        if ($type != "") {
            $result = $this->db->select("events.*")
                    ->get_where("events", array("slug" => $type, "status" => 1));
            return $result->num_rows() > 0 ? $result->row() : null;
        }
        return false;
    }

    public function get_permissions() {
        $result = $this->db->select("*")->order_by('order')->get("permissions");
        return $result->num_rows() > 0 ? $result->result() : null;
    }

    public function get_userpermission_keys($condition = array()) {
        $result = $this->db->select("p.key,p.group")
                        ->join('permissions p', 'p.id=up.permission_id')
                        ->where(!empty($condition) ? $condition : 1, TRUE)->get("users_permissions as up");
        return $result->num_rows() > 0 ? $result->result() : null;
    }

    public function get_userpermissions($condition = array()) {
        $result = $this->db->select("permission_id")->where(!empty($condition) ? $condition : 1, TRUE)->get("users_permissions");
        return $result->num_rows() > 0 ? $result->result() : null;
    }

    public function check_user_permissions($key, $user_id) {
        $permission = $this->db->select('id')->get_where('permissions', array('key' => $key))->row();
        if (isset($permission->id)) {
            $result = $this->db->select("permission_id")->where(array('permission_id' => $permission->id, 'user_id' => $user_id))->get("users_permissions");
            return $result->num_rows() > 0 ? true : false;
        }
    }

    public function users_options($empty_element = false) {
        $sql = $this->db->select("CONCAT_WS(' ',u.first_name,u.last_name) as user_name,u.id", FALSE)
                ->join('users_groups as ug', 'ug.user_id=u.id AND group_id = 2', 'INNER')
                ->where(array("u.active" => 1))
                ->order_by('u.first_name', 'ASC')
                ->get('users as u');
        if ($sql->num_rows() > 0) {
            $array = array();
            if ($empty_element) {
                $array[''] = 'Select User';
            }
            foreach ($sql->result() as $row) {
                $array[$row->id] = $row->user_name;
            }
            return $array;
        } else {
            return false;
        }
    }

}
