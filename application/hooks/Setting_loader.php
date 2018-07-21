<?php

/**
 * Name: Setting Loader
 *  Load setting of site on controller callback
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_loader {

    function site_visitor() {
        $ci = & get_instance();
        if ($ci->uri->segment(1) != 'admin') {
            $ip = $ci->input->ip_address();
            $is_exist = $ci->db->select('id')->where(array('ip_address' => $ip, 'DATE(come_in)' => date('Y-m-d')))->get('visitors');
            if ($is_exist->num_rows() > 0) {
                $ci->db->where(array('id' => $is_exist->row()->id))->set('last_activity', date('Y-m-d H:i:s'))->update('visitors');
            } else {
                $insert_data = array('ip_address' => $ip, 'come_in' => date('Y-m-d H:i:s'));
                $ci->db->insert('visitors', $insert_data);
            }
        }
    }

}
