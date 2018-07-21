<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Description of MY_Input
 *
 * @author      Motilal Soni
 * @since       Feb 23, 2018
 */
class MY_Log extends CI_Log {
    /* Override the log formate to json encoding */

    function _format_line($level, $date, $message) {
        $log = json_encode(array('lavel' => $level, 'date' => $date, 'message' => $message));
        return $log . "\n";
    }

} 