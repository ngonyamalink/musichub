<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Recommendation_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_recommendation($data) {
        $this->db->insert("recommendation", $data);
    }

    public function count_music_recoms_by_music_id($id) {
        $sql = "select recommendation_id from recommendation where music_id=$id";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        return sizeof($data);
    }

    public function has_recommended($username, $music_id) {
        $sql = "select recommendation_id from recommendation where (username='$username' and music_id=$music_id)";
        $query = $this->db->query($sql);
        $data = $query->result_array();
        if (sizeof($data)>0){
            return TRUE;
        }else
        {
            return FALSE;
        }
    }

}
