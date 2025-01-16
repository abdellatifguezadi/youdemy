<?php

class AdminController extends BaseController {

    function __construct()
    {
       
    }


    public function dashboard() {
        
        $this->render('admin/dashboard');
    }

    public function  pending (){
        $this->render('admin/pending-teachers');
    }

    public function courses(){
        $this->render('admin/courses');
    }

    public function users(){
        $this->render('admin/users');
    }
}
