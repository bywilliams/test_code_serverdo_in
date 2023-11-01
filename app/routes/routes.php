<?php
use Slim\App;
use Slim\Routing\RouteCollectorProxy;
use app\controllers\HomeController;
use app\controllers\UserController;

return function (App $app)
{
    $app->get('/', [HomeController::class, 'index'])->setName('home');
    $app->get('/user-create', [UserController::class, 'index'])->setName('users-create');
    $app->post('/user-update', [UserController::class, 'update'])->setName('users-create');
};