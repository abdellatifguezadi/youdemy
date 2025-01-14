<?php

require_once 'AbstractCourse.php';

class VideoCourse extends AbstractCourse {
    private $video_url;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->video_url = $data['video_url'];
    }

    public function getType(){
        return 'Cours vidéo';
    }

    public function getContent() {
        return $this->video_url;
    }

    public function getIcon(){
        return 'fa-video';
    }

    public function getIconColor(){
        return 'text-blue-500';
    }
} 