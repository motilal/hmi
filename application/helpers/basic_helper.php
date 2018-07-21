<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('pr')) {

    function pr($data = null, $exit = false) {
        echo "<pre>";
        print_r($data);
        echo "</pre>";
        if ($exit === TRUE)
            die();
    }

}

if (!function_exists('load_more_pagination')) {

    /**
     *
     * @param type $url
     * @param type $total_rows
     * @param type $per_page
     * @param type $segment 
     */
    function load_more_pagination($url, $total_rows, $per_page, $segment, $nextLink = 'Load More') {
        $CI = & get_instance();
        $config['display_pages'] = $config['first_link'] = $config['last_link'] = $config['prev_link'] = $config['display_pages'] = FALSE;
        $config['next_link'] = $nextLink;
        $config['anchor_class'] = "class='view-more'";
        $config['base_url'] = site_url($url);
        $config['reuse_query_string'] = TRUE;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $segment;
        $CI->load->library("pagination");
        $CI->pagination->initialize($config);
        return $CI->pagination->create_links();
    }

}

if (!function_exists('create_pagination')) {

    /**
     *
     * @param type $url
     * @param type $total_rows
     * @param type $per_page
     * @param type $segment
     * @param type $query_string
     * @return type pagination
     */
    function create_pagination($url, $total_rows, $per_page, $segment, $query_gegments = array(), $config = array()) {
        $CI = & get_instance();
        if (empty($query_gegments)) {
            $query_gegments = $CI->input->get();
            if (isset($query_gegments['start'])) {
                unset($query_gegments['start']);
            }
        }
        $query_string = http_build_query($query_gegments);

        $config['base_url'] = site_url($url);
        $config['num_links'] = 2;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $per_page;
        $config['uri_segment'] = $segment;
        $config['suffix'] = $query_string ? "&" . $query_string : "";
        $config['page_query_string'] = TRUE;
        $config['query_string_segment'] = "start";
        $config['first_url'] = $query_string ? "?" . $query_string : "";
        /* design */
        $config['prev_link'] = 'Prev';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';

        $config['next_link'] = 'Next';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';

        $config['last_link'] = 'Last';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';

        $config['first_link'] = 'First';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';

        $config['full_tag_open'] = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:;">';
        $config['cur_tag_close'] = '</a></li>';
        $CI->load->library("pagination");
        $CI->pagination->initialize($config);
        return $CI->pagination->create_links();
    }

}

if (!function_exists('create_unique_slug')) {

    function create_unique_slug($string, $table = 'pages', $field = 'slug', $key = NULL, $value = NULL) {
        $CI = & get_instance();
        $slug = url_title(trim($string));
        $slug = strtolower($slug);
        if (empty($slug)) {
            $slug = uniqid();
        }
        $i = 0;
        $params = array();
        $params[$field] = $slug;
        if ($key)
            $params["$key !="] = $value;

        while ($CI->db->where($params)->get($table)->num_rows()) {
            if (!preg_match('/-{1}[0-9]+$/', $slug))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace('/[0-9]+$/', ++$i, $slug);

            $params [$field] = $slug;
        }
        return $slug;
    }

}

if (!function_exists('validate_is_unique')) {

    function validate_is_unique($table = "", $condition = []) {
        $CI = & get_instance();
        if ($table == "")
            return FALSE;
        $CI->db->select('id');
        if (!empty($condition) || $condition != "") {
            $CI->db->where($condition);
        }
        $data = $CI->db->get($table);
        if ($data->num_rows() > 0)
            return TRUE;
        else
            return FALSE;
    }

}

/**
 * 
 * @param type $string
 * @return string
 */
if (!function_exists("__")) {

    function __($key) {
        $CI = & get_instance();
        $content = $CI->lang->line($key);
        return $content === FALSE ? $key : $content;
    }

}

if (!function_exists('validateDate')) {

    function validateDate($date, $format = 'Y-m-d H:i:s') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

}

if (!function_exists('arrayGrouping')) {

    function arrayGrouping($array = array(), $field = "") {
        if (empty($array)) {
            return false;
        }
        $p_group = array();
        foreach ($array as $row) {
            if (!in_array($row->$field, $p_group))
                $p_group[] = $row->$field;
        }
        $p_group1 = array();
        foreach ($p_group as $grp) {
            foreach ($array as $row) {
                if ($row->$field == $grp) {
                    $p_group1[$grp][] = $row;
                }
            }
        }
        return $p_group1;
    }

}

/*
  Array
  (
  [0] => stdClass Object
  (
  [name] => Hindi
  )

  [1] => stdClass Object
  (
  [name] => Physics
  )

  )
  To

  Array
  (
  [0] => Hindi
  [1] => Physics
  )

 */
if (!function_exists('filterAssocArray')) {

    function filterAssocArray($array = array(), $field = "") {
        if (empty($array)) {
            return false;
        }
        $p_group = array();
        foreach ($array as $row) {
            $p_group[] = $row->$field;
        }
        return $p_group;
    }

}


if (!function_exists('is_allow_admin')) {

    function is_allow_admin($redirect = true) {
        $CI = & get_instance();
        if ($CI->ion_auth->is_admin()) {
            return true;
        } else {
            if ($redirect) {
                $CI->session->set_flashdata("error", 'You dont have permission.');
                redirect('admin/dashboard');
            }
            return false;
        }
    }

}


if (!function_exists('is_allow_action')) {

    function is_allow_action($key = "") {
        $CI = & get_instance();
        if ($CI->ion_auth->is_admin()) {
            return TRUE;
        }
        $useractions = $CI->session->userdata('_subadmin_allow_actions');
        if (!empty($useractions) && in_array($key, $useractions)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}


if (!function_exists('is_allow_module')) {

    function is_allow_module($group = "") {
        $CI = & get_instance();
        if ($CI->ion_auth->is_admin()) {
            return TRUE;
        }
        $usermodule = $CI->session->userdata('_subadmin_allow_module');
        if (!empty($usermodule) && in_array($group, $usermodule)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
if (!function_exists('gravatar_url')) {

    function gravatar_url($email = "", $size = 160) {
        $default = base_url('asset/admin/images/theme/no-user.jpg');
        if (ENV_HOST == 'localhost') {
            return $default;
        }
        $grav_url = "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
        return $grav_url;
    }

}

if (!function_exists('get_site_setting')) {

    function get_site_setting($field_name = "") {
        $value = get_site_setting_cache($field_name);
        if ($value == false) {
            $CI = & get_instance();
            $sql = $CI->db->select('value')->get_where('settings', array('field_name' => $field_name, 'is_active' => '1'));
            if ($sql->num_rows() > 0) {
                return $sql->row()->value;
            } else {
                return '';
            }
        } else {
            return $value;
        }
    }

}
if (!function_exists('get_site_setting_cache')) {

    function get_site_setting_cache($field_name = "") {
        $CI = & get_instance();
        $CI->load->driver('cache');
        if ($CI->cache->get('site_setting_data') == FALSE) {
            $sql = $CI->db->select('field_name,value')->get_where('settings', array('is_active' => '1'));
            $cacheData = array();
            if ($sql->num_rows() > 0) {
                foreach ($sql->result() as $row) {
                    $cacheData[$row->field_name] = $row->value;
                }
            }
            $CI->cache->file->save('site_setting_data', $cacheData, 60 * 60 * 24 * 1);
        }
        if ($site_setting_data = $CI->cache->get('site_setting_data')) {
            return isset($site_setting_data[$field_name]) ? $site_setting_data[$field_name] : FALSE;
        }
        return FALSE;
    }

}
if (!function_exists('human_filesize')) {

    function human_filesize($bytes, $decimals = 2) {
        $size = array('B', 'kB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }

}

if (!function_exists('updateSubadminPermission')) {

    function updateSubadminPermission() {
        $CI = & get_instance();
        if ($CI->ion_auth->is_subadmin() === TRUE) {
            $CI->load->model(array('user_model' => 'user'));
            $user_id = $CI->ion_auth->get_user_id();
            $upkeys = $CI->user->get_userpermission_keys(array('user_id' => $user_id));
            if ($upkeys) {
                $actions = array();
                $group = array();
                foreach ($upkeys as $ukey) {
                    $actions[] = $ukey->key;
                    $group[] = $ukey->group;
                }
                if (!empty($group)) {
                    $group = array_unique($group);
                    $group = array_map('strtolower', $group);
                }
                $CI->session->set_userdata('_subadmin_allow_actions', $actions);
                $CI->session->set_userdata('_subadmin_allow_module', $group);
            }
        }
    }

}

if (!function_exists('clean_temp_dir')) {

    /**
     * This function delete files older than specific times
     * @param type $dir
     * @param type $expire_time (In minutes)
     */
    function clean_temp_dir($dirpath, $expire_time = 60) {
        $CI = & get_instance();
        $CI->load->helper('directory');
        if (is_dir($dirpath)) {
            $map = directory_map($dirpath, 1);
            if (!empty($map)) {
                foreach ($map as $key => $val) {
                    $filePath = $dirpath . $val;
                    // Calculate file age in seconds
                    $FileAge = time() - filectime($filePath);
                    // Is the file older than the given time spam?
                    if ($FileAge > ($expire_time * 60)) {
                        @unlink($filePath);
                    }
                }
            }
        }
    }

}
