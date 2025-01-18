<?php

class TeacherController extends BaseController
{
    private $userModel;
    private $courseModel;
    private $categoryModel;
    private $tagModel;

    public function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_name'] !== 'teacher') {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Unauthorized access. Please login as a teacher.'
            ];
            header('Location: /login');
            exit();
        }
        
        $this->userModel = new User();
        $this->courseModel = new Course();
        $this->categoryModel = new Category();
        $this->tagModel = new Tag();
    }

    public function dashboard()
    {
        $this->render('teacher/dashboard');
    }

    public function courses()
    {
        $teacherId = $_SESSION['user']['id'];
        $courses = $this->courseModel->teacherCourses($teacherId);
        
        $categories = $this->categoryModel->getAllCategories();
        $tags = $this->tagModel->getAllTags();

        $this->render('teacher/courses', [
            'courses' => $courses,
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function createCourse()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /teacher/courses');
            exit();
        }

        $courseData = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'photo_url' => $_POST['photo_url'],
            'teacher_id' => $_SESSION['user']['id'],
            'category_id' => $_POST['category_id'],
            'type' => $_POST['type'],
            'tags' => isset($_POST['tags']) ? $_POST['tags'] : []
        ];

        if ($courseData['type'] === 'video') {
            $courseData['video'] = $_POST['video'];
        } else {
            $courseData['document'] = $_POST['document'];
        }

        try {
            $courseId = $this->courseModel->createCourse($courseData);
            
            if ($courseId) {
                $_SESSION['message'] = [
                    'type' => 'success',
                    'text' => 'Course created successfully!'
                ];
            } else {
                $_SESSION['message'] = [
                    'type' => 'error',
                    'text' => 'Failed to create course.'
                ];
            }
        } catch (Exception $e) {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Error: ' . $e->getMessage()
            ];
        }

        header('Location: /teacher/courses');
        exit();
    }

    public function students()
    {
        $this->render('teacher/students');
    }
} 