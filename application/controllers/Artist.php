<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Artist extends CI_Controller {

    public function __construct() {
        parent::__construct();

        parent::__construct();
        $this->load->library(array("user_lib", "session"));
        $this->load->model(array("music_db"));
        $this->user_session = $this->session->all_userdata();
        $this->load->helper(array("musiccategory"));

        if (isset($this->user_session['user_id']) && $this->user_session['user_id'] > 0) {
            $this->user_lib->get_user_by_username_password($this->user_session['username'], $this->user_session['password']);
        } else {
            redirect("login");
        }
    }

    public function index() {
        $data['foldersback'] = '.';
        
    $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $data['artists'] = $this->user_db->get_all_artists();
        $this->load->view("layout/header_in",$data);

        $this->load->view("artist/index", $data);

        $this->load->view("layout/footer_in",$data);
    }

    public function music_by_artist($artist_id) {
        $data['foldersback'] = '../../..';
        
            $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";

        $data['music_list'] = $this->music_db->get_music_by_artist_id($artist_id);
        $data['user_session'] = $this->user_session;
        $data['error'] = ' ';
        $this->load->view("layout/header_in",$data);
        $this->load->view("music/index", $data);
        $this->load->view("layout/footer_in",$data);
    }

}
