<?php
require_once 'User.php';

class Admin extends User {
    public function __construct() {
        parent::__construct();
    }

    public function getTotalUsers() {
        $sql = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getActiveTeachers() {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 2 AND is_active = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getPendingTeachers() {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function activateTeacher($id) {
        $sql = "UPDATE users SET is_active = 1 WHERE id = ? AND role_id = 2";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function rejectTeacher($id) {
        $sql = "SELECT id FROM users WHERE id = ? AND role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        if (!$stmt->fetch()) {
            return false;
        }

        $sql = "DELETE FROM users WHERE id = ? AND role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function suspendUser($id) {
        $sql = "UPDATE users SET is_active = 2 WHERE id = ? AND role_id != 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function activateUser($id) {
        $sql = "UPDATE users SET is_active = 1 WHERE id = ? AND role_id != 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getTopTeachers() {
        $sql = "SELECT u.id, u.name,
                COUNT(DISTINCT c.id) as course_count,
                COUNT(DISTINCT e.student_id) as student_count
                FROM users u
                LEFT JOIN courses c ON u.id = c.teacher_id
                LEFT JOIN enrollments e ON c.id = e.course_id
                WHERE u.role_id = 2 AND u.is_active = 1
                GROUP BY u.id, u.name
                ORDER BY student_count DESC
                LIMIT 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getRecentActivities() {
        $sql = "SELECT 'new_teacher' as type, u.name, u.created_at
                FROM users u 
                WHERE u.role_id = 2
                UNION ALL
                SELECT 'new_course' as type, c.title as name, c.created_at
                FROM courses c
                ORDER BY created_at DESC
                LIMIT 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPendingTeachersCount() {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getTeacherpending() {
        $sql = "SELECT * FROM users WHERE role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers() {
        $stmt = $this->conn->prepare("
            SELECT users.*, roles.name as role_name 
            FROM users 
            LEFT JOIN roles ON users.role_id = roles.id
            WHERE users.role_id != 1
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
} 