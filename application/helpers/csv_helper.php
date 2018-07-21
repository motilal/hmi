<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('array_to_csv')) {

    function array_to_csv($array, $download = "") {
        $csv = array();
        foreach ($array as $row) {
            $line1 = array();
            foreach ($row as $item) {
                $line1[] = $item;
            }
            $csv[] = $line1;
        }
        if ($download != "") {
            header('Content-Type: application/csv');
            header('Content-Disposition: attachement; filename="' . $download . '"');
        }
        ob_start();
        $f = fopen('php://output', 'w') or show_error("Can't open php://output");
        $n = 0;
        foreach ($csv as $line) {
            $n++;
            if (!fputcsv($f, $line)) {
                show_error("Can't write line $n: $line");
            }
        }
        fclose($f) or show_error("Can't close php://output");
        $str = ob_get_contents();
        ob_end_clean();
        if ($download == "") {
            return $str;
        } else {
            echo $str;
        }
    }

}

