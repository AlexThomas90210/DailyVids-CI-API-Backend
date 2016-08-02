<?php
/*
*	Author:	Alex Thomas
*	Assignment:	WE4.0 Server-side	Web	Development,	Digital	Skills	Academy
*	Student	ID:	D15126833
*	Date	:	2016/07/30
*/

class Topic_model extends CI_Model {
    // Error Constants
    const ERROR_NO_TOPIC_FOR_DATE = "No topic for selected date";

    public function __construct(){
        parent::__construct();
    }

    public function getTopicByDate($date){
        // Get from topic table for selected day, im doing lots of joins instead
        // of loading a Video_model and loading the videos through that model because
        // it could potentially make loads of Database calls, trying to be as optimal as possible by doing one DB call
        $this->db->select( 'topics.id               as topic_id,
                            topics.name             as topic_name,
                            topics.date             as topic_date,
                            feature_video.id        as feature_video_id,
                            feature_video.name      as feature_video_name,
                            feature_video.youtubeID as feature_video_youtubeID,
                            categories.id           as category_id,
                            categories.name         as category_name,
                            videos.id               as video_id,
                            videos.name             as video_name,
                            videos.youtubeID        as video_youtubeID
                        ');

        $this->db->from('topics');
        $this->db->where('topics.date' , $date);

        // JOINS
        // Join video table to topics (One to One), this is for the feature video displayed on home screen, each topic has 1 feature video
        $this->db->join('videos AS feature_video','topics.feature_video_id = feature_video.id','left');
        // Join categories onto the topic (many categories to one topic)
        $this->db->join('categories',"categories.topic_id = topics.id");
        // Need to join the videos to categories (many to many), even though not represented in the data, potentially a video could be associated with multiple categories
        // so 2 joins required,category_videos is an intermediate table to join them up consisting of just category_id and video_id
        $this->db->join('category_videos',"categories.id = category_videos.category_id");
        // Add the video table to the intermediate table
        $this->db->join('videos','category_videos.video_id = videos.id');

        // Query the DB
        $query = $this->db->get();

        // If no rows throw error, will be caught by controller and give apropriate response
        if ( $query->num_rows() == 0 ){
            throw new Exception(self::ERROR_NO_TOPIC_FOR_DATE);
        }

        // Get results from query
        $result = $query->result();

        // Create the first level structure of the topic object, will populate the data during the foreach loop
        $topic = array(
            "id"            => null,
            "name"          => null,
            "date"          => null,
            "feature_video" => array(),
            "categories"    => array()
        );

        // Iterate over results set and populate the $topic object
        foreach ($result as $val){
            // Set topic metadata, only do this on first iteration ( $topic['id'] will be null )
            if ($topic['id'] == null) {
                $topic['id']            = $val->topic_id;
                $topic['name']          = $val->topic_name;
                $topic['date']          = $val->topic_date;
                $topic['feature_video'] = array(
                                            "id"        => $val->feature_video_id,
                                            "name"      => $val->feature_video_name,
                                            "youtubeID" => $val->feature_video_youtubeID
                                        );
            }

            // Check if category of the row for this category_id is already set, if not initialise the array,
            // Only do this on first time we see a new categorie_id ( $topic['categories'][$val->category_id] will not be set )
            if (!isset($topic['categories'][$val->category_id])){
                //New category , set the metadata about this category and initialise the 'videos' array which will hold the videos for this category
                $topic['categories'][$val->category_id] = array(
                                                            "id"     => $val->category_id,
                                                            "name"   => $val->category_name,
                                                            "videos" => array()
                                                        );
            }

            // Add the video of this row to its category,
            // the ' [] ' at the end appends to the ' videos ' array which was set in the previous if check
            $topic['categories'][$val->category_id]["videos"][] = array(
                'id'        => $val->video_id,
                'name'      => $val->video_name,
                'youtubeID' => $val->video_youtubeID
            );
        }

        /*
            We now have the correct structure for the topic object in a single foreach loop,
            However the $topic['categories'] array is an associative array with the key being the ID of the category,
            the ID is being stored inside that assosiative array so there is no need to keep the key as the ID,
            to make it easier to work with on the client side its better to have it be a straight array like 0,1,2,3,4
            instead of potentially long category ID's like 121 , 13223 , 1234123 etc
            So I just need to remove that and have $topic['categories'] be a normal array of associative arrays
        */
        $topic['categories'] = array_values($topic['categories']);

        return $topic;
    }
}

?>
