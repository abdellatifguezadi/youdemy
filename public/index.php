<?php

require_once '../app/config/db.php';
require_once '../core/BaseController.php';
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/UserController.php';
require_once '../app/controllers/AuthController.php';
require_once '../app/controllers/AdminController.php';

session_start();

$router = new Router();
Route::setRouter($router);

// Pages principales
Route::get('/', [UserController::class, 'index']);
Route::get('/course/{id}', [UserController::class, 'courseDetails']);

// Routes d'authentification
Route::get('/login', [AuthController::class, 'showLoginForm']);
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegisterForm']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

// Routes admin
Route::get('/admin/dashboard', [AdminController::class, 'dashboard']);
Route::get('/admin/pending-teachers', [AdminController::class, 'pending']);
Route::get('/admin/courses', [AdminController::class, 'courses']);
Route::get('/admin/users', [AdminController::class, 'users']);
Route::get('/admin/tags', [AdminController::class, 'tags']);
Route::get('/admin/categories', [AdminController::class, 'categories']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
