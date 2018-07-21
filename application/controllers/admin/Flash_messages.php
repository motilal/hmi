<?php

/*
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Flash_messages extends CI_Controller {

    var $viewData = array();

    public function __construct() {
        parent::__construct();
        $this->site_santry->redirect = "admin";
        $this->site_santry->allow(array());
        is_allow_admin();
        $this->layout->set_layout("admin/layout/layout_admin");
        $this->load->model(array("flash_message_model" => 'flash_message'));
    }

    public function index() {
        $condition = array();
        $result = $this->flash_message->get_list($condition);
        $this->viewData['result'] = $result;
        $this->viewData['title'] = "Manage Flash Message";
        $this->viewData['datatable_asset'] = true;
        $this->viewData['pageModule'] = 'Flash Message Manager';
        $this->viewData['pageHeading'] = 'Flash Messages List';
        $this->viewData['IsLangFileNeedWrite'] = $this->checkLangFileNeedWrite();
        $this->viewData['breadcrumb'] = array('Flash Message Manager' => '');
        $this->layout->view("admin/flash_message/index", $this->viewData);
    }

    public function manage($id = null) {
        $this->load->library('form_validation');
        $this->form_validation->set_rules('manage');
        if ($this->form_validation->run() === TRUE) {
            $data = array(
                "key" => $this->input->post('key'),
                "value" => $this->input->post('value'),
                "group" => $this->input->post("group"),
                "order" => (int) $this->input->post("order"),
                "updated" => date('Y-m-d H:i:s')
            );
            if ($this->input->post('id') > 0) {
                $this->db->update("flash_messages", $data, array("id" => $this->input->post('id')));
                $this->session->set_flashdata("success", 'Flash Message updated Successfully.');
            } else {
                $this->db->insert("flash_messages", $data);
                $this->session->set_flashdata("success", 'Flash Message added Successfully.');
            }
            redirect("admin/flash_messages");
        }
        $this->viewData['title'] = "Add Flash Message";
        if ($id > 0) {
            $this->viewData['data'] = $data = $this->flash_message->getById($id);
            if (empty($data)) {
                $this->session->set_flashdata("error", __('LinkExpired'));
                redirect('admin/flash_messages');
            }
            $this->viewData['title'] = "Edit Flash Message";
        }
        $this->viewData['pageModule'] = 'Add New Flash Message';
        $this->viewData['breadcrumb'] = array('Flash Message Manager' => 'admin/flash_messages', $this->viewData['title'] => '');
        $this->viewData['group_options'] = $this->flash_message->group_options();
        $this->layout->view("admin/flash_message/manage", $this->viewData);
    }

    public function delete() {
        $response = array();
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id');
            if ($id > 0 && $this->db->where("id", $id)->delete("flash_messages")) {
                $response['success'] = 'Flash Message deleted successfully.';
            } else {
                $response['error'] = __('InvalidRequest');
            }
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($response));
    }

    function _validate_flash_message_key($str) {
        $id = $this->input->post('id');
        $condition = array('key' => $str);
        if (!empty($id) && is_numeric($id)) {
            $condition['id !='] = $id;
        }
        $num_row = $this->db->where($condition)->count_all_results('flash_messages');
        if ($num_row >= 1) {
            $this->form_validation->set_message('_validate_flash_message_key', 'Flash Message key already exist.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    private function checkLangFileNeedWrite() {
        $sql = $this->db->select('updated')->order_by('updated', 'DESC')->limit(1)->get_where('flash_messages');
        if ($sql->num_rows() > 0) {
            $DbLastUpdated = $sql->row()->updated;
            $languageFilePath = APPPATH . 'language/english/general_lang.php';
            if (file_exists($languageFilePath)) {
                $langFileUpdated = date("Y-m-d H:i:s", filemtime($languageFilePath)); 
                if (strtotime($DbLastUpdated) > strtotime($langFileUpdated)) {
                    return true;
                }
            }
        }
        return false;
    }

    function updatelangfile() {
        $this->load->helper('file');
        $lang = array();
        $today = date('d-m-Y H:i:s');
        $user = $this->ion_auth->user()->row();
        $userName = $user->first_name . ' ' . $user->last_name;
        $query = $this->db->get_where('flash_messages');
        if ($query->num_rows() > 0) {
            $langstr = "<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
*
* Last Updated:  $today by $userName
*
* Description: language file for falsh messages
*
*/" . "\n\n\n";

            $resultArray = arrayGrouping($query->result(), 'group');

            foreach ($resultArray as $key => $groupArray) {
                $langstr .= "/* $key Group Messages */" . "\n";
                foreach ($groupArray as $row) {
                    $langstr.= "\$lang['" . $row->key . "'] = \"$row->value\";" . "\n";
                }
                $langstr .= "\n";
            }
            $languageFilePath = APPPATH . 'language/english/general_lang.php';
            if (!write_file($languageFilePath, $langstr)) {
                $this->session->set_flashdata("error", "Unable to write language file.Please check permission of file $languageFilePath");
            } else {
                $this->session->set_flashdata("success", "Language file successfully generated.");
            }
        }
        redirect('admin/flash_messages');
    }

    function insert_flash() {
        die;
        //$this->db->query('TRUNCATE flash_messages');
        $lang = array();
        $lang['SubCourse']['SubCourseUpdateSuccess'] = "Sub Course updted successfully.";
        $lang['SubCourse']['SubCourseAddSuccess'] = "Sub Course added successfully.";
        $lang['SubCourse']['SubCourseDeleteSuccess'] = "Sub Course deleted successfully.";
        $lang['SubCourse']['SubCourseActiveSuccess'] = "Sub Course Active Successfully.";
        $lang['SubCourse']['SubCourseInactiveSuccess'] = "Sub Course Inactive Successfully.";
        foreach ($lang as $k => $v) {
            $count = 0;
            foreach ($v as $k1 => $v1) {
                $count++;
                $data = array('key' => $k1, 'value' => $v1, 'group' => $k, 'order' => $count);
                $this->db->insert('flash_messages', $data);
                echo $this->db->insert_id() . '<br>';
            }
        }
    }

}
