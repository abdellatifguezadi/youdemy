<?php
require_once '../app/models/User.php';
require_once '../app/models/Course.php';
require_once '../app/models/Category.php';
require_once '../app/models/Tag.php';

class AdminController extends BaseController
{

    private $userModel;
    private $courseModel;
    private $categoryModel;
    private $tagModel;

    function __construct()
    {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role_id'] != 1) {
            $_SESSION['message'] = 'Accès non autorisé. Veuillez vous connecter en tant qu\'administrateur.';
            $_SESSION['message_type'] = 'error';
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

    public function pending()
    {
        $pendingTeachers = $this->userModel->getTeacherpending();
        $this->render('admin/pending-teachers', ['pendingTeachers' => $pendingTeachers]);
    }

    public function courses()
    {
        $courses = $this->courseModel->searchCourses();
        $data['courses'] = $courses;
        $this->render('admin/courses', $data);
    }

    public function users()
    {
        $AllUsers = $this->userModel->getAllUsers();
        $this->render('admin/users', ['AllUsers' => $AllUsers]);
    }

    public function tags()
    {
        $tags = $this->tagModel->getAllTags();

        foreach ($tags as &$tag) {
            $tag['course_count'] = $this->tagModel->getCoursesCountByTag($tag['id']);
        }
        unset($tag);

        $this->render('admin/tags', ['tags' => $tags]);
    }

    public function categories()
    {
        $categories = $this->categoryModel->getAllCategories();

        foreach ($categories as &$category) {
            $category['course_count'] = $this->categoryModel->getCoursesCountByCategory($category['id']);
        }
        unset($category);

        $this->render('admin/categories', ['category' => $categories]);
    }

    public function deleteUser($id)
    {
        $this->userModel->deleteUser($id);
        header('Location: /admin/users');
        exit;
    }

    public function deleteCourse($id)
    {
        $this->courseModel->deleteCourse($id);
        header('Location: /admin/courses');
        exit;
    }

    public function bulkInsertTags()
    {
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

    public function addCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (empty($description)) {
                $_SESSION['message'] = 'Veuillez entrer une description';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/categories');
                exit();
            }

            if (empty($name)) {
                $_SESSION['message'] = 'Le nom de la catégorie ne peut pas être vide';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/categories');
                exit();
            }

            if ($this->categoryModel->addCategory($name, $description)) {
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

    public function deletetag($id)
    {
        if ($this->tagModel->deleteTag($id)) {
            $_SESSION['message'] = 'Tag supprimé avec succès';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression du tag';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: /admin/tags');
        exit();
    }

    public function deletecat($id)
    {
        if ($this->categoryModel->deleteCategory($id)) {
            $_SESSION['message'] = 'Catégorie supprimée avec succès';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Erreur lors de la suppression de la catégorie';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: /admin/categories');
        exit();
    }

    public function updateCategory()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['category_id'])) {
            $id = trim($_POST['category_id']);
            $name = trim($_POST['name']);
            $description = trim($_POST['description']);

            if (empty($name)) {
                $_SESSION['message'] = 'Le nom de la catégorie ne peut pas être vide';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/categories');
                exit();
            }

            if (empty($description)) {
                $_SESSION['message'] = 'La description ne peut pas être vide';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/categories');
                exit();
            }

            if ($this->categoryModel->updateCategory($id, $name, $description)) {
                $_SESSION['message'] = 'Catégorie mise à jour avec succès';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de la mise à jour de la catégorie';
                $_SESSION['message_type'] = 'error';
            }
            header('Location: /admin/categories');
            exit();
        }

        header('Location: /admin/categories');
        exit();
    }

    public function updateTag()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['tag_id'])) {
            $id = trim($_POST['tag_id']);
            $name = trim($_POST['name']);

            if (empty($name)) {
                $_SESSION['message'] = 'Le nom du tag ne peut pas être vide';
                $_SESSION['message_type'] = 'error';
                header('Location: /admin/tags');
                exit();
            }

            if ($this->tagModel->updateTag($id, $name)) {
                $_SESSION['message'] = 'Tag mis à jour avec succès';
                $_SESSION['message_type'] = 'success';
            } else {
                $_SESSION['message'] = 'Erreur lors de la mise à jour du tag';
                $_SESSION['message_type'] = 'error';
            }
            header('Location: /admin/tags');
            exit();
        }

        header('Location: /admin/tags');
        exit();
    }

    public function activateTeacher($id)
    {
        if ($this->userModel->activateTeacher($id)) {
            $_SESSION['message'] = 'Teacher activated successfully';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error activating teacher';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: /admin/pending-teachers');
        exit();
    }

    public function rejectTeacher($id)
    {
        if ($this->userModel->rejectTeacher($id)) {
            $_SESSION['message'] = 'Teacher rejected and account deleted successfully';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error rejecting teacher';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: /admin/pending-teachers');
        exit();
    }

    public function suspendUser($id)
    {
        if ($this->userModel->suspendUser($id)) {
            $_SESSION['message'] = 'User suspended successfully';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error suspending user';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: /admin/users');
        exit();
    }

    public function activateUser($id)
    {
        if ($this->userModel->activateUser($id)) {
            $_SESSION['message'] = 'User activated successfully';
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = 'Error activating user';
            $_SESSION['message_type'] = 'error';
        }
        header('Location: /admin/users');
        exit();
    }
}
