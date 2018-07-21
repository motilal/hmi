<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sliders extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("slider_model" => 'slider'));
    }

    public function index() {
        $this->acl->has_permission('slider-index');
        $condition = array();
        $result = $this->slider->get_list($condition);
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Manage Slider";
        $this->viewData['pageModule'] = 'Slider Manager';
        $this->viewData['pageHeading'] = 'Sliders';
        $this->viewData['breadcrumb'] = array('Slider Manager' => '');
        $this->viewData['datatable_asset'] = true;
        $this->layout->view("admin/slider/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        $this->viewData['title'] = "Add Slider";
        if ($id > 0) {
            $this->acl->has_permission('slider-edit');
            $this->viewData['data'] = $data = $this->slider->getById($id);
            if (empty($data)) {
                $this->session->set_flashdata("error", __('LinkExpired'));
                redirect('admin/sliders');
            }
            $this->viewData['title'] = "Edit Slider";
        } else {
            $this->acl->has_permission('slider-add');
        }
        if ($this->form_validation->run() === TRUE) {
            $insertdata = array(
                "title" => $this->input->post('title'),
                "description" => $this->input->post('description', false),
                "image" => $this->input->post("image"),
                "link" => $this->input->post("link")
            );
            if (isset($data->image) && $data->image != "" && ($data->image != $insertdata['image'])) {
                @unlink(SLIDER_IMG_PATH . 'big/' . $data->image);
                @unlink(SLIDER_IMG_PATH . $data->image);
            }
            if ($this->input->post('id') > 0) {
                $insertdata['updated'] = date("Y-m-d H:i:s");
                $this->db->update("sliders", $insertdata, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", __('SliderUpdateSuccess'));
            } else {
                $insertdata['created'] = date("Y-m-d H:i:s");
                $this->db->insert("sliders", $insertdata);
                $this->session->set_flashdata("success", __('SliderAddSuccess'));
            }
            redirect("admin/sliders");
        }
        $this->viewData['croppic_asset'] = true;
        $this->viewData['pageModule'] = 'Add New Slider';
        $this->viewData['breadcrumb'] = array('Slider Manager' => 'admin/sliders', $this->viewData['title'] => '');
        $this->layout->view("admin/slider/manage", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            $has_permission = $this->acl->has_permission('slider-delete', FALSE);
            if ($has_permission === TRUE) {
                $detail = $this->slider->getById($id);
                if ($id > 0 && $this->db->where("id", $id)->delete("sliders")) {
                    if ($detail->image != "") {
                        @unlink(SLIDER_IMG_PATH . 'big/' . $detail->image);
                        @unlink(SLIDER_IMG_PATH . $detail->image);
                    }
                    $response['success'] = __('SliderDeleteSuccess');
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
            $has_permission = $this->acl->has_permission('slider-status', FALSE);
            if ($has_permission === TRUE) {
                $id = $this->input->post('id');
                $status = $this->input->post('status');
                if ($status == "1") {
                    $this->db->where("id", $id)->update("sliders", array("is_active" => 0));
                    $response['success'] = __('SliderInactiveSuccess');
                } else if ($status == "0") {
                    $this->db->where("id", $id)->update("sliders", array("is_active" => 1));
                    $response['success'] = __('SliderActiveSuccess');
                }
            } else {
                $response['error'] = $has_permission;
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function upload_image() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $slider_tmp_path = SLIDER_IMG_PATH . 'tmp/';
            if (!is_dir($slider_tmp_path)) {
                mkdir($slider_tmp_path, DIR_WRITE_MODE, TRUE);
            }
            clean_temp_dir($slider_tmp_path);
            $config['upload_path'] = $tempDir = $slider_tmp_path;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('img')) {
                $response = array(
                    "status" => 'error',
                    "message" => $this->upload->display_errors('', ''),
                );
            } else {
                $uploadData = $this->upload->data();
                $response = array(
                    "status" => 'success',
                    "url" => base_url($tempDir . $uploadData['file_name']),
                    "width" => $uploadData['image_width'],
                    "height" => $uploadData['image_height']
                );
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function crop_image() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            if (!is_dir(SLIDER_IMG_PATH)) {
                mkdir(SLIDER_IMG_PATH, DIR_WRITE_MODE, TRUE);
            }
            $imageName = basename($this->input->post('imgUrl'));
            $slider_tmp_path = SLIDER_IMG_PATH . 'tmp/';
            $slider_big_path = SLIDER_IMG_PATH . 'big/';
            if (!is_dir($slider_big_path)) {
                mkdir($slider_big_path, DIR_WRITE_MODE, true);
            }
            if (file_exists($slider_tmp_path . $imageName)) {
                @copy($slider_tmp_path . $imageName, $slider_big_path . $imageName);
            } else {
                $response = Array(
                    "status" => 'error',
                    "message" => 'Source file does not exist.'
                );
            }
            $this->load->library("image_lib");
            $this->image_lib->initialize(array(
                'image_library' => 'gd2',
                "width" => $this->input->post('imgW'),
                "height" => $this->input->post('imgH'),
                "source_image" => $slider_big_path . $imageName,
                "new_image" => SLIDER_IMG_PATH . $imageName
            ));
            if ($this->image_lib->resize()) {
                $this->image_lib->clear();
                $this->image_lib->initialize(array(
                    'image_library' => 'gd2',
                    "maintain_ratio" => false,
                    "width" => $this->input->post('cropW'),
                    "height" => $this->input->post('cropH'),
                    "x_axis" => $this->input->post('imgX1'),
                    'y_axis' => $this->input->post('imgY1'),
                    "source_image" => SLIDER_IMG_PATH . $imageName,
                    "new_image" => SLIDER_IMG_PATH . $imageName
                ));
                if ($this->image_lib->crop()) {
                    $response = array(
                        "status" => 'success',
                        "url" => base_url(SLIDER_IMG_PATH . $imageName . "?rand=" . uniqid()),
                        'imagename' => $imageName
                    );
                } else {
                    $response = Array(
                        "status" => 'error',
                        "message" => $this->image_lib->display_errors('', '')
                    );
                }
            } else {
                $response = Array(
                    "status" => 'error',
                    "message" => $this->image_lib->display_errors('', '')
                );
            }
            $this->output->set_content_type('application/json')->set_output(json_encode($response));
        }
    }

}
