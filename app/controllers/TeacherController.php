<?php

class TeacherController extends BaseController
{
    private $userModel;
    private $courseModel;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'teacher') {
            $_SESSION['message'] = 'Unauthorized access. Please login as a teacher.';
            $_SESSION['message_type'] = 'error';
            header('Location: /login');
            exit();
        }
        
        $this->userModel = new User();
        $this->courseModel = new Course();
    }

    public function dashboard()
    {
        $this->render('teacher/dashboard');
    }

    public function courses()
    {
        $this->render('teacher/courses');
    }

    public function students()
    {
        $this->render('teacher/students');
    }

} 