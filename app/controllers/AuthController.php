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

            $name = trim($_POST['name'] ?? '');
            $email = trim(strtolower($_POST['email'] ?? ''));
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'student';

            if (empty($name)) {
                $_SESSION['error'] = 'Please enter your name';
                header('Location: /register');
                exit;
            }

            if (strlen($name) < 6) {
                $_SESSION['error'] = 'Name must be at least 6 characters long';
                header('Location: /register');
                exit;
            }


            if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
                $_SESSION['error'] = 'Name can only contain letters and spaces';
                header('Location: /register');
                exit;
            }

            if (empty($email)) {
                $_SESSION['error'] = 'Please enter your email';
                header('Location: /register');
                exit;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $_SESSION['error'] = 'Please enter a valid email address';
                header('Location: /register');
                exit;
            }


            if (empty($password)) {
                $_SESSION['error'] = 'Please enter a password';
                header('Location: /register');
                exit;
            }

            if (strlen($password) < 8) {
                $_SESSION['error'] = 'Password must be at least 8 characters long';
                header('Location: /register');
                exit;
            }

            if (strlen($password) > 50) {
                $_SESSION['error'] = 'Password must be less than 50 characters';
                header('Location: /register');
                exit;
            }

            if (!preg_match("/[0-9]/", $password)) {
                $_SESSION['error'] = 'Password must contain at least one number';
                header('Location: /register');
                exit;
            }

            if (!preg_match("/[a-z]/", $password)) {
                $_SESSION['error'] = 'Password must contain at least one lowercase letter';
                header('Location: /register');
                exit;
            }

            if (!preg_match("/[A-Z]/", $password)) {
                $_SESSION['error'] = 'Password must contain at least one uppercase letter';
                header('Location: /register');
                exit;
            }

            if (!preg_match("/[@#$%^&*()!_-]/", $password)) {
                $_SESSION['error'] = 'Password must contain at least one special character (@#$%^&*()!_-)';
                header('Location: /register');
                exit;
            }


            if (!in_array($role, ['student', 'teacher'])) {
                $_SESSION['error'] = 'Invalid role selected';
                header('Location: /register');
                exit;
            }

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
                return '/';
            default:
                return '/';
        }
    }
}
