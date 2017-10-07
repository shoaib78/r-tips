<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

function prx($array) {
    echo "<pre>";
    print_R($array);
    die;
}

function prt($array) {
    echo "<pre>";
    print_R($array);
}
    
function query($die = 1){
    $CI =& get_instance();
    echo $CI->db->last_query();
    if($die){
        die;
    }
}
