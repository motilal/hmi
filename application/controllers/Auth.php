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
            $register = $this->ion_auth->register($username, $password, $email, $additional_data, $group);
            /* [identity] => motis@gmail.com
              [id] => 19
              [email] => motis@gmail.com
              [activation] => 86308d1789a6257527669140efba0698193c2458 */
            if (isset($register['id']) && $register['activation']) {
                $this->emailtouser($register, $additional_data);
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

    function emailtouser($register, $additional_data) {
        if (!empty($register)) {
            $code = $register['activation'];
            $email = $register['email'];
            $this->load->helper('email_helper');
            $replaceFrom = array('{user}', '{link}');
            $replaceTo = array($additional_data['first_name'], site_url("auth/activate/{$register['id']}/$code"));
            sendMailByTemplate('user-registeration', $replaceFrom, $replaceTo, $email);
        }
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
        if ($str != "") {
            $user = $this->db->select('users.id')->join('users_groups', 'users_groups.user_id=users.id', 'INNER')->where(array('email' => $str, 'group_id' => 2))->get('users');
            if ($user->num_rows() >= 1) {
                return TRUE;
            } else {
                $this->form_validation->set_message('_validate_username', 'This email is not recognize.');
                return FALSE;
            }
        }
    }

    /**
     * Activate the user
     *
     * @param int         $id   The user ID
     * @param string|bool $code The activation code
     */
    public function activate($id, $code = FALSE) {
        if ($code !== FALSE) {
            $activation = $this->ion_auth->activate($id, $code);
        } else if ($this->ion_auth->is_admin()) {
            $activation = $this->ion_auth->activate($id);
        }
        if ($activation) {
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("/", 'refresh');
        } else {
            // redirect them to the forgot password page
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect("/", 'refresh');
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
        if ($this->ion_auth->is_general_user()) {
            return;
        }
        $response = [];
        $this->form_validation->set_rules('email', 'Email Address', 'required|callback__validate_username');
        if ($this->form_validation->run() == false) {
            $this->data['email'] = array(
                'name' => 'email',
                'id' => 'email'
            );
            $response['validation_error'] = $this->form_validation->error_array();
        } else {
            $forgotten = $this->ion_auth->forgotten_password($this->input->post('email'), $group = 2);
            /*
              ([identity] => motisqss@gmail.com
              [forgotten_password_code] => 5GpNlklrYTDoi9PRz4DDIe6c5ff7ed27b7c53960 )
             */
            if (!empty($forgotten['forgotten_password_code'])) {
                $this->forgotPasswordEmail($forgotten);
                $response['success'] = true;
                $response['msg'] = $this->ion_auth->messages();
            } else {
                $response['error'] = $this->ion_auth->errors();
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
        exit();
    }

    private function forgotPasswordEmail($forgotten) {
        if (!empty($forgotten['identity']) && !empty($forgotten['forgotten_password_code'])) {
            $email = $forgotten['identity'];
            $code = $forgotten['forgotten_password_code'];
            $this->load->helper('email_helper');
            $replaceFrom = array('{name}', '{link}');
            $replaceTo = array($email, site_url("auth/reset_password/$code"));
            sendMailByTemplate('user-forgot-password', $replaceFrom, $replaceTo, $email);
        }
    }

    public function reset_password($code = "") {
        $reset = $this->ion_auth->forgotten_password_complete($code);
        if ($reset) {
            $this->resetPasswordEmail($reset);
            $this->session->set_flashdata('success', $this->ion_auth->messages());
            redirect("/", 'refresh');
        } else {
            $this->session->set_flashdata('error', $this->ion_auth->errors());
            redirect("/", 'refresh');
        }
    }

    private function resetPasswordEmail($params) {
        if (!empty($params['identity']) && !empty($params['new_password'])) {
            $email = $params['identity'];
            $password = $params['new_password'];
            $this->load->helper('email_helper');
            $replaceFrom = array('{name}', '{password}');
            $replaceTo = array($email, $password);
            sendMailByTemplate('user-password-reset', $replaceFrom, $replaceTo, $email);
        }
    }

    public function logout() {
        $logout = $this->ion_auth->logout();
        redirect('/', 'refresh');
    }

}
