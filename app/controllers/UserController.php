<?php
require_once __DIR__ . '/../models/user/cours.php';

class UserController extends BaseController 
{
    private $courseModel;

    function __construct()
    {
        $this->courseModel = new Course();
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 8;
        $offset = ($page - 1) * $limit;

        $courses = $this->courseModel->getAllCourses($limit, $offset);

        foreach ($courses as &$course) {
            $course['tags'] = $this->courseModel->getCourseTags($course['id']);
        }

        $totalCourses = $this->courseModel->getTotalCourses();
        $totalPages = ceil($totalCourses / $limit);

        $this->render('partials/home', [
            'courses' => $courses,
            'totalCourses' => $totalCourses,
            'currentPage' => $page,
            'limit' => $limit,
            'totalPages' => $totalPages
        ]);
    }

    
}
