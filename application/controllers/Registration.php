<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Registration extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array(
            "province",
            "usercategory"
        ));
        $this->load->model(array(
            "user_db"
        ));
        
        $this->load->library(array("session"));
    }

    public function index($processed = 0)
    {
        if($processed == 1){
            $this->session->set_flashdata('success', 'You have sucessfully registered. Enjoy the unlimitted streaming and uploads of media contents.');
            
        }
        
        $this->load->view("template/welcome_header");
        $this->load->view("registration/index");
        $this->load->view("template/welcome_footer");
    }

    public function add_user()
    {
        $fdata = $this->input->post();
        if ($fdata['password'] == $fdata['password_confirmation']) {
            unset($fdata['password_confirmation']);
        } else {
            die("Your passwords did not match.");
        }

        if ($this->email_already_used($fdata['username']) == false && $this->is_valid_email($fdata['username'])) {

            $plaintext_password = $fdata['password'];
            $fdata['password'] = do_hash($fdata['password'], 'md5');
            $fdata['hash'] = do_hash(rand(1, date("Y")), 'md5');
            unset($fdata['submit']);

            $fdata['date_created'] = date("Y-m-d H:i:s");
            
            $fdata['active'] = 1;
            
            $this->user_db->add_user($fdata);
            $this->send_confirmation($fdata['name'], $fdata['username'], $fdata['hash'], $plaintext_password);
            redirect(base_url("index.php/registration/index/1"));
        } else {
            die("Email is already used.");
        }
    }

    public function email_already_used($email)
    {
        if ($this->user_db->email_already_used($email) == true) {
            return true;
        }

        return false;
    }

    public function is_valid_email($email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            return true;
        } else {

            echo ("$email is not a valid email address");
            die();
        }
    }

    function send_confirmation($name, $username, $hash, $password)
    {
        $this->load->library('email'); // load email library
        $this->email->set_mailtype("html");
        $this->email->from('highmedia-noreply@ngonyamalink.co.za', 'High Media'); // sender's email
        $address = $username; // receiver's email
        $subject = "Welcome to High Media"; // subject
        $link = base_url() . 'index.php/registration/verify?' . 'username=' . $username . '&hash=' . $hash;
        $message = /* -----------email body starts----------- */
                'Thanks for signing up, ' . $name . '!<br><br>
      
        Here are your login details.<br>
        -------------------------------------------------<br>
        Username: ' . $username . '<br>
        Password: ' . $password . '<br>
        -------------------------------------------------<br>
        <a href="' . $link . '"></a><br>';
        /* -----------email body ends----------- */
        $this->email->to($address);
        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->send();
    }

    public function verify()
    {
        if (isset($_GET['username']) && isset($_GET['hash'])) {
            if ($this->user_db->hash_and_username_exist($_GET['hash'], $_GET['username'])) {
                // activate artist
                $this->user_db->activate_user($_GET['username']);

                die("Your profile is now active. You can log in.");
            } else {

                die("Invalid parameters");
            }
        } else {
            die("Please try again");
        }
    }

    public function registered()
    {
        $this->load->view("layout/header_out");
        $this->load->view("registration/registered");
        $this->load->view("layout/footer_out");
    }
}
