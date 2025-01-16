<?php

class AdminController extends BaseController {

    private $userModel;
    
    function __construct()
    {
        $this->userModel = new User();
    }


    public function dashboard() {
        
        $this->render('admin/dashboard');
    }

    public function pending () {
        $pendingTeachers = $this->userModel->getTeacherpending();
        $this->render('admin/pending-teachers', ['pendingTeachers' => $pendingTeachers]);
    }

    public function courses (){
        $this->render('admin/courses');
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
