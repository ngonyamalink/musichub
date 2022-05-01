<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class sabcadmin_lib {
    public $sabcadmin_id;
    public $name;
    public $surname;
    public $username;
    public $password;
    public $usercategory_id;

    public function get_sabcadmin_by_username_password($u, $p) {
        $CI = &get_instance();
        $CI->load->model("artist_db");

        $data = $CI->artist_db->get_artist_by_username_password($u, $p);
        if ($data) {
            $this->usercategory_id = 2;
            $this->sabcadmin_id = $data['sabcadmin_id'];
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
