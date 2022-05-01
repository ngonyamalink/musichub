<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Open extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library(array("user_lib", "session","email"));
        $this->load->model(array("music_db","Stat_db"));
        $this->load->helper(array("musiccategory"));
        $this->user_session = $this->session->all_userdata();
    }

    public function index() {
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $data['music_list'] = $this->music_db->get_all_music();
        $data['error'] = ' ';
        $data['user_session'] = $this->user_session;
        $this->load->view("template/welcome_header", $data);
        $this->load->view("open/index", $data);
        $this->load->view("template/welcome_footer");
    }

    public function choose_category() {
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $this->load->view("layout/header_out", $data);
        $this->load->view("open/choose_category");
        $this->load->view("layout/footer_out");
    }

    public function get_music_by_category() {
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $cat_id = $this->input->post('musiccategory_id');
        $data['music_list'] = $this->music_db->get_all_music_by_category_id($cat_id);
        $this->load->view("layout/header_out", $data);
        $this->load->view("open/index", $data);
        $this->load->view("layout/footer_out");
    }
    
    
    public function privacypolicy()
    {
        $data['user_session'] = $this->user_session;
        $this->load->view('template/welcome_header', $data);
        $this->load->view('privacypolicy');
        $this->load->view('template/welcome_footer');
    }
    
    public function termsandconditions()
    {
        $data['user_session'] = $this->user_session;
        $this->load->view('template/welcome_header', $data);
        
        $this->load->view('termsandconditions');
        $this->load->view('template/welcome_footer');
    }
    
    
    public function tell_a_friend_form($processed = 0)
    {
        $data['user_session'] = $this->user_session;
        
        $this->load->view('template/welcome_header', $data);
        $this->load->view('tell_a_friend_form');
        $this->load->view('template/welcome_footer');
    }
    
    public function submit_tell_a_friend()
    {
        $data = $this->input->post();
        
        $this->email->from('highmedia-noreply@ngonyamalink.co.za', 'highmedia-noreply');
        $this->email->to($data['email']);
        // $this->email->cc('another@another-example.com');
        $this->email->bcc('ngonyamalink@gmail.com');
        
        $this->email->subject('High Media-Friend-Referral');
        $this->email->message('Hi ' . $data['email'] . ', Your friends are referring you to start using High Media for convenient media content. The link is ' . base_url() . ' , Warmest regards, Ngonyama Link Marketing.');
        
        $this->email->send();
        
        sleep(2);
        
        redirect(base_url("index.php/open/tell_a_friend_form/1"));
    }
    
    public function tell_a_friend_thankyou()
    {
        $data['user_session'] = $this->user_session;
        
        $this->load->view('template/welcome_header', $data);
        $this->load->view('tell_a_friend_thankyou');
        $this->load->view('template/welcome_footer');
    }
    
    
    public function feedback_form($processed = 0)
    {
        
        if($processed == 1){
            $this->session->set_flashdata('success', 'You have successfully submitted your feedback to Ngonyama Link. We appreciate your contribution.');
            
        }
        
        $data['user_session'] = $this->user_session;
        
        $this->load->view('template/welcome_header',$data);
        $this->load->view('feedback_form');
        $this->load->view('template/welcome_footer');
    }
    
    public function submit_feedback()
    {
        $data = $this->input->post();
        
        
        if (strlen($data['email'])==0){
            redirect(base_url('index.php/welcome/index/subscribed'));
        }else{
            
            sleep(2);
            $this->email->from($data['email'], 'Feedback');
            $this->email->to('info@ngonyamalink.co.za');
            $this->email->subject('Multi Media : Feedback ' . $data['subject']);
            $this->email->message($data['message'] . " # " . $data['phone'] . " # " . $data['fullnames'].' # '. $data['email']);
            
            $this->email->send();
            
            sleep(2);
            
            redirect(base_url("index.php/open/feedback_form/1"));
        }
    }
    
    
    public function multimedia_json($keyword = NULL){
        echo json_encode($this->music_db->get_all_music($keyword));
    }
    
    
    public function multimedia_stat_json(){
        echo json_encode($this->Stat_db->get_stat());
    } 
    
    
    public function  payment_form($music_id){
        $data['music'] = $this->music_db->get_music_by_musicid($music_id);
        $this->load->view('template/welcome_header');
        $this->load->view('open/payment_form',$data);
        $this->load->view('template/welcome_footer');
    }
    

}
