<?php

require_once '../app/config/db.php';
require_once '../core/BaseController.php';
require_once '../core/Router.php';
require_once '../core/Route.php';
require_once '../app/controllers/UserController.php';

session_start();

$router = new Router();
Route::setRouter($router);

Route::get('/', [UserController::class, 'index']);
Route::get('/course/{id}', [UserController::class, 'courseDetails']);

$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
