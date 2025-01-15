<?php
require_once __DIR__ . '/../models/Course.php';
require_once __DIR__ . '/../models/User.php';

class UserController extends BaseController 
{
    private $courseModel;
    private $userModel;

    function __construct()
    {
        $this->courseModel = new Course();
        $this->userModel = new User();
    }

    public function index()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 8;
        $offset = ($page - 1) * $limit;

        $keywords = isset($_GET['keywords']) ? trim($_GET['keywords']) : '';
        $category = isset($_GET['category']) ? (int)$_GET['category'] : '';
        $tag = isset($_GET['tag']) ? (int)$_GET['tag'] : '';

        $courses = $this->courseModel->searchCourses($keywords, $category, $tag, $limit, $offset);
        $totalCourses = (int)$this->courseModel->getTotalFilteredCourses($keywords, $category, $tag);
        $totalPages = (int)ceil($totalCourses / $limit);

        $categories = $this->courseModel->getAllCategories();
        $tags = $this->courseModel->getAllTags();

        $queryParams = [];
        if (!empty($keywords)) $queryParams['keywords'] = $keywords;
        if (!empty($category)) $queryParams['category'] = $category;
        if (!empty($tag)) $queryParams['tag'] = $tag;

        $this->render('partials/home', [
            'courses' => $courses,
            'totalCourses' => $totalCourses,
            'currentPage' => (int)$page,
            'limit' => (int)$limit,
            'totalPages' => $totalPages,
            'categories' => $categories,
            'tags' => $tags,
            'currentKeywords' => $keywords,
            'currentCategory' => $category,
            'currentTag' => $tag,
            'queryParams' => $queryParams
        ]);
    }

    public function courseDetails($id)
    {
        $course = $this->courseModel->getCourseById($id);
        
        $this->render('course/details', [
            'course' => $course
        ]);
    }

}
