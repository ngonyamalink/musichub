<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Recommendation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(array("recommendation_db"));
        $this->load->library(array("user_agent","session"));
        $this->user_session = $this->session->all_userdata();
    }

    public function add_recom($music_id) {
        $data['music_id'] = $music_id;
        $data['username'] = $this->user_session['username'];
        $this->recommendation_db->add_recommendation($data);
        redirect($this->agent->referrer());
    }

}
