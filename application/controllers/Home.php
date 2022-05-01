<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Home extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library(array(
            'session',
            'user_lib'
        ));
        $this->load->model('music_db');
        $this->user_session = $this->session->all_userdata();
    }

    public function index()
    {
        $data['authstring'] = isset($this->user_session['authstring']) ? $this->user_session['authstring'] : "ngonyamalink_guest";
        $data['music_list'] = $this->music_db->get_music_by_userid($this->user_session['user_id']);
        $data['user_session'] = $this->user_session;
        $data['error'] = ' ';

        $this->load->view("template/welcome_header", $data);
        $this->load->view("home/index", $data);
        $this->load->view("template/welcome_footer");

        redirect(base_url("music/all_music"));
    }

    public function do_upload()
    {
        $config = array(
            'upload_path' => "./uploads/",
            'allowed_types' => "*",
            'overwrite' => TRUE,
            'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
            'max_height' => "768",
            'max_width' => "1024",
            'encrypt_name' => TRUE
        );
        $this->load->library('upload', $config);
        if ($this->upload->do_upload("userfile")) {
            $data = array(
                'upload_data' => $this->upload->data()
            );
            $attachment_url = base_url() . "uploads/" . $data['upload_data']['file_name'];

            $fdata = $this->input->post();
            $this->music_db->add_music(array(
                "music_link" => $attachment_url,
                "file_label" => $fdata['file_label'],
                "user_id" => $this->user_session['user_id']
            ));

            $this->load->view('artist/upload_success', $data);
        } else {
            $error = array(
                'error' => $this->upload->display_errors()
            );
            $this->load->view('artist/index', $error);
        }
    }

    public function upload_success()
    {
        $this->load->view('artist/upload_success');
    }
}
