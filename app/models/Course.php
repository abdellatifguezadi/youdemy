<?php
require_once(__DIR__ . '/../config/db.php');
require_once(__DIR__ . '/course/VideoCourse.php');
require_once(__DIR__ . '/course/DocumentCourse.php');

class Course extends Db
{
    public function __construct()
    {
        parent::__construct();
    }

    public function createCourseObject($courseData)
    {
        if (!empty($courseData['video_url'])) {
            return new VideoCourse($courseData);
        } elseif (!empty($courseData['document'])) {
            return new DocumentCourse($courseData);
        }
        return new DocumentCourse($courseData);
    }

    public function getAllCourses($limit = 8, $offset = 0)
    {
        $query = "SELECT c.*, u.name, 
                  cat.name as category_name,
                  (SELECT COUNT(*) FROM enrollments WHERE course_id = c.id) as student_count
                  FROM courses c
                  LEFT JOIN users u ON c.teacher_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  ORDER BY c.created_at DESC
                  LIMIT " . (int)$limit . " OFFSET " . (int)$offset;
        
        $stmt = $this->conn->query($query);
        $courses = $stmt->fetchAll();

        return array_map(function($course) {
            $course['tags'] = $this->getCourseTags($course['id']);
            return $this->createCourseObject($course);
        }, $courses);
    }

    public function getCourseById($id)
    {
        $query = "SELECT c.*, u.name,
                  cat.name as category_name
                  FROM courses c
                  LEFT JOIN users u ON c.teacher_id = u.id
                  LEFT JOIN categories cat ON c.category_id = cat.id
                  WHERE c.id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$id]);
        $course = $stmt->fetch();

        if ($course) {
            $course['tags'] = $this->getCourseTags($course['id']);
            return $this->createCourseObject($course);
        }

        return null;
    }

    public function getCourseTags($courseId)
    {
        $query = "SELECT t.* FROM tags t
                  INNER JOIN course_tags ct ON t.id = ct.tag_id
                  WHERE ct.course_id = ?";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute([$courseId]);
        return $stmt->fetchAll();
    }

    public function getTotalCourses()
    {
        $query = "SELECT COUNT(*) as total FROM courses";
        return $this->conn->query($query)->fetch()['total'];
    }
} 