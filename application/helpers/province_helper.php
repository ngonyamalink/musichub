<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists("get_provinces")) {

    function get_provinces() {
        $CI = &get_instance();
        $CI->load->model("province_db");
       return $CI->province_db->get_provinces();
    }

}