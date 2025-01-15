<?php

require_once '../app/models/User.php';

class AuthController extends BaseController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    public function showLoginForm() {
        $this->render('auth/login');
    }

    public function showRegisterForm() {
        $role = isset($_GET['role']) ? $_GET['role'] : '';
        $this->render('auth/register', ['role' => $role]);
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            if (empty($email) || empty($password)) {
                $_SESSION['error'] = 'Please fill in all fields';
                header('Location: /login');
                exit;
            }

            
            $result = $this->userModel->login($email, $password);

            if ($result['success']) {
                $redirectUrl = $this->getRedirectUrl($result['user']['role_name']);
                header('Location: ' . $redirectUrl);
                exit;
            } else {
                $_SESSION['error'] = $result['message'];
                header('Location: /login');
                exit;
            }
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student';

            // Validation
            if (empty($name) || empty($email) || empty($password)) {
                $_SESSION['error'] = 'Please fill in all fields';
                header('Location: /register');
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Please enter a valid email address';
                header('Location: /register');
                exit;
            }

            if (strlen($password) < 6) {
                $_SESSION['error'] = 'Password must be at least 6 characters long';
                header('Location: /register');
                exit;
            }

            // Tentative d'inscription
            $result = $this->userModel->register($name, $email, $password, $role);

            if ($result['success']) {
                $_SESSION['success'] = 'Registration successful! Please login.';
                header('Location: /login');
                exit;
            } else {
                $_SESSION['error'] = $result['message'];
                header('Location: /register');
                exit;
            }
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /login');
        exit;
    }

    private function getRedirectUrl($role) {
        switch ($role) {
            case 'admin':
                return '/admin/dashboard';
            case 'teacher':
                return '/teacher/dashboard';
            case 'student':
                return '/student/dashboard';
            default:
                return '/';
        }
    }
}
