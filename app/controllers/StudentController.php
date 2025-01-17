<?php

class StudentController extends BaseController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new User();
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'student') {
            $_SESSION['message'] = 'You must be logged in as a student to access this page';
            $_SESSION['message_type'] = 'error';
            header('Location: /login');
            exit();
        }
    }

    public function enrollments()
    {
        $enrollments = $this->userModel->getMyEnrollments($_SESSION['user']['id']);
        $this->render('user/enrollments', [
            'enrollments' => $enrollments
        ]);
    }

    public function enroll($courseId)
    {
        if ($this->userModel->enrollInCourse($_SESSION['user']['id'], $courseId)) {
            $_SESSION['message'] = 'Successfully enrolled in the course!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'You are already enrolled in this course or an error occurred.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /my-enrollments');
        exit();
    }
} 