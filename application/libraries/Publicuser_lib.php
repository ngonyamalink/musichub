<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class publicuser_lib {

    public $publicuser_id;
    public $name;
    public $surname;
    public $username;
    public $password;
    public $usercategory_id;

    public function get_publicuser_by_username_password($u, $p) {
        $CI = &get_instance();
        $CI->load->model("publicuser_db");

        $data = $CI->publicuser_db->get_publicuser_by_username_password($u, $p);
        if ($data) {
            $this->usercategory_id = 4;
            $this->publicuser_id = $data['publicuser_id'];
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
