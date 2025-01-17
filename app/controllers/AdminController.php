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
        $totalUsers = $this->userModel->getTotalUsers();
        $totalCourses = $this->courseModel->getTotalCourses();
        $activeTeachers = $this->userModel->getActiveTeachers();
        $pendingTeachers = $this->userModel->getPendingTeachers();
        $popularCourse = $this->courseModel->getMostPopularCourse();
        $categoryDistribution = $this->categoryModel->getCategoryDistribution();
        $topTeachers = $this->userModel->getTopTeachers();
        $recentActivities = $this->userModel->getRecentActivities();
        
        $this->render('admin/dashboard', [
            'totalUsers' => $totalUsers,
            'totalCourses' => $totalCourses,
            'activeTeachers' => $activeTeachers,
            'pendingTeachers' => $pendingTeachers,
            'popularCourse' => $popularCourse,
            'categoryDistribution' => $categoryDistribution,
            'topTeachers' => $topTeachers,
            'recentActivities' => $recentActivities
        ]);
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

    public function deleteUser($id) {
        $this->userModel->deleteUser($id);
            header('Location: /admin/users');
            exit;
        
    }

    public function deleteCourse($id) {
        $this->courseModel->deleteCourse($id);
        header('Location: /admin/courses');
        exit;
    }

    public function bulkInsertTags() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tags'])) {
            $tagsText = trim($_POST['tags']);
            
            if (empty($tagsText)) {
                $_SESSION['message'] = 'Veuillez entrer au moins un tag';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/tags');
                exit();
            }
            
            $tagNames = array_map('trim', explode(',', $tagsText));
            $tagNames = array_filter($tagNames); 
            
            if (empty($tagNames)) {
                $_SESSION['message'] = 'Veuillez entrer des tags valides';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/tags');
                exit();
            }
            
            if ($this->tagModel->bulkInsertTags($tagNames)) {
                $_SESSION['message'] = 'Tags ajoutés avec succès';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de l\'ajout des tags';
                $_SESSION['message_type'] = 'error';
            }
            header('Location: /admin/tags');
            exit();
        }
        
        header('Location: /admin/tags');
        exit();
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
            $name = trim($_POST['name']);
            $discription = trim($_POST['description']);
            
            if(empty($discriptio)){
                $_SESSION['message']= 'Veuillez entrer une description';
                $_SESSION['message_type']= 'error';
                header('Location: /admin/categories');
                exit();
            }

            if (empty($name)) {
                $_SESSION['message'] = 'Le nom de la catégorie ne peut pas être vide';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/categories');
                exit();
            }
            
            if ($this->categoryModel->addCategory($name , $discription)) {
                $_SESSION['message'] = 'Catégorie ajoutée avec succès';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Cette catégorie existe déjà';
                $_SESSION['message_type'] = 'error';
            }
            
            header('Location: /admin/categories');
            exit();
        }
        
        header('Location: /admin/categories');
        exit();
    }
}
