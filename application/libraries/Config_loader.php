<?php

defined('BASEPATH') OR exit('No direct script access allowed.');

/**
 * Name:    Config loader
 * Author:  Motilal Soni
 *           motilalsoni@gmail.com 
 * 
 *
 * Created:  03.03.2018
 *
 * Description: This library pass data to all views and controllers  and can be used to load config
 * 
 */
class Config_loader {

    protected $CI;
    var $viewData = array();

    public function __construct() {
        $this->CI = & get_instance();
        if ($this->CI->ion_auth->logged_in()) {
            $this->viewData['_UserAuth'] = $userAuth = $this->CI->ion_auth->user()->row();
            if (empty($userAuth) || $userAuth->active == 0) {
                $this->CI->ion_auth->logout();
                redirect('/', 'refresh');
        }
            /* Update subadmin permission if live change on their permission */
            if (isset($userAuth->update_setting_flag) && $userAuth->update_setting_flag == 1 && $this->CI->ion_auth->is_subadmin() === TRUE) {
                updateSubadminPermission();
                $user_id = $this->CI->ion_auth->get_user_id();
                $this->CI->db->where('id', $user_id)->set('update_setting_flag', 0)->update('users'); 
            }
        }
        $this->CI->load->vars($this->viewData);
    }

}
