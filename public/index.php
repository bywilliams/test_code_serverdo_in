<?php 
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use Slim\Routing\RouteCollectorProxy;
use app\controllers\HomeController;

require '../vendor/autoload.php';

$app = AppFactory::create();

$app->get('/', [HomeController::class, 'index'])->setName('users-list');

$app->run();