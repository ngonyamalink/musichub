<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists("get_musiccategories")) {

    function get_musiccategories() {
        $CI = &get_instance();
        $CI->load->model("musiccategory_db");
      return  $CI->musiccategory_db->get_musiccategories();
    }

}