<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Bookings extends CI_Controller {

    var $viewData = array();
    var $per_page = DEFAULT_PAGING;

    public function __construct() {
        parent::__construct(); 
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("booking_model" => 'booking'));
    }

    public function index() {
        $this->acl->has_permission('booking-index');
        $condition = array();
        if ($this->input->is_ajax_request() || $this->input->get('download') == 'report') {
            $orderColomn = array(1 => 'u.first_name', 2 => 'b.journey_date', 4 => 'b.created');
            $params = dataTableGetRequest($this->input->get(), $orderColomn);
            if (!empty($params->search)) {
                $keyword = $this->db->escape_str($params->search);
                $condition["(u.first_name like '%{$keyword}%' OR u.last_name like '%{$keyword}%')"] = null;
            }
            $result = $this->booking->get_list($condition, $params->limit, $params->order, TRUE);
            if ($this->input->get('download') == 'report') {
                $this->acl->has_permission('booking-export');
                $this->generatePdf($result->data->result());
            }
            if ($result->data->num_rows() > 0) {
                $response['data'] = $this->showTableData($result->data->result());
            } else {
                $response['data'] = array();
            }
            $response['recordsFiltered'] = $response['recordsTotal'] = $result->num_rows;
            $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
            exit();
        }
        $this->viewData['title'] = "Manage Booking";
        $this->viewData['pageModule'] = 'Booking Manager';
        $this->viewData['pageHeading'] = 'Booking';
        $this->viewData['breadcrumb'] = array('Booking Manager' => '');
        $this->viewData['datatable_asset'] = true;
        $this->layout->view("admin/booking/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        $this->viewData['title'] = "Add Booking";
        if ($id > 0) {
            $this->acl->has_permission('booking-edit');
            $this->viewData['data'] = $detail = $this->booking->getById($id);
            if (empty($detail)) {
                $this->session->set_flashdata("error", __('LinkExpired'));
                redirect('admin/bookings');
            }
            $this->viewData['title'] = "Edit Booking";
        } else {
            $this->acl->has_permission('booking-add');
        }

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "user_id" => $this->input->post('user'),
                "package_id" => $this->input->post('package'),
                "journey_date" => date('Y-m-d', strtotime($this->input->post('journey_date'))),
                "journey_time" => date('H:i:s', strtotime($this->input->post('journey_time'))),
                "guest_adult" => $this->input->post('guest_adult'),
                "guest_child" => $this->input->post('guest_child'),
                "guest_infant" => $this->input->post('guest_infant'),
                "pickup_location" => $this->input->post('pickup_location'),
                "message" => $this->input->post('message')
            );

            if ($this->input->post('id') > 0) {
                $data['updated'] = date("Y-m-d H:i:s");
                $this->db->update("booking", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", __('BookingUpdateSuccess'));
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                $this->db->insert("booking", $data);
                $this->session->set_flashdata("success", __('BookingAddSuccess'));
            }
            redirect("admin/bookings");
        }
        $this->viewData['pageModule'] = 'Add Booking';
        $this->viewData['datetimepicker_asset'] = true;
        $this->viewData['breadcrumb'] = array('Booking Manager' => 'admin/bookings', $this->viewData['title'] => '');
        $this->load->model(['user_model' => 'user', 'package_model' => 'package']);
        $this->viewData['users_options'] = $this->user->users_options(TRUE);
        $this->viewData['packages_options'] = $this->package->packages_options(TRUE);
        $this->layout->view("admin/booking/manage", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('booking-delete', FALSE);
            if ($has_permission === TRUE) {
                if ($id > 0 && $this->db->where("id", $id)->delete("booking")) {
                    $response['success'] = __('BookingDeleteSuccess');
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
            $has_permission = $this->acl->has_permission('booking-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("bookings", array("is_active" => 0));
                    $response['success'] = __('BookingInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("bookings", array("is_active" => 1));
                    $response['success'] = __('BookingActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    private function showTableData($data) {
        $resultData = array();
        if ($data != "") {
            foreach ($data as $key => $row) {
                $rowData = array();
                $rowData[0] = getPageSerial($this->input->get('length'), $this->input->get('start'), $key);
                $rowData[1] = $row->user_name;
                $rowData[2] = date(DATE_FORMATE, strtotime($row->journey_date)) . ' ' . $row->journey_time;
                $rowData[3] = 'Adult(' . $row->guest_adult . '),Child(' . $row->guest_child . '),Infant(' . $row->guest_infant . ')';
                $rowData[4] = date(DATE_FORMATE, strtotime($row->created));
                $editUrl = 'admin/bookings/manage/' . $row->id;
                $deleteUrl = 'admin/bookings/delete';
                $rowData[5] = $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'editUrl' => $editUrl, 'deleteUrl' => $deleteUrl, 'editPermissionKey' => 'booking-edit', 'deletePermissionKey' => 'booking-delete'), true);
                $resultData[] = $rowData;
            }
        }
        return $resultData;
    }

    private function generatePdf($result) {
        $this->load->helper('csv');
        $csv_array[] = ["user" => 'User Name',
            "package" => 'Package Name',
            "journey_date" => 'Journey Date',
            "journey_time" => 'Journey Time',
            "guest_adult" => 'Guest Adult',
            "guest_child" => 'Guest Child',
            "guest_infant" => 'Guest Infant',
            "pickup_location" => 'Pickup Location',
            "message" => 'Message',
        ];
        if (!empty($result)) {
            foreach ($result as $row) {
                $csv_array[] = ["user_id" => $row->user_name,
                    "package_id" => $row->package_name,
                    "journey_date" => date('Y-m-d', strtotime($row->journey_date)),
                    "journey_time" => date('H:i', strtotime($row->journey_time)),
                    "guest_adult" => $row->guest_adult,
                    "guest_child" => $row->guest_child,
                    "guest_infant" => $row->guest_infant,
                    "pickup_location" => $row->pickup_location,
                    "message" => $row->message
                ];
            }
        }
        $Today = date('dmY');
        array_to_csv($csv_array, "Booking_$Today.csv");
        exit();
    }

}
