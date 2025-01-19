<?php
require_once 'User.php';

class Student extends User {
    public function __construct() {
        parent::__construct();
    }

    public function enrollInCourse($courseId, $studentId) {
        $enrollment = $this->getEnrollmentStatus($courseId, $studentId);
        if ($enrollment) {
            return false;
        }

        $sql = "INSERT INTO enrollments (course_id, student_id, status, enrollment_date) VALUES (?, ?, 'pending', NOW())";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$courseId, $studentId]);
    }

    public function deleteEnrollment($courseId, $studentId) {
        $sql = "DELETE FROM enrollments WHERE course_id = ? AND student_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$courseId, $studentId]);
    }

    public function getMyEnrollments($studentId) {
        $sql = "SELECT e.*, c.title, c.description, c.photo_url, u.name as teacher_name 
                FROM enrollments e 
                JOIN courses c ON e.course_id = c.id 
                JOIN users u ON c.teacher_id = u.id 
                WHERE e.student_id = ?
                ORDER BY e.enrollment_date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$studentId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getEnrollmentStatus($courseId, $studentId) {
        $sql = "SELECT status FROM enrollments WHERE course_id = ? AND student_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$courseId, $studentId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['status'] : null;
    }
} 