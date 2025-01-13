<?php

class BaseController
{

    protected function renderDashboard($view, $data = [])
    {
        if (file_exists(__DIR__ . "/../app/views/{$view}.php")) {
            // Extraire les données pour qu'elles soient disponibles dans la vue
            extract($data);
            
            // Inclure la vue
            require_once(__DIR__ . "/../app/views/{$view}.php");
        } else {
            throw new Exception("Vue non trouvée: {$view}");
        }
    }

    protected function render($view, $data = [])
    {
        if (file_exists(__DIR__ . "/../app/views/{$view}.php")) {
            extract($data);
            include_once __DIR__.'/../app/views/'.$view.'.php';
        }else{
            throw new Exception("Vue non trouvée: {$view}");
        }
    }

        public function renderAdmin($view, $data = []){
            
            extract($data);
            include_once __DIR__.'/../app/views/admin/'.$view.'.php';
        }
        
        public function renderEtudiant($view, $data = []){
            
            extract($data);
            include_once __DIR__.'/../app/views/etudiant/'.$view.'.php';
        }
        public function renderEnseignant($view, $data = []){
            
            extract($data);
            include_once __DIR__.'/../app/views/enseignant/'.$view.'.php';
        }
    }
