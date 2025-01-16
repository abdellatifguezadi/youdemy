<?php
require_once '../app/models/User.php';
require_once '../app/models/Course.php';
require_once '../app/models/Category.php';
require_once '../app/models/Tag.php';

class AdminController extends BaseController {

    private $userModel;
    private $courseModel;
    private $categoryModel;
    private $tagModel;
    
    function __construct()
    {
        $this->userModel = new User();
        $this->courseModel = new Course();
        $this->categoryModel = new Category();
        $this->tagModel = new Tag();
    }

    public function dashboard() {
        $this->render('admin/dashboard');
    }

    public function pending () {
        $pendingTeachers = $this->userModel->getTeacherpending();
        $this->render('admin/pending-teachers', ['pendingTeachers' => $pendingTeachers]);
    }

    public function courses (){
        $courses = $this->courseModel->searchCourses();
        $data['courses'] = $courses;
        $this->render('admin/courses', $data);
    }

    public function users(){
        $AllUsers = $this->userModel->getAllUsers();
        $this->render('admin/users', ['AllUsers' => $AllUsers]);
    }

    public function tags (){
        $tags = $this->tagModel->getAllTags();
        
        foreach ($tags as &$tag) {
            $tag['course_count'] = $this->tagModel->getCoursesCountByTag($tag['id']);
        }
        unset($tag);
        
        $this->render('admin/tags', ['tags' => $tags]);
    }

    public function categories (){
        $categories = $this->categoryModel->getAllCategories();
        
        foreach ($categories as &$category) {
            $category['course_count'] = $this->categoryModel->getCoursesCountByCategory($category['id']);
        }
        unset($category);
        
        $this->render('admin/categories', ['category' => $categories]);
    }
}
