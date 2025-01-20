<?php
require_once '../app/models/Student.php';
require_once '../app/models/Course.php';

class StudentController extends BaseController
{
    private $studentModel;

    public function __construct()
    {
        $this->studentModel = new Student();
        
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'student') {
            $_SESSION['message'] = 'You must be logged in as a student to access this page';
            $_SESSION['message_type'] = 'error';
            header('Location: /login');
            exit();
        }
    }

    public function courseDetails($id)
    {
        $courseModel = new Course();
        $course = $courseModel->getCourseById($id);
        
        if (!$course) {
            header('Location: /404');
            exit();
        }

        $enrollment = $this->studentModel->getEnrollmentStatus($id, $_SESSION['user']['id']);

        if ($enrollment !== 'approved') {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Vous devez être inscrit et approuvé pour accéder aux détails de ce cours.'
            ];
            header('Location: /');
            exit();
        }

        require '../app/views/course/details.php';
    }

    public function enrollments()
    {
        $enrollments = $this->studentModel->getMyEnrollments($_SESSION['user']['id']);
        $this->render('user/enrollments', [
            'enrollments' => $enrollments
        ]);
    }

    public function enroll($courseId)
    {
        if ($this->studentModel->enrollInCourse($courseId, $_SESSION['user']['id'])) {
            $_SESSION['message'] = 'Successfully enrolled in the course!';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'You are already enrolled in this course or an error occurred.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /my-enrollments');
        exit();
    }

    public function deleteEnrollment($courseId)
    {
        if ($this->studentModel->deleteEnrollment($courseId, $_SESSION['user']['id'])) {
            $_SESSION['message'] = 'Successfully unenrolled from the course.';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error occurred while trying to unenroll from the course.';
            $_SESSION['message_type'] = 'error';
        }
        
        header('Location: /my-enrollments');
        exit();
    }
} 