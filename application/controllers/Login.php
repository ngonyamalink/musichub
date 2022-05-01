<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library("user_lib");

        $this->load->library(array('session','email'));
        $this->load->model(array("user_db"));
        $this->user_session = $this->session->all_userdata();
    }

    public function index()  {
        
        $this->load->view("template/welcome_header");
        $this->load->view("login/index");
        $this->load->view("template/welcome_footer");
    }

    public function user_auth() {
        $this->user_session = $this->session->all_userdata();
        $fdata = $this->input->post();

        
        
        $fdata['password'] = do_hash($fdata['password'], 'md5');
        
        if ($this->user_lib->get_user_by_username_password($fdata['username'], $fdata['password'])) {
            $this->session->set_userdata(array("user_id" => $this->user_lib->user_id, "name" => $this->user_lib->name, "surname" => $this->user_lib->surname, "username" => $this->user_lib->username, "password" => $this->user_lib->password));
            $this->user_session = $this->session->all_userdata();
            redirect(base_url("index.php/home"));
        } else {
            Die("Incorrect Login");
        }
    }

  public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }
    
    
    
    public function submit_forgot_password()
    {
        $data = $this->input->post();
        
        $password_hash = do_hash(date('l jS \of F Y h:i:s A'), "md5");
        
        $this->user_db->update_user(array(
            "username" => $data['email']
        ), array(
            'resetpassword_hash' => $password_hash
        ));
        
        sleep(2);
        
        $this->email->from('hignmedia-noreply@ngonyamalink.co.za', 'hignmedia-noreply');
        $this->email->to($data['email']);
        $this->email->subject('High Media-Forgot-Password');
        $this->email->message('Click on the link to reset password - ' . base_url("index.php/login/new_password_form/$password_hash"));
        
        $this->email->send();
 
        
        redirect(base_url("login/forgot_password"));
    }
    
    public function new_password_form($resetpassword_hash)
    {
        $udata['udata'] = $this->user_session;
        $udata['resetpassword_hash'] = $resetpassword_hash;
        $this->load->view('template/welcome_header', $udata);
        $this->load->view('login/new_password_form', $udata);
        $this->load->view('template/welcome_footer');
    }
    
    public function submit_new_password()
    {
        $data = $this->input->post();
        
        $this->user_db->update_user(array(
            'resetpassword_hash' => $data['resetpassword_hash']
        ), array(
            "password" => do_hash($data['password'], "md5")
        ));
        
        redirect(base_url("login"));
    }
    
    
    
    public function forgot_password()
    {
        $this->load->view('template/welcome_header');
        
        $this->load->view('login/forgot_password');
        
        $this->load->view('template/welcome_footer');
    }

}
