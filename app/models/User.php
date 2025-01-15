<?php

require_once '../app/config/db.php';

class User extends Db {
    private $id;
    private $name;
    private $email;
    private $role;

    public function __construct() {
        parent::__construct();
    }

    private function getRoleId($role) {
        $roleMap = [
            'admin' => 1,
            'teacher' => 2,
            'student' => 3
        ];
        return $roleMap[$role] ?? 3; // Par défaut, retourne le rôle student
    }

    public function register($name, $email, $password, $role = 'student') {
        // Vérifier si l'email existe déjà
        $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            return ['success' => false, 'message' => 'Email already exists'];
        }

        // Hash du mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Obtenir l'ID du rôle
        $roleId = $this->getRoleId($role);

        // Insérer le nouvel utilisateur
        $stmt = $this->conn->prepare("INSERT INTO users (name, email, password, role_id) VALUES (?, ?, ?, ?)");
        $success = $stmt->execute([$name, $email, $hashedPassword, $roleId]);

        if ($success) {
            return ['success' => true, 'message' => 'Registration successful'];
        } else {
            return ['success' => false, 'message' => 'Registration failed'];
        }
    }

    public function login($email, $password) {
        $stmt = $this->conn->prepare("
            SELECT u.*, r.name as role_name 
            FROM users u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.email = ?
        ");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role'] = $user['role_name'];
            
            return ['success' => true, 'user' => $user];
        }

        return ['success' => false, 'message' => 'Invalid credentials'];
    }

    public function getUserById($id) {
        $stmt = $this->conn->prepare("
            SELECT u.id, u.name, u.email, r.name as role 
            FROM users u 
            JOIN roles r ON u.role_id = r.id 
            WHERE u.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
} 