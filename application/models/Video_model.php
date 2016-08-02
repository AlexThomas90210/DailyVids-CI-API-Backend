<?php

/*
*	Author:	Alex Thomas
*	Assignment:	WE4.0 Server-side	Web	Development,	Digital	Skills	Academy
*	Student	ID:	D15126833
*	Date	:	2016/07/30
*/

class Video_model extends CI_Model {
    // Error Constants
    const ERROR_NO_VIDEO_ID = "No videos for selected id";

    public function __construct(){
        parent::__construct();
    }

    public function getAllVideos(){
        //get all data from the videos table and return it
        $query = $this->db->get('videos');
        return $query->result_array();
    }

    public function getVideoFromId($id){
        $query = $this->db->get_where('videos', array('id' => $id));

        // If 0 results throw an error which the controller will catch
        if ($query->num_rows() == 0) {
            throw new Exception(self::ERROR_NO_VIDEO_ID);
        } else {
            return $query->row(0);
        }
    }
}

?>
