<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists("get_usercategories")) {

    function get_usercategories() {

        $CI = &get_instance();
        $CI->load->model("usercategory_db");
        return $CI->usercategory_db->get_usercategories();
    }

}