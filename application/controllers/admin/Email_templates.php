<?php

/**
 * Used for email templates 
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Email_templates extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->load->model(array('email_template_model' => 'email_template'));
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->viewData['pageModule'] = 'Email Templates Manager';
    }

    public function index() {
        $this->acl->has_permission('email_templates-index');
        $result = $this->email_template->get_list();
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Email Templates list";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['breadcrumb'] = array('Email Templates Manager' => '');
        $this->layout->view("admin/email_template/index", $this->viewData);
    }

    public function view($id = null) {
        $this->viewData['data'] = $data = $this->email_template->getById($id);
        if (empty($data)) {
            show_404();
        }
        $this->viewData['title'] = "Email Templates View";
        $this->viewData['pageModule'] = 'Email Templates View';
        $this->viewData['breadcrumb'] = array('Email Templates Manager' => 'admin/email_templates', 'View Detail' => '');
        $this->layout->view("admin/email_template/view", $this->viewData);
    }

    public function manage($id = null) {
        $this->viewData['title'] = "Add Email Template";
        if ($id > 0) {
            $this->acl->has_permission('email_templates-edit');
            $this->viewData['data'] = $data = $this->email_template->getById($id);
            if (empty($data)) {
                $this->session->set_flashdata("error", getLangText('LinkExpired'));
                redirect('admin/email_templates');
            }
            $this->viewData['title'] = "Edit Email Template";
        } else {
            $this->acl->has_permission('email_templates-add');
        }
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "title" => $this->input->post('title'),
                "subject" => $this->input->post('subject'),
                "variable" => $this->input->post('variable'),
                "body" => $this->input->post('body', FALSE)
            );
            if ($id > 0) {
                $data['slug'] = create_unique_slug($this->input->post('title'), 'email_templates', 'slug', 'id', $id);
            } else {
                $data['slug'] = create_unique_slug($this->input->post('title'), 'email_templates', 'slug');
            }
            if ($this->input->post('id') > 0) {
                $data['updated'] = date("Y-m-d H:i:s");
                $this->db->update("email_templates", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", __('EmailTemplateUpdateSuccess'));
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                $this->db->insert("email_templates", $data);
                $this->session->set_flashdata("success", __('EmailTemplateAddSuccess'));
            }
            redirect("admin/email_templates");
        }
        $this->viewData['ckeditor_asset'] = true;
        $this->layout->view("admin/email_template/manage", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('email_templates-delete', FALSE);
            if ($has_permission === TRUE) {
                if ($id > 0 && $this->db->where("id", $id)->delete("email_templates")) {
                    $response['success'] = __('EmailTemplateDeleteSuccess');
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
            $has_permission = $this->acl->has_permission('email_templates-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("email_templates", array("status" => 0));
                    $response['success'] = __('EmailTemplateInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("email_templates", array("status" => 1));
                    $response['success'] = __('EmailTemplateActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

} 
