<?php

/**
 * Description of ACL for module permission
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Acl {

    var $ci_obj = null;
    var $redirect = "admin/dashboard";

    //put your code here
    /**
     *
     * @param type $params 
     */
    public function __construct($params = array()) {
        $this->ci_obj = & get_instance();
        $this->ci_obj->load->library('ion_auth');
    }

    /**
     * 
     * @param type $key
     * @return boolean
     */
    public function has_permission($key = '', $redirect = TRUE) {
        /* Allow all permission to admin user */
        if ($this->ci_obj->ion_auth->is_admin()) {
            return true;
        }
        /* Check permission for subadmin user */
        $this->ci_obj->load->model('user_model', 'user');
        $user_id = $this->ci_obj->ion_auth->get_user_id();
        $has_permission = $this->ci_obj->user->check_user_permissions($key, $user_id);
        if ($has_permission) {
            return true;
        } else {
            if ($redirect) {
                $this->ci_obj->session->set_flashdata("error", 'You dont have permission.');
                redirect($this->redirect);
            } else {
                return 'You dont have permission.';
            }
        }
    }

}

?>
