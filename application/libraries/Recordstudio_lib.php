<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class recordstudio_lib {

    public $recordstudio_id;
    public $name;
    public $surname;
    public $username;
    public $password;
    public $usercategory_id;

    public function get_recordstudio_by_username_password($u, $p) {
        $CI = &get_instance();
        $CI->load->model("recordstudio_db");

        $data = $CI->recordstudio_db->get_recordstudio_by_username_password($u, $p);
        if ($data) {
            $this->usercategory_id = 3;
            $this->recordstudio_id = $data['recordstudio_id'];
            $this->name = $data['name'];
            $this->surname = $data['surname'];
            $this->username = $data['username'];
            $this->password = $data['password'];
            return true;
        } else {
            return false;
        }
    }

}
