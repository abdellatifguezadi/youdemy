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
        $teacherId = $_SESSION['user']['id'];
        $enrolledStudents = $this->userModel->getTeacherStudents($teacherId);

        $courseStudents = [];
        foreach ($enrolledStudents as $enrollment) {
            if (!isset($courseStudents[$enrollment['course_id']])) {
                $courseStudents[$enrollment['course_id']] = [
                    'id' => $enrollment['course_id'],
                    'title' => $enrollment['course_title'],
                    'students' => []
                ];
            }
            $courseStudents[$enrollment['course_id']]['students'][] = [
                'id' => $enrollment['student_id'],
                'name' => $enrollment['student_name'],
                'email' => $enrollment['student_email'],
                'enrollment_date' => $enrollment['enrollment_date'],
                'status' => $enrollment['status']
            ];
        }

        $this->render('teacher/students', [
            'courseStudents' => $courseStudents
        ]);
    }

    public function deleteCourse($id)
    {
        $this->courseModel->deleteCourse($id);
        header('Location: /teacher/courses');
        exit;
    }

    public function updateCourse()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /teacher/courses');
            exit();
        }

        $courseData = [
            'id' => $_POST['course_id'],
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

        if ($this->courseModel->updateCourse($courseData)) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Course updated successfully!'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Failed to update course.'
            ];
        }

        header('Location: /teacher/courses');
        exit();
    }

    public function deleteStudent($studentId)
    {
        if (!isset($_POST['course_id'])) {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Course ID is required.'
            ];
            header('Location: /teacher/students');
            exit();
        }

        $courseId = $_POST['course_id'];
        $teacherId = $_SESSION['user']['id'];

        if ($this->userModel->deleteStudentFromCourse($studentId, $courseId, $teacherId)) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Student removed from course successfully.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Failed to remove student from course.'
            ];
        }

        header('Location: /teacher/students');
        exit();
    }

    public function updateEnrollmentStatus($studentId)
    {
        $courseId = $_POST['course_id'];
        $status = $_POST['status'];
        $teacherId = $_SESSION['user']['id'];

        if ($this->userModel->updateEnrollmentStatus($studentId, $courseId, $status, $teacherId)) {
            $_SESSION['message'] = [
                'type' => 'success',
                'text' => 'Enrollment status updated successfully.'
            ];
        } else {
            $_SESSION['message'] = [
                'type' => 'error',
                'text' => 'Failed to update enrollment status.'
            ];
        }

        header('Location: /teacher/students');
        exit();
    }
} 