<?php

class AdminController extends BaseController {
    public function dashboard() {
        // TODO: Add authentication check for admin role
        
        // For now, just render the dashboard view
        $this->render('admin/dashboard');
    }
}
