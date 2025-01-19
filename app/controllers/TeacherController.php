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
        $teacherId = $_SESSION['user']['id'];
        $courses = $this->courseModel->teacherCourses($teacherId);
        $totalCourses = $courses ? count($courses) : 0;

        $videoCourses = 0;
        $documentCourses = 0;
        if ($courses) {
            foreach ($courses as $course) {
                if ($course->getType() === 'Cours vidéo') {
                    $videoCourses++;
                } else {
                    $documentCourses++;
                }
            }
        }
        $totalStudents = $this->userModel->getTeacherTotalStudents($teacherId);
        $popularCourses = $this->courseModel->getPopularCoursesByTeacher($teacherId);
        $recentCourses = $this->courseModel->getRecentCoursesByTeacher($teacherId, 5);
        $pendingEnrollments = $this->courseModel->getPendingEnrollmentsCount($teacherId);
        
        $this->render('teacher/dashboard', [
            'totalCourses' => $totalCourses,
            'totalStudents' => $totalStudents,
            'videoCourses' => $videoCourses,
            'documentCourses' => $documentCourses,
            'popularCourses' => $popularCourses,
            'recentCourses' => $recentCourses,
            'pendingEnrollments' => $pendingEnrollments
        ]);
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
      

        header('Location: /teacher/courses');
        exit();
    }

    public function students()
    {
        $this->render('teacher/students');
    }

    public function deleteCourse($id)
    {
        $this->courseModel->deleteCourse($id);
        header('Location: /teacher/courses');
        exit;
    }
} 