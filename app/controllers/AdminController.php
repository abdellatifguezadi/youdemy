<?php

class AdminController extends BaseController {

    private $userModel;
    private $courseModel;
    
    function __construct()
    {
        $this->userModel = new User();
        $this->courseModel = new Course();
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
        $this->render('admin/tags');
    }
    public function categories (){
        $this->render('admin/categories');
    }



}
