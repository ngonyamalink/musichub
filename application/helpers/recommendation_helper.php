<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if (!function_exists("count_music_recoms_by_music_id")) {

    function count_music_recoms_by_music_id($id) {
        $CI = &get_instance();
        $CI->load->model("recommendation_db");
        return $CI->recommendation_db->count_music_recoms_by_music_id($id);
    }

}

if (!function_exists("has_recommended")) {

    function has_recommended($username, $music_id) {

        $CI = &get_instance();
        $CI->load->model("recommendation_db");
        return $CI->recommendation_db->has_recommended($username, $music_id);
    }

}