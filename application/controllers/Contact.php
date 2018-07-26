<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->layout->set_layout("front/layout/layout_default");
    }

    public function index() {
        $this->load->library('form_validation');
        if ($this->input->post()) {
            $response = array();
            if ($this->form_validation->run('contact') === TRUE) {
                $data = array(
                    "name" => $this->input->post('name'),
                    'email' => $this->input->post('email'),
                    'subject' => $this->input->post('subject'),
                    'message' => $this->input->post('message'),
                    'is_read' => 0,
                    'created' => date('Y-m-d H:i:s')
                );
                if ($this->db->insert('contact', $data)) {
                    $response['success'] = true;
                    $response['msg'] = 'Your enquiry has beed successfully submitted. We will contact you soon.';
                }
            } else {
                $response['validation_error'] = $this->form_validation->error_array();
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($response))->_display();
            exit();
        }
        $this->viewData['title'] = "Contact";
        $this->layout->view('front/contact/contact_index', $this->viewData);
    }

}
