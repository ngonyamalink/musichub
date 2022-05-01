<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Feedback extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->helper(array("url", "form"));
        $this->load->model(array("feedback_db"));
        $this->load->library("session");
        $this->user_session = $this->session->all_userdata();
    }

    public function index() {
        $data['foldersback'] = '.';
        
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";

        if (isset($this->user_session['user_id']) && $this->user_session['user_id'] > 0) {
            $this->load->view("layout/header_in",$data);
            $this->load->view("feedback/index");
            $this->load->view("layout/footer_in");
        } else {
            $this->load->view("layout/header_out", $data);
            $this->load->view("feedback/index");
            $this->load->view("layout/footer_out");
        }
    }

    public function sendfeedback() {
        
        $fdata = $this->input->post();
        unset($fdata['submit']);
        $fdata['member_id'] = $this->user_session['user_id'];
        $this->feedback_db->add_feedback($fdata);

        redirect("feedback/thankyou");
    }

    public function thankyou() {
        $data['foldersback'] = '..';
        
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        if (isset($this->user_session['user_id']) && $this->user_session['user_id'] > 0) {
            $this->load->view("layout/header_in", $data);
            $this->load->view("feedback/thankyou");
            $this->load->view("layout/footer_in");
        } else {
            $this->load->view("layout/header_out", $data);
            $this->load->view("feedback/thankyou");
            $this->load->view("layout/footer_out");
        }
    }

}
