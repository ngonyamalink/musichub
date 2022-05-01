<?php

class Profile extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            "user_lib",
            "session"
        ));
        $this->load->helper(array(
            "province"
        ));
        $this->user_session = $this->session->all_userdata();

        if (isset($this->user_session['user_id']) && $this->user_session['user_id'] > 0) {
            $this->user_lib->get_user_by_username_password($this->user_session['username'], $this->user_session['password']);
        } else {
            redirect("login");
        }
    }

    public function index($processed = 0)
    {
        if ($processed == 1) {
            $this->session->set_flashdata('success', 'Profile successfully updated.');
        }
        $data['user_id'] = $this->user_lib->user_id;
        $data['name'] = $this->user_lib->name;
        $data['surname'] = $this->user_lib->surname;
        $data['username'] = $this->user_lib->username;
        $data['province_id'] = $this->user_lib->province_id;

        $data['user_session'] = $this->user_session;
        $this->load->view("template/welcome_header", $data);
        $this->load->view("profile/index", $data);
        $this->load->view("template/welcome_footer");
    }

    public function update_profile()
    {
        $fdata = $this->input->post();
        unset($fdata['submit']);
        $this->user_db->update_user(array(
            "user_id" => $this->user_lib->user_id
        ), $fdata);

        $this->session->set_userdata(array(
            "name" => $fdata['name'],
            "surname" => $fdata['surname'],
            "username" => $fdata['username']
        ));
        redirect(base_url("profile/index/1"));
    }
}
