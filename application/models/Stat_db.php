<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Stat_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function get_stat()
    {
        $sql = "select
(select count(music_id) from music) as nummusic,
(select count(user_id) from user) as numusers";

        $query = $this->db->query($sql);

        return ! empty($query) ? $query->row_array() : FALSE;
    }
}