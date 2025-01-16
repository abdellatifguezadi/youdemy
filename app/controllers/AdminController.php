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
        $this->render('admin/users');
    }


}
