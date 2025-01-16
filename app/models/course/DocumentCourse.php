<?php

require_once 'AbstractCourse.php';

class DocumentCourse extends AbstractCourse {
    private $document;

    public function __construct(array $data) {
        parent::__construct($data);
        $this->document = $data['document'];
    }

    public function getType() {
        return 'document';
    }

    public function getContent() {
        return $this->document;
    }

    public function getIcon(){
        return 'fa-file-alt';
    }

    public function getIconColor(){
        return 'text-green-500';
    }
} 