<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

if (!function_exists('pagination')) {

    function pagination() {

        $data = array();

        $data['full_tag_open'] = '<ul class="pagination">';

        $data['full_tag_close'] = '</ul>';

        $data['first_tag_open'] = '<li>';

        $data['first_tag_close'] = '</li>';

        $data['num_tag_open'] = '<li>';

        $data['num_tag_close'] = '</li>';

        $data['last_tag_open'] = '<li>';

        $data['last_tag_close'] = '</li>';

        $data['next_tag_open'] = '<li>';

        $data['next_tag_close'] = '</li>';

        $data['prev_tag_open'] = '<li>';

        $data['prev_tag_close'] = '</li>';

        $data['cur_tag_open'] = '<li class="active"><a href="#">';

        $data['cur_tag_close'] = '</a></li>';
        $data['use_page_numbers'] = TRUE;
        return $data;
    }

}

if (!function_exists('msgAlert')) {

    function msgAlert() {

        $CI = & get_instance();
        ?>

        <?php if ($CI->session->flashdata('msg_success')):?>
            <div class="alert alert-success">
                <i class="fa fa-check"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $CI->session->flashdata('msg_success'); ?>
            </div>
        <?php endif; ?>

        <?php if ($CI->session->flashdata('msg_info')): ?>

            <div class="alert alert-info">
                <i class="fa fa-info"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            <?php echo $CI->session->flashdata('msg_info'); ?>
            </div>

        <?php endif; ?>

        <?php if ($CI->session->flashdata('msg_warning')): ?>

            <div class="alert alert-warning">
                <i class="fa fa-warning"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>

            <?php echo $CI->session->flashdata('msg_warning'); ?>

            </div>

        <?php endif; ?>


        <?php if ($CI->session->flashdata('msg_error')): ?>

            <div class="alert alert-danger">
                <i class="fa fa-ban"></i>
                <button type="button" class="close" data-dismiss="alert">&times;</button>

            <?php echo $CI->session->flashdata('msg_error'); ?>
            </div>

        <?php endif; ?>

        <?php
    }

}

if (!function_exists('showAccessDenied')) {

    function showAccessDenied() {
        $CI = & get_instance();
        $CI->template->write('title', 'Access Denied');
        $CI->template->write('meta_keywords', '');
        $CI->template->write('meta_desc', '');
        $CI->template->write_view('content', 'accessDenied', isset($data) ? $data : NULL);
        $CI->template->render();
    }

}
if (!function_exists('convertToHoursMins')) {

    function convertToHoursMins($time, $format = '%02d.%02d') {
        if ($time < 1) {
            return;
        }
        $hours = floor($time / 60);
        $minutes = ($time % 60);
        return sprintf($format, $hours, $minutes);
    }

}
if (!function_exists('ordinal')) {

    function ordinal($number) {
        $ends = array('th','st','nd','rd','th','th','th','th','th','th');
        if ((($number % 100) >= 11) && (($number%100) <= 13))
            return $number. 'th';
        else
            return $number. $ends[$number % 10];
    }

}
if (!function_exists('humanTime')) {

    function humanTime($timestamp, $num_times = 2) {
        $times = array(31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second');
        $now = time();
        $secs = $now - $timestamp;
        if ($secs == 0) {
            $secs = 1;
        }
        $count = 0;
        $time = '';
        foreach ($times AS $key => $value) {
            if ($secs >= $key) {
                $s = '';
                $time .= floor($secs / $key);
                if ((floor($secs / $key) != 1))
                    $s = 's';
                $time .= ' ' . $value . $s;
                $count++;
                $secs = $secs % $key;
                if ($count > $num_times - 1 || $secs == 0)
                    break;
                else
                    $time .= ', ';
            }
        }
        if ($time == '')
            return "seconds";
        return $time;
    }

}

function generate_random_password($length = 10, $charOnly = false) {
    $alphabets = range('A', 'Z');
    $numbers = range('0', '9');
    if ($charOnly) {
        $final_array = $alphabets;
    } else {
        $final_array = array_merge($alphabets, $numbers);
    }


    $password = '';

    while ($length--) {
        $key = array_rand($final_array);
        $password .= $final_array[$key];
    }

    return $password;
}

function random_username($string) {
    $pattern = " ";
    $firstPart = strstr(strtolower($string), $pattern, true);
    $secondPart = substr(strstr(strtolower($string), $pattern, false), 0, 3);
    $nrRand = rand(0, 100);

    $username = trim($firstPart) . trim($secondPart) . trim($nrRand);
    return $username;
}
function UniqueMachineID($salt = "") {
    if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
        $temp = sys_get_temp_dir().DIRECTORY_SEPARATOR."diskpartscript.txt";
        if(!file_exists($temp) && !is_file($temp)) file_put_contents($temp, "select disk 0\ndetail disk");
        $output = shell_exec("diskpart /s ".$temp);
        $lines = explode("\n",$output);
        $result = array_filter($lines,function($line) {
            return stripos($line,"ID:")!==false;
        });
        if(count($result)>0) {
            $result = array_shift(array_values($result));
            $result = explode(":",$result);
            $result = trim(end($result));       
        } else $result = $output;       
    } else {
        $result = shell_exec("blkid -o value -s UUID");  
        if(stripos($result,"blkid")!==false) {
            $result = $_SERVER['HTTP_HOST'];
        }
    }   
    return md5($salt.md5($result));
}

function randomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

if (!function_exists('get_currency')) {
    function get_currency($from_Currency, $to_Currency, $amount, $save_into_db = 0, $hour_difference = 1) {
        $CI = & get_instance();
        $CI->load->library('CurrencyConverter');
        $CI->CurrencyConverter = new CurrencyConverter();
        $result = $CI->CurrencyConverter->convert($from_Currency, $to_Currency, $amount, $save_into_db, $hour_difference);
        return $result;
    }
}
