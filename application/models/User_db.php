<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class User_db extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_user($data) {
        $this->db->insert("user", $data);
    }
    
      public function get_user_by_authkey($authstring ) {
        $sql = "select * from user where (authstring='$authstring' and active=1)";
 
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function get_user_by_username_password($u, $p) {
        $sql = "select * from user where (username='$u' and password='$p')";

        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function update_user($where, $data) {
        
     
        $this->db->where($where)->update("user", $data);
    }

    public function email_already_used($email) {
        $sql = "select * from user where username='$email'";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function hash_and_username_exist($hash, $email) {
        $sql = "select * from user where (activation_code='$hash' and username='$email')";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function activate_user($email) {
        $this->db->where(array("username" => $email))->update("user", array("active" => 1));
    }

    public function get_all_artists() {
        $sql = "select * from user where usercategory_id=1";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->result_array() : false;
    }
}
