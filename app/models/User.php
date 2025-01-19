<?php

require_once '../app/config/db.php';

class User extends Db
{
    protected $id;
    protected $name;
    protected $email;
    protected $role;
    protected $table = 'users';

    public function __construct()
    {
        parent::__construct();
    }

    protected function getRoleId($role)
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

    public function deleteUser($id)
    {
        $sql = "DELETE FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
