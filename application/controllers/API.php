<?php
/*
*	Author:	Alex Thomas
*	Assignment:	WE4.0 Server-side	Web	Development,	Digital	Skills	Academy
*	Student	ID:	D15126833
*	Date	:	2016/07/30
*/

/*
    This class handles all the API calls and returns JSON and has the following endpoints
    /api/video/                        => gets all videos
    /api/video/{id}                    => gets 1 video by id
    /api/topic/{year}/{month}/{day}    => gets topic by date & all categories for the topic and videos inside the category
*/
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {
    const ERROR_INVALID_INPUT = 'Invalid Inputs for API';

	public function video($id = null) {
        // Load the model
        $this->load->model('Video_model','video',TRUE);

        // api/video/ will return all videos , /api/video/{id} will return just one video
        if ($id == null){
            // Get all videos
            $videos = $this->video->getAllVideos();
            // Load success JSON view with all videos
            $this->loadSuccessJSON($videos);
        } else {
            // $id is set, check if it is a number else fail
            if (!is_numeric($id)){
                $this->loadErrorJSON(self::ERROR_INVALID_INPUT);
                return;
            }

            // Get the video by id inside try catch, will catch if it does no exist
            try {
                $video = $this->video->getVideoFromId($id);
                // Success JSON
                $this->loadSuccessJSON($video);
            } catch (Exception $e){
                // Fail JSON
                $this->loadErrorJSON($e->getMessage());
            }
        }
	}

    public function topic($year = null , $month = null , $day = null){
        // Endpoint looks like this /api/topic/{year}/{month}/{day}
        // Month & day are possible dates, not checking year as maybe somebody wants to see topic for year 2250 or an old topic or something gota think long term:D
        // Using !is_numeric will also check that the year,month & day are all set since they are set to null as default in function definition
        if ($month > 12 || $day > 31 || !is_numeric($year) || !is_numeric($month) || !is_numeric($day) ){
            // Invalid input, load error json and exit
            $this->loadErrorJSON(self::ERROR_INVALID_INPUT);
            return;
        }

        // Build the date string from input for mysql
        $date = $year.'-'.$month.'-'.$day;

        // Load topic model and get the topic for selected day
        $this->load->model('Topic_model','topic',TRUE);

        // getTopicByDate will throw an error if that date has no associated topic so use try catch
        try {
            $topic = $this->topic->getTopicByDate($date);
            // Success, load the JSON view with the topic
            $this->loadSuccessJSON($topic);
        } catch (Exception $e){
            // Error, get the message and load JSON view with it
            $this->loadErrorJSON($e->getMessage());
        }
    }

    // Function to return successful request into proper format to be used on client side
    private function loadSuccessJSON($object){
        $data['data'] = array(
            'status' => 'success',
            'data'  => $object
        );
        $this->load->view('json',$data);
    }

    // Function to return failed request into proper format to be used on client side,
    private function loadErrorJSON($errorMessage){
        $data['data'] = array(
            'status' => 'error',
            'error'  => $errorMessage
        );
        $this->load->view('json',$data);
    }
}
