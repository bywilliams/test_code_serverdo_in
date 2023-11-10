<?php
use Slim\App;
use app\controllers\HomeController;
use app\controllers\PostController;

return function (App $app)
{
    $app->get('/', [HomeController::class, 'index'])->setName('auth');
    $app->get('/dashboard', [PostController::class, 'index'])->setName('dashboard');
    //$app->post('/dashboard', [PostController::class, 'store'])->setName('post-store');
    $app->post('/post-store', [PostController::class, 'store'])->setName('post-store');
};