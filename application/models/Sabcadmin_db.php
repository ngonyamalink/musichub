<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sabcadmin_db extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_sabcadmin($data) {
        $this->db->insert("sabcadmin", $data);
    }

    public function get_sabcadmin_by_username_password($u, $p) {
        $sql = "select * from sabcadmin where (username='$u' and password='$p')";
        $query = $this->db->query($sql);
        return !empty($query) ? $query->row_array() : false;
    }

    public function update_sabcadmin($sabcadmin_id, $data) {
        $this->db->where(array("sabcadmin_id" => $sabcadmin_id, $data));
    }
}