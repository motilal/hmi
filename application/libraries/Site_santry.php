<?php

/**
 * Description of Site_santry
 *
 * @author Motilal Soni
 */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site_santry {

    var $ci_obj = null;
    var $redirect = "/";

    //put your code here
    /**
     *
     * @param type $params 
     */
    public function __construct($params = array()) {
        $this->ci_obj = & get_instance(); 
    }

    /**
     * 
     * @param type $actions
     * @return boolean
     */
    public function allow($actions = array()) {

        if (!in_array($this->ci_obj->uri->rsegments[2], $actions) && $this->ci_obj->ion_auth->logged_in() == FALSE) {
            redirect($this->redirect . "?request=" . base64_encode(uri_string() . "?" . $_SERVER['QUERY_STRING']));
        }
        if (isset($this->ci_obj->uri->segments[1]) && $this->ci_obj->uri->segments[1] == "admin") {
            if ($this->ci_obj->ion_auth->is_admin() === FALSE && $this->ci_obj->ion_auth->is_subadmin() === FALSE && !in_array($this->ci_obj->uri->rsegments[2], $actions)) {
                redirect($this->redirect . "?request=" . base64_encode(uri_string() . "?" . $_SERVER['QUERY_STRING']));
            }
        }
        return TRUE;
    }

}

?>
