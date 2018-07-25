<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends CI_Controller {

    public $viewData;

    function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "/";
        $this->site_santry->allow(array("login", "logout", "register", "forgot_password", "reset_password", "two_step_auth_login"));
        $this->load->library(array('ion_auth', 'form_validation'));
        $this->load->helper(array('language'));
        $this->layout->set_layout("admin/layout/layout_login");
    }

    public function login() {
        $response = [];
        if ($this->input->post()) {
            $this->form_validation->set_rules('identity', 'Email', 'required|valid_email|callback__validate_username');
            $this->form_validation->set_rules('password', str_replace(':', '', $this->lang->line('login_password_label')), 'required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'))) {
                    $response['success'] = true;
                    $response['msg'] = 'You have successfully login.';
                    $response['redirect'] = $this->input->post('request') ? $this->input->post('request') : site_url();
                } else {
                    $response['error'] = $this->ion_auth->errors();
                }
            } else {
                $response['validation_error'] = $this->form_validation->error_array();
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
        exit();
    }

    public function register() {
        $this->load->library('form_validation');
        $response = [];
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
            if ($this->ion_auth->register($username, $password, $email, $additional_data, $group)) {
                $response['success'] = true;
                $response['msg'] = 'You have successfully register.We have set you a link on your email please verify.';
            } else {
                $response['error'] = $this->ion_auth->errors();
            }
        } else {
            $response['validation_error'] = $this->form_validation->error_array();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
        exit();
    }

    function _validate_email($email) {
        if ($email != "" && $this->ion_auth->email_check($email)) {
            $this->form_validation->set_message('_validate_email', 'The User %s already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    function _validate_username($str) {
        $user = $this->db->select('users.id')->join('users_groups', 'users_groups.user_id=users.id', 'INNER')->where(array('email' => $str, 'group_id' => 2))->get('users');
        if ($user->num_rows() >= 1) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_validate_username', 'Incorrect Login.');
            return FALSE;
        }
    }

    public function two_step_auth_login($enc_email = "") {
        if (empty($enc_email)) {
            show_404();
        }
        $email = base64_decode($enc_email);
        $user = $this->db->where(array('email' => $email, 'authentication_code IS NOT NULL' => NULL))->get('users');
        if ($user->num_rows() > 0) {
            $this->form_validation->set_rules('code', 'Code', "required|callback__isValidateAuthCode[$email]");
            if ($this->form_validation->run() == false) {
                $this->viewData['title'] = "Login Authentication";
                $this->layout->view("admin/auth/two_step_auth_login", $this->viewData);
            } else {
                if ($this->ion_auth->login($email, $this->session->userdata('_auth_password'), FALSE, FALSE)) {
                    $this->db->where('email', $email)->update('users', array('authentication_code' => NULL));
                    updateSubadminPermission();
                    redirect("/admin/dashboard/?auth=verify");
                } else {
                    $this->session->set_flashdata('error', $this->ion_auth->errors());
                    redirect('admin');
                }
            }
        } else {
            redirect("/");
        }
    }

    function _isValidateAuthCode($str, $email) {
        $user = $this->db->select('id')->where(array('email' => $email, 'authentication_code' => $str))->get('users');
        if ($user->num_rows() >= 1) {
            return TRUE;
        } else {
            $this->form_validation->set_message('_isValidateAuthCode', 'You have enter invalid code.');
            return FALSE;
        }
    }

    public function forgot_password() {
        if ($this->ion_auth->is_admin()) {
            redirect('admin/dashboard');
        }
        $this->form_validation->set_rules('email', 'Email Address', 'required');
        if ($this->form_validation->run() == false) {
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email'
            );
            $this->viewData['validation_message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $this->viewData['title'] = "Admin Forgot Password";
            $this->layout->view("admin/auth/forgot_password", $this->viewData);
        } else {
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'));
            if ($forgotten) {
                $this->forgotPasswordEmail($forgotten);
                $this->session->set_flashdata('success', $this->ion_auth->messages());
                redirect("admin");
            } else {
                $this->session->set_flashdata('error', $this->ion_auth->errors());
                redirect("admin/auth/forgot_password", 'refresh');
            }
        }
    }

    private function forgotPasswordEmail($forgotten) {
        if (!empty($forgotten['identity']) && !empty($forgotten['forgotten_password_code'])) {
            $email = $forgotten['identity'];
            $code = $forgotten['forgotten_password_code'];
            $this->load->helper('email_helper');
            $replaceFrom = array('{name}', '{link}');
            $replaceTo = array($email, site_url("admin/auth/reset_password/$code"));
            sendMailByTemplate('admin-forgot-password', $replaceFrom, $replaceTo, $email);
        }
    }

    public function reset_password($code = "") {
        $reset = $this->ion_auth->forgotten_password_complete($code);
        if ($reset) {
            $this->resetPasswordEmail($reset);
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("admin", 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect("admin/auth/forgot_password", 'refresh');
        }
    }

    private function resetPasswordEmail($params) {
        if (!empty($params['identity']) && !empty($params['new_password'])) {
            $email = $params['identity'];
            $password = $params['new_password'];
            $this->load->helper('email_helper');
            $replaceFrom = array('{name}', '{password}');
            $replaceTo = array($email, $password);
            sendMailByTemplate('admin-reset-password', $replaceFrom, $replaceTo, $email);
        }
    }

    public function logout() {
        $logout = $this->ion_auth->logout();
        redirect('/', 'refresh');
    }

}
