<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Feedback_db extends CI_Model{
    
    public function __construct() {
        parent::__construct();
    
        $this->load->database();
    }
    
    public function add_feedback($data){
        $this->db->insert("feedback",$data);
    }
}