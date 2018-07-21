<?php

/**
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller {

    var $viewData = array();
    var $per_page = DEFAULT_PAGING;

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array('user_model' => 'user'));
        $this->viewData['pageModule'] = 'User Manager';
    }

    public function index() {
        $this->acl->has_permission('user-index');
        $condition = array('grp.id' => '2');
        if ($this->input->is_ajax_request()) {
            $orderColomn = array(1 => 'first_name', 2 => 'email', 3 => 'phone', 4 => 'created_on', 5 => 'last_login', 6 => 'active');
            $params = dataTableGetRequest($this->input->get(), $orderColomn);
            if (!empty($params->search)) {
                $keyword = $this->db->escape_str($params->search);
                $condition["first_name like '%{$keyword}%' OR last_name like '%{$keyword}%' OR email = '{$keyword}' OR phone = '{$keyword}'"] = null;
            }
            $result = $this->user->get_list($condition, $params->limit, $params->order, TRUE);
            if ($result->data->num_rows() > 0) {
                $response['data'] = $this->showTableData($result->data->result());
            } else {
                $response['data'] = array();
            }
            $response['recordsFiltered'] = $response['recordsTotal'] = $result->num_rows;
            $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
            exit();
        }
        $this->viewData['title'] = "User list";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['pageHeading'] = 'User Listing';
        $this->viewData['breadcrumb'] = array('User Manager' => 'admin/users', $this->viewData['title'] => '');
        $this->layout->view("admin/user/index", $this->viewData);
    }

    public function showTableData($data) {
        $resultData = array();
        if ($data != "") {
            foreach ($data as $key => $row) {
                $rowData = array();
                $rowData[0] = getPageSerial($this->input->get('length'), $this->input->get('start'), $key);
                $rowData[1] = $row->first_name . ' ' . $row->last_name;
                $rowData[2] = $row->email;
                $rowData[3] = $row->phone;
                $rowData[4] = date(DATE_FORMATE, $row->created_on);
                $rowData[5] = $row->last_login != "" ? date(DATETIME_FORMATE, $row->last_login) : '';
                $rowData[6] = $this->layout->element('admin/element/_module_status', array('status' => $row->active, 'id' => $row->id, 'url' => "admin/users/changestatus"), true);
                $editUrl = 'admin/users/edit/' . $row->id;
                $deleteUrl = 'admin/users/delete';
                $rowData[7] = $this->layout->element('admin/element/_module_action', array('id' => $row->id, 'editUrl' => $editUrl, 'deleteUrl' => $deleteUrl), true);
                $resultData[] = $rowData;
            }
        }
        return $resultData;
    }

    public function add() {
        $this->acl->has_permission('user-add');
        $this->load->library('form_validation');
        if ($this->form_validation->run('add_users') === TRUE) {
            $username = NULL;
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city')
            );
            $additional_data['slug'] = create_unique_slug($additional_data['first_name'] . ' ' . $additional_data['last_name'], 'users', 'slug');
            $group = array('2');
            $this->ion_auth->register($username, $password, $email, $additional_data, $group);
            $this->session->set_flashdata("success", __('UserAddSuccess'));
            redirect("admin/users");
        }
        $this->viewData['title'] = "Add User";
        $this->viewData['pageHeading'] = $this->viewData['title'];
        $this->viewData['breadcrumb'] = array('User Manager' => 'admin/users', $this->viewData['title'] => '');

        $this->layout->view("admin/user/add", $this->viewData);
    }

    public function edit($id = null) {
        $this->acl->has_permission('user-edit');
        $this->load->library('form_validation');
        if ($this->form_validation->run('edit_users') === TRUE) {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'state' => $this->input->post('state'),
                'city' => $this->input->post('city')
            );
            if ($this->input->post('password') != "") {
                $data['password'] = $this->input->post('password');
            }
            $data['slug'] = create_unique_slug($data['first_name'] . ' ' . $data['last_name'], 'users', 'slug', 'id', $id);
            $this->ion_auth->update($id, $data);
            $this->session->set_flashdata("success", __('UserUpdateSuccess'));
            redirect("admin/users");
        }
        $this->viewData['data'] = $detail = $this->ion_auth->user($id)->row();
        if (empty($detail)) {
            show_404();
        }
        $this->viewData['title'] = "Update Profile";
        $this->viewData['pageHeading'] = $this->viewData['title'];
        $this->viewData['breadcrumb'] = array('User Manager' => 'admin/users', $this->viewData['title'] => '');
        $this->layout->view("admin/user/edit", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            if ($id > 0 && $this->ion_auth->delete_user($id)) {
                $response['success'] = __('UserDeleteSuccess');
            } else {
                $response['error'] = __('InvalidRequest');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function changestatus() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $has_permission = $this->acl->has_permission('user-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("users", array("active" => 0));
                    $response['success'] = __('UserInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("users", array("active" => 1));
                    $response['success'] = __('UserActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function _validate_email($email) {
        if ($email != "" && $this->ion_auth->email_check($email)) {
            $this->form_validation->set_message('_validate_email', 'The User %s already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}
