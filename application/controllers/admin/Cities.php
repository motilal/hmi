<?php

/**
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cities extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->allow(array());
        $this->load->model(array('city_model' => 'city'));
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->viewData['pageModule'] = 'City Manager';
    }

    public function index() {
        $this->acl->has_permission('city-index');
        $condition = array();
        $start = (int) $this->input->get('start');
        $result = $this->city->get_list($condition);
        if ($this->input->get('download') == 'report') {
            $csv_array[] = array('name' => 'Name', 'status' => 'Status', 'created' => 'Created');
            foreach ($result->result() as $row) {
                $this->load->helper('csv');
                $csv_array[] = array('name' => $row->name, 'status' => $row->is_active == 1 ? 'Active' : 'InActive', 'created' => date(DATETIME_FORMATE, strtotime($row->created)));
            }
            $Today = date('dmY');
            array_to_csv($csv_array, "Cities_$Today.csv");
            exit();
        }
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "City Listing";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['pageHeading'] = 'City Listing';
        $this->viewData['breadcrumb'] = array('City Manager' => 'admin/cities', $this->viewData['title'] => '');
        $this->layout->view("admin/city/index", $this->viewData);
    }

    public function manage() {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        $response = array();
        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "name" => $this->input->post('name')
            );
            if ($this->input->post('id') > 0) {
                $has_permission = $this->acl->has_permission('city-edit', FALSE);
                if ($has_permission === TRUE) {
                    $data['updated'] = date("Y-m-d H:i:s");
                    $this->db->update("cities", $data, array("id" => $this->input->post('id')));
                    $resource_id = $this->input->post('id');
                    $response['msg'] = __('CityUpdateSuccess');
                    $response['mode'] = 'edit';
                }
            } else {
                $has_permission = $this->acl->has_permission('city-add', FALSE);
                if ($has_permission === TRUE) {
                    $data['is_active'] = 1;
                    $data['created'] = date("Y-m-d H:i:s");
                    $this->db->insert("cities", $data);
                    $resource_id = $this->db->insert_id();
                    $response['msg'] = __('CityAddSuccess');
                    $response['mode'] = 'add';
                }
            }
            if ($has_permission === TRUE) {
                $detail = $this->city->getById($resource_id);
                $detail->created = date(DATE_FORMATE, strtotime($detail->created));
                $detail->statusButtons = $this->layout->element('admin/element/_module_status', array('status' => $detail->is_active, 'id' => $detail->id, 'url' => "admin/cities/changestatus", 'permissionKey' => "city-status"), true);
                $detail->actionButtons = $this->layout->element('admin/element/_module_action', array('id' => $detail->id, 'editUrl' => 'admin/cities/manage', 'deleteUrl' => 'admin/cities/delete', 'editPermissionKey' => 'city-edit', 'deletePermissionKey' => 'city-delete'), true);
                $response['data'] = $detail;
                $response['success'] = true;
            } else {
                $response['error'] = $has_permission;
            }
        } else {
            $response['validation_error'] = $this->form_validation->error_array();
        }
        $this->output->set_content_type('application/json')
                ->set_output(json_encode($response))->_display();
        exit();
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('city-delete', FALSE);
            if ($has_permission === TRUE) {
                if ($id > 0 && $this->db->where("id", $id)->delete("cities")) {
                    $response['success'] = __('CityDeleteSuccess');
                } else {
                    $response['error'] = __('InvalidRequest');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function changestatus() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $has_permission = $this->acl->has_permission('city-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("cities", array("is_active" => 0));
                    $response['success'] = __('CityInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("cities", array("is_active" => 1));
                    $response['success'] = __('CityActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function _is_unique_city_name($str) {
        $condition = array('name' => $str);
        if ($this->input->post('id') != "") {
            $condition['id !='] = $this->input->post('id');
        }
        if (validate_is_unique('cities', $condition)) {
            $this->form_validation->set_message('_is_unique_city_name', 'The City name already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
