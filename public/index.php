<?php

require_once '../app/config/db.php';
require_once '../core/BaseController.php';
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/UserController.php';

session_start();

$router = new Router();
Route::setRouter($router);

// Routes principales
Route::get('/', [UserController::class, 'index']);
Route::get('/course.php', [UserController::class, 'getCourseDetails']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
