<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contacts extends CI_Controller {

    var $viewData = array();
    var $per_page = DEFAULT_PAGING;

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array('contact_model' => 'contact'));
        $this->viewData['pageModule'] = 'Enquiry Manager';
    }

    public function index() {
        $this->acl->has_permission('contact-index');
        $condition = array();
        if ($this->input->is_ajax_request() || $this->input->get('download') == 'report') {
            $orderColomn = array(1 => 'name', 2 => 'email', 3 => 'subject', 4 => 'created');
            $params = dataTableGetRequest($this->input->get(), $orderColomn);
            if (!empty($params->search)) {
                $keyword = $this->db->escape_str($params->search);
                $condition["name like '%{$keyword}%' OR email like '%{$keyword}%' OR subject = '{$keyword}'"] = null;
            }
            $result = $this->contact->get_list($condition, $params->limit, $params->order, TRUE);
            if ($this->input->get('download') == 'report') {
                $this->acl->has_permission('contact-export');
                $this->generateCsv($result->data->result());
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
        $this->viewData['title'] = "Contact list";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['pageHeading'] = 'Contact';
        $this->viewData['breadcrumb'] = array('Enquiry Manager' => 'admin/contacts', $this->viewData['title'] => '');
        $this->layout->view("admin/contact/index", $this->viewData);
    }

    public function showTableData($data) {
        $resultData = array();
        if ($data != "") {
            foreach ($data as $key => $row) {
                $rowData = array();
                $rowData[0] = getPageSerial($this->input->get('length'), $this->input->get('start'), $key);
                $rowData[1] = $row->name;
                $rowData[2] = $row->email;
                $rowData[3] = $row->subject;
                $rowData[4] = date(DATETIME_FORMATE, strtotime($row->created));
                $viewUrl = 'admin/contacts/view/' . $row->id;
                $deleteUrl = 'admin/contacts/delete';
                $rowData[5] = $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'deleteUrl' => $deleteUrl, 'deletePermissionKey' => 'contact-delete', 'viewUrl' => $viewUrl), true);
                $resultData[] = $rowData;
            }
        }
        return $resultData;
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('contact-delete', FALSE);
            if ($has_permission === TRUE) {
                if ($id > 0 && $this->db->where("id", $id)->delete("contact")) {
                    $response['success'] = __('ContactDeleteSuccess');
                } else {
                    $response['error'] = __('InvalidRequest');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function view($id = null) {
        $this->viewData['data'] = $data = $this->contact->getById($id);
        if (empty($data)) {
            show_404();
        }
        $this->viewData['title'] = "Contact View";
        $this->viewData['pageModule'] = 'Contact View';
        $this->viewData['breadcrumb'] = array('Contact Manager' => 'admin/contacts', 'View Detail' => '');
        $this->layout->view("admin/contact/view", $this->viewData);
    }

    private function generateCsv($result) {
        $this->load->helper('csv');
        $csv_array[] = ["name" => 'Name',
            "email" => 'Email',
            "subject" => 'Subject',
            "message" => 'Message',
            'created' => 'Created'
        ];
        if (!empty($result)) {
            foreach ($result as $row) {
                $csv_array[] = ["name" => $row->name,
                    "email" => $row->email,
                    "subject" => $row->subject,
                    "message" => $row->message,
                    'created' => date(DATETIME_FORMATE, strtotime($row->created))
                ];
            }
        }
        $Today = date('dmY');
        array_to_csv($csv_array, "Contact_$Today.csv");
        exit();
    }

}
