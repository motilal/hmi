<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Logs extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        is_allow_admin();
        $this->layout->set_layout("admin/layout/layout_admin");
    }

    function index() {
        $this->load->helper('directory');
        $map = directory_map(APPPATH . 'logs', 1);
        $logFiles = array();
        foreach ($map as $key => $val) {
            $ext = pathinfo($val, PATHINFO_EXTENSION);
            if ($ext == 'php') {
                $filePath = APPPATH . "logs/$val";
                $logFiles[$key]['filename'] = $val;
                $logFiles[$key]['created'] = date("Y-m-d H:i:s", filemtime($filePath));
                $logFiles[$key]['filesize'] = filesize($filePath);
            }
        } 
        $this->viewData['title'] = $this->viewData['pageHeading'] = "System Logs Files";
        $this->viewData['pageModule'] = "System Logs Manager";
        $this->viewData['logFiles'] = $logFiles;
        $this->viewData['datatable_asset'] = true;
        $this->viewData['breadcrumb'] = array('System Logs' => 'admin/logs');
        $this->layout->view("admin/log/index", $this->viewData);
    }

    function detail() {
        if ($this->input->get('file') == "") {
            return;
        }
        $fileName = base64_decode($this->input->get('file'));

        $file = APPPATH . 'logs/' . $fileName;
        $errorArray = array();
        if (file_exists($file)) {
            $log = file_get_contents($file, FILE_USE_INCLUDE_PATH, null);
            $lines = explode("\n", $log);
            $lines = array_slice(array_filter($lines), 1);
            if (!empty($lines)) {
                foreach ($lines as $row) {
                    $row = json_decode($row);
                    if (!empty($row)) {
                        $errorArray[] = array('level' => isset($row->lavel) ? $row->lavel : '', 'date' => isset($row->date) ? $row->date : '', 'message' => isset($row->message) ? $row->message : '');
                    }
                }
            }
        } else {
            $this->session->set_flashdata("error", __('FileNotExist'));
            redirect('admin/logs');
        }
        $this->viewData['filename'] = $fileName;
        $this->viewData['result'] = $errorArray;
        $this->viewData['title'] = $this->viewData['pageHeading'] = "System Error Logs";
        $this->viewData['pageModule'] = "System Logs Manager";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['breadcrumb'] = array('System Logs' => 'admin/logs', $fileName => '');
        $this->layout->view("admin/log/detail", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $fileName = $this->input->post('file');
            $fileName = base64_decode($this->input->post('id'));
            $file = APPPATH . 'logs/' . $fileName;
            if ($fileName != "" && file_exists($file)) {
                @unlink($file);
                $response['success'] = __('LogDeleteSuccess');
            } else {
                $response['error'] = __('InvalidRequest');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    public function test() {  
        //$this->load->get_var('UserInfo'); 
        $this->load->library('email');
        $mail_smtp = $this->config->item("mail_smtp"); 
        $this->email->initialize($mail_smtp);
        $this->email->clear(); 
        $this->email->from('motilalsonics@gmail.com', 'Kitabi Jhund');
        $this->email->to('motilalsoni@gmail.com');
        $this->email->subject('1111 hiii');
        $this->email->message('11 this is yest dhffi');
        $this->email->send();

        echo $this->email->print_debugger();
        die;
    }

}
