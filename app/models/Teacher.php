<?php
require_once 'User.php';

class Teacher extends User {
    public function __construct() {
        parent::__construct();
    }

    public function createCourse($data) {
        try {
            $this->conn->beginTransaction();
            
            $sql = "INSERT INTO courses (title, description, photo_url, teacher_id, category_id, created_at";
            $params = [
                $data['title'],
                $data['description'],
                $data['photo_url'],
                $data['teacher_id'],
                $data['category_id'],
                date('Y-m-d H:i:s')
            ];

            if ($data['type'] === 'video') {
                $sql .= ", video_url) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $params[] = $data['video'];
            } else {
                $sql .= ", document) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $params[] = $data['document'];
            }

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            $courseId = $this->conn->lastInsertId();

            if (!empty($data['tags'])) {
                $tagSql = "INSERT INTO course_tags (course_id, tag_id) VALUES (?, ?)";
                $tagStmt = $this->conn->prepare($tagSql);
                
                foreach ($data['tags'] as $tagId) {
                    $tagStmt->execute([$courseId, $tagId]);
                }
            }

            $this->conn->commit();
            return $courseId;

        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function updateCourse($data) {
        try {
            $this->conn->beginTransaction();

            $sql = "UPDATE courses SET 
                    title = ?, 
                    description = ?, 
                    photo_url = ?, 
                    category_id = ?";

            $params = [
                $data['title'],
                $data['description'],
                $data['photo_url'],
                $data['category_id']
            ];

            if ($data['type'] === 'video') {
                $sql .= ", video_url = ?, document = NULL";
                $params[] = $data['video'];
            } else {
                $sql .= ", document = ?, video_url = NULL";
                $params[] = $data['document'];
            }

            $sql .= " WHERE id = ? AND teacher_id = ?";
            $params[] = $data['id'];
            $params[] = $data['teacher_id'];

            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);

            $stmt = $this->conn->prepare("DELETE FROM course_tags WHERE course_id = ?");
            $stmt->execute([$data['id']]);

            if (!empty($data['tags'])) {
                $tagSql = "INSERT INTO course_tags (course_id, tag_id) VALUES (?, ?)";
                $tagStmt = $this->conn->prepare($tagSql);
                
                foreach ($data['tags'] as $tagId) {
                    $tagStmt->execute([$data['id'], $tagId]);
                }
            }

            $this->conn->commit();
            return true;

        } catch (Exception $e) {
            $this->conn->rollBack();
            return false;
        }
    }

    public function getTeacherStudents($teacherId) {
        $sql = "SELECT c.id as course_id, c.title as course_title, 
                       u.id as student_id, u.name as student_name, u.email as student_email,
                       e.enrollment_date, e.status
                FROM courses c
                JOIN enrollments e ON c.id = e.course_id
                JOIN users u ON e.student_id = u.id
                WHERE c.teacher_id = ?
                ORDER BY c.title, e.enrollment_date DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTeacherTotalStudents($teacherId) {
        $sql = "SELECT COUNT(DISTINCT e.student_id) as total
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE c.teacher_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$teacherId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }

    public function updateEnrollmentStatus($studentId, $courseId, $status, $teacherId) {
        $sql = "SELECT id FROM courses WHERE id = ? AND teacher_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$courseId, $teacherId]);
        
        if (!$stmt->fetch()) {
            return false;
        }

        $sql = "UPDATE enrollments SET status = ? WHERE student_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $studentId, $courseId]);
    }

    public function deleteStudentFromCourse($studentId, $courseId, $teacherId) {
        $sql = "SELECT id FROM courses WHERE id = ? AND teacher_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$courseId, $teacherId]);
        
        if (!$stmt->fetch()) {
            return false;
        }

        $sql = "DELETE FROM enrollments WHERE student_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$studentId, $courseId]);
    }
} 