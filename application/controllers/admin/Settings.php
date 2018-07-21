<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Settings extends CI_Controller {

    public $viewData;

    function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("setting_model" => 'setting'));
    }

    public function index() {
        $this->acl->has_permission('settings-index');
        $validation = array();
        $config_items = $this->setting->get_config_items();
        foreach ($config_items as $k => $v) {
            array_push($validation, array(
                'field' => "settings_{$v->id}",
                'label' => $v->title,
                'rules' => $v->is_required == 0 ? 'trim' : $v->validation_rules
            ));
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules($validation);
        $this->form_validation->set_error_delimiters('<div class="text-danger v_error">', '</div>');
        if ($this->form_validation->run() === TRUE) {
            foreach ($config_items as $k => $v) {
                $data = array(
                    "value" => $this->input->post("settings_{$v->id}", true)
                );
                $this->db->update("settings", $data, array("id" => $v->id));
            }
            $this->load->driver('cache');
            $this->cache->delete('site_setting_data');
            $this->session->set_flashdata("success", "Site settings updated successfully");
            redirect("admin/settings");
        }
        $this->viewData['settings_data'] = $config_items;
        $this->viewData['title'] = "Profile Setting";
        $this->viewData['pageModule'] = 'Setting Manager';
        $this->viewData['pageHeading'] = 'Setting';
        $this->viewData['breadcrumb'] = array('Site Setting' => '');
        $this->layout->view('admin/setting/index', $this->viewData);
    }

    public function profile() {
        if ($this->input->post()) {
            $post = $this->input->post();
            if ($post['action'] == 'change-password') {
                $this->_changePassword();
            } else if ($post['action'] == 'change-profile') {
                $this->_changeProfile();
            }
        }
        $this->viewData['data'] = $data = $this->ion_auth->user()->row();
        $this->viewData['title'] = "Profile Setting";
        $this->viewData['action'] = $this->input->post('action');
        $this->viewData['pageModule'] = 'Profile Manager';
        $this->viewData['pageHeading'] = 'Manage Profile';
        $this->viewData['breadcrumb'] = array('Manage Profile' => '');
        $this->layout->view('admin/setting/profile', $this->viewData);
    }

    protected function _changePassword() {
        $this->load->library('form_validation');
        if ($this->form_validation->run('change_admin_password') == TRUE) {
            $data = array(
                'password' => $this->input->post("new_password")
            );
            if ($this->ion_auth->update($this->ion_auth->get_user_id(), $data)) {
                $this->session->set_flashdata("success", __('PasswordChangeSuccess'));
                redirect("admin/settings/profile");
            }
        }
    }

    protected function _changeProfile() {
        $this->load->library('form_validation');
        if ($this->form_validation->run('update_profile') == TRUE) {
            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'phone' => $this->input->post('phone'),
                'two_step_authentication' => $this->input->post('two_step_authentication'),
                'multi_session' => $this->input->post('multi_session')
            );

            if ($this->ion_auth->update($this->ion_auth->get_user_id(), $data)) {
                $this->session->set_flashdata("success", __('ChangeProfileSuccess'));
                redirect("admin/settings/profile");
            }
        }
    }

    public function _validate_password() {
        $password = $this->input->post("password");
        $result = $this->db->select("users.password")
                ->where("id", $this->ion_auth->get_user_id())
                ->get("users");
        if ($result->num_rows() > 0) {
            if (password_verify($password, $result->row()->password) === TRUE) {
                return TRUE;
            }
        }
        $this->form_validation->set_message('_validate_password', 'You enter wrong %s');
        return FALSE;
    }

}
