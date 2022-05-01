<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Recordstudio_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_recordstudio($data) {
        $this->db->insert("recordstudio", $data);
    }

    public function get_recordstudio_by_username_password($u, $p) {
        $sql = "select * from recordstudio where (username='$u' and password='$p' and active=1)";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function update_publicuser($recordstudio_id, $data) {
        $this->db->where(array("recordstudio_id" => $recordstudio_id, $data));
    }

    public function email_already_used($email) {
        $sql = "select * from recordstudio where username='$email'";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function hash_and_username_exist($hash, $email) {
        $sql = "select * from recordstudio where (hash='$hash' and username='$email')";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function activate_recordstudio($email) {
        $this->db->where(array("username" => $email))->update("recordstudio", array("active" => 1));
    }

}
