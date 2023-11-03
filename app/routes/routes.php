<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use app\controllers\HomeController;
use app\controllers\PostController;

return function (App $app)
{
    $app->get('/', [HomeController::class, 'index'])->setName('auth');
    $app->get('/dashboard', [PostController::class, 'index'])->setName('dashboard');
    // $app->get('/user-create', [UserController::class, 'index'])->setName('users-create');
    //$app->post('/user-update', [UserController::class, 'update'])->setName('users-create');
};