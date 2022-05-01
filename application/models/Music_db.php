<?php

class Music_db extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function add_music($data)
    {
        $this->db->insert("music", $data);
    }

    public function get_music_by_musicid($music_id)
    {
        $sql = "select * from music where (music_id=$music_id)";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->row_array() : false;
    }

    public function get_music_by_userid($user_id)
    {
        $sql = "select musiccategory.musiccategory_name,music.price,music.music_id,music.file_label,music.music_link,music.user_id,music.date_added from music  left join musiccategory on (musiccategory.musiccategory_id=music.musiccategory_id) where (music.user_id=$user_id)";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }

    public function get_all_music($keyword = NULL)
    {
        if ($keyword == NULL) {
            $sql = "select music.price,musiccategory.musiccategory_name,music.music_id,music.file_label,music.music_link,music.user_id,music.date_added from music left join musiccategory on (musiccategory.musiccategory_id=music.musiccategory_id)";
        } else {
            $sql = "select musiccategory.musiccategory_name,music.music_id,music.file_label,music.music_link,music.user_id,music.date_added from music left join musiccategory on (musiccategory.musiccategory_id=music.musiccategory_id) where music.file_label like '%" . $keyword . "%'";
        }

        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }

    public function update_music($music_id, $data)
    {
        $this->db->where(array(
            "music_id" => $music_id,
            $data
        ));
    }

    public function get_all_music_by_category_id($cat_id)
    {
        $sql = "select musiccategory.musiccategory_name,music.price,music.music_id,music.file_label,music.music_link,music.user_id,music.date_added from music  left join musiccategory on (musiccategory.musiccategory_id=music.musiccategory_id) where music.musiccategory_id=$cat_id";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }

    public function get_music_by_artist_id($artist_id)
    {
        $sql = "select musiccategory.musiccategory_name,music.music_id,music.file_label,music.music_link,music.user_id,music.date_added from music  left join musiccategory on (musiccategory.musiccategory_id=music.musiccategory_id) where music.user_id=$artist_id";
        $query = $this->db->query($sql);
        return ! empty($query) ? $query->result_array() : false;
    }
}
