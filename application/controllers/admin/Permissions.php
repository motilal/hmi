<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Permissions extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        is_allow_admin();
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("permission_model" => 'permission'));
    }

    public function index() {
        $condition = array();
        $result = $this->permission->get_list($condition);
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Manage Permission";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['pageModule'] = 'Permission Manager';
        $this->viewData['pageHeading'] = 'Permission List';
        $this->viewData['breadcrumb'] = array('Permission Manager' => '');
        $this->layout->view("admin/permission/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "key" => $this->input->post('key'),
                "name" => $this->input->post('name'),
                "group" => $this->input->post("group"),
                "order" => (int) $this->input->post("order")
            );
            if ($this->input->post('id') > 0) {
                $this->db->update("permissions", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", 'Permission updated Successfully.');
            } else {
                $this->db->insert("permissions", $data);
                $this->session->set_flashdata("success", 'Permission added Successfully.');
            }
            redirect("admin/permissions");
        }
        $this->viewData['title'] = "Add Permission";
        if ($id > 0) {
            $this->viewData['data'] = $data = $this->permission->getById($id);
            if (empty($data)) {
                $this->session->set_flashdata("error", __('LinkExpired'));
                redirect('admin/permissions');
            }
            $this->viewData['title'] = "Edit Permission";
        }
        $this->viewData['pageModule'] = 'Add New Permission';
        $this->viewData['breadcrumb'] = array('Permission Manager' => 'admin/permissions', $this->viewData['title'] => '');
        $this->viewData['group_options'] = $this->permission->group_options();
        $this->layout->view("admin/permission/manage", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            if ($id > 0 && $this->db->where("id", $id)->delete("permissions")) {
                $response['success'] = 'Permission deleted successfully.';
            } else {
                $response['error'] = 'Invalid request';
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function _validate_permission_key($str) {
        $id = $this->input->post('id');
        $condition = array('key' => $str);
        if (!empty($id) && is_numeric($id)) {
            $condition['id !='] = $id;
        }
        $num_row = $this->db->where($condition)->count_all_results('permissions');
        if ($num_row >= 1) {
            $this->form_validation->set_message('_validate_permission_key', 'Permission key already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
