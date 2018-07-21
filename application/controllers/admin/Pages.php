<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Pages extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("page_model" => 'page')); 
    }

    public function index() {
        $this->acl->has_permission('page-index');
        $condition = array();
        $result = $this->page->get_list($condition);
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Manage Page";
        $this->viewData['pageModule'] = 'Page Manager';
        $this->viewData['pageHeading'] = 'Static Pages';
        $this->viewData['breadcrumb'] = array('Page Manager' => '');
        $this->viewData['datatable_asset'] = true;
        $this->layout->view("admin/page/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        $this->viewData['title'] = "Add Static Page";
        if ($id > 0) {
            $this->acl->has_permission('page-edit');
            $this->viewData['data'] = $data = $this->page->getById($id);
            if (empty($data)) {
                $this->session->set_flashdata("error", __('LinkExpired'));
                redirect('admin/pages');
            }
            $this->viewData['title'] = "Edit Static Page";
        } else {
            $this->acl->has_permission('page-add');
        }

        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description', false),
                "meta_keywords" => $this->input->post("meta_keywords"),
                "meta_description" => $this->input->post("meta_description")
            );
            if ($id > 0) {
                $data['slug'] = create_unique_slug($this->input->post('title'), 'pages', 'slug', 'id', $id);
            } else {
                $data['slug'] = create_unique_slug($this->input->post('title'), 'pages', 'slug');
            }
            if ($this->input->post('id') > 0) {
                $data['updated'] = date("Y-m-d H:i:s");
                $this->db->update("pages", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", __('PageUpdateSuccess'));
            } else {
                $data['created'] = date("Y-m-d H:i:s");
                $this->db->insert("pages", $data);
                $this->session->set_flashdata("success", __('PageAddSuccess'));
            }
            redirect("admin/pages");
        }

        $this->viewData['ckeditor_asset'] = true;
        $this->viewData['pageModule'] = 'Add New Page';
        $this->viewData['breadcrumb'] = array('Page Manager' => 'admin/pages', $this->viewData['title'] => '');
        $this->layout->view("admin/page/manage", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('page-delete', FALSE);
            if ($has_permission === TRUE) {
                if ($id > 0 && $this->db->where("id", $id)->delete("pages")) {
                    $response['success'] = __('PageDeleteSuccess');
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
            $has_permission = $this->acl->has_permission('page-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("pages", array("status" => 0));
                    $response['success'] = __('PageInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("pages", array("status" => 1));
                    $response['success'] = __('PageActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

} 
