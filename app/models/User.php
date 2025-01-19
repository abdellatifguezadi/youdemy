<?php

require_once '../app/config/db.php';

class User extends Db
{
    private $id;
    private $name;
    private $email;
    private $role;
    private $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    private function getRoleId($role)
    {
        $roleMap = [
            'admin' => 1,
            'teacher' => 2,
            'student' => 3
        ];
        return $roleMap[$role] ?? 3;
    }

    public function register($name, $email, $password, $role = 'student')
    {
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Email already exists'];
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $roleId = $this->getRoleId($role);

        $isActive = ($role === 'teacher') ? 0 : 1;

        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role_id, is_active) VALUES (?, ?, ?, ?, ?)");
        $success = $stmt->execute([$name, $email, $hashedPassword, $roleId, $isActive]);

        if ($success) {
            $message = ($role === 'teacher')
                ? 'Registration successful! Please wait for admin approval before logging in.'
                : 'Registration successful! Please login.';
            return ['success' => true, 'message' => $message];
        } else {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }

    public function login($email, $password)
    {
        $stmt = $this->conn->prepare("
            SELECT u.*, r.name as role_name 
            FROM users u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.email = ?
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            return ['success' => false, 'message' => 'Invalid credentials'];
        }

        if (!$user['is_active']) {
            return ['success' => false, 'message' => 'Your account is not active. Please wait for admin approval.'];
        }

        if ((int)$user['is_active'] === 2) {
            return ['success' => false, 'message' => 'Your account has been suspended. Please contact support.'];
        }

        if (password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'name' => $user['name'],
                'email' => $user['email'],
                'role_id' => $user['role_id'],
                'role_name' => $user['role_name']
            ];

            return ['success' => true, 'user' => $user];
        }

        return ['success' => false, 'message' => 'Invalid credentials'];
    }

    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("
            SELECT u.id, u.name, u.email, r.name as role 
            FROM users u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getTeacherpending()
    {
        $sql = "SELECT * FROM users WHERE role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllUsers()
    {
        $stmt = $this->conn->prepare("
            SELECT users.*, roles.name as role_name 
            FROM users 
            LEFT JOIN roles ON users.role_id = roles.id
            WHERE users.role_id != 1
        ");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTotalUsers()
    {
        $sql = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getActiveTeachers()
    {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 2 AND is_active = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getPendingTeachers()
    {
        $sql = "SELECT COUNT(*) as total FROM users WHERE role_id = 2 AND is_active = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    public function getTopTeachers()
    {
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

    public function getRecentActivities()
    {
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

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function activateTeacher($id)
    {
        $sql = "UPDATE users SET is_active = 1 WHERE id = ? AND role_id = 2";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function getMyEnrollments($studentId)
    {
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

    public function getEnrollmentStatus($studentId, $courseId)
    {
        $sql = "SELECT * FROM enrollments WHERE student_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$studentId, $courseId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function enrollInCourse($studentId, $courseId)
    {

        $enrollment = $this->getEnrollmentStatus($studentId, $courseId);
        if ($enrollment) {
            return false;
        }

        $sql = "INSERT INTO enrollments (student_id, course_id) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$studentId, $courseId]);
    }

    public function deleteEnrollment($studentId, $courseId)
    {
        try {
            $sql = "DELETE FROM enrollments WHERE student_id = ? AND course_id = ?";
            $stmt = $this->conn->prepare($sql);
            return $stmt->execute([$studentId, $courseId]);
        } catch (Exception $e) {
            return false;
        }
    }

    public function suspendUser($id)
    {
        $sql = "UPDATE users SET is_active = 2 WHERE id = ? AND role_id != 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function activateUser($id)
    {
        $sql = "UPDATE users SET is_active = 1 WHERE id = ? AND role_id != 1";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    public function rejectTeacher($id)
    {
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

    public function getTeacherTotalStudents($teacherId)
    {
        $sql = "SELECT COUNT(DISTINCT e.student_id) as total
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE c.teacher_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$teacherId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
    }
}
