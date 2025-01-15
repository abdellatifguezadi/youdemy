<?php

class AuthController extends BaseController {
    public function showLoginForm() {
        $this->render('auth/login');
    }

    public function showRegisterForm() {
        $role = isset($_GET['role']) ? $_GET['role'] : '';
        $this->render('auth/register', ['role' => $role]);
    }


}
