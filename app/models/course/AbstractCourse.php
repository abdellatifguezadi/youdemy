<?php

abstract class AbstractCourse {
    protected $id;
    protected $title;
    protected $description;
    protected $photo_url;
    protected $teacher_id;
    protected $category_id;
    protected $created_at;
    protected $name;
    protected $category_name;
    protected $student_count;
    protected $tags;

    public function __construct(array $data) {
        $this->id = $data['id'];
        $this->title = $data['title'];
        $this->description = $data['description'];
        $this->photo_url = $data['photo_url'];
        $this->teacher_id = $data['teacher_id'];
        $this->category_id = $data['category_id'];
        $this->created_at = $data['created_at'];
        $this->name = $data['name'];
        $this->category_name = $data['category_name'];
        $this->student_count = $data['student_count'] ?? 0;
        $this->tags = $data['tags'] ?? [];
    }

    abstract public function getType();
    abstract public function getContent();
    abstract public function getIcon();
    abstract public function getIconColor();

    public function getId() { return $this->id; }
    public function getTitle() { return $this->title; }
    public function getDescription() { return $this->description; }
    public function getPhotoUrl() { return $this->photo_url; }
    public function getTeacherId() { return $this->teacher_id; }
    public function getCategoryId() { return $this->category_id; }
    public function getCreatedAt() { return $this->created_at; }
    public function getName() { return $this->name; }
    public function getCategoryName() { return $this->category_name; }
    public function getStudentCount() { return $this->student_count; }
    public function getTags() { return $this->tags; }
} 