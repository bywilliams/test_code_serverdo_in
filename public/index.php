<?php 

use Slim\Factory\AppFactory;
use Slim\Middleware\StaticFiles;
use Slim\Routing\RouteCollectorProxy;

require '../vendor/autoload.php';

$app = AppFactory::create();

$routes = require'../app/routes/routes.php';

$routes($app);

$app->addErrorMiddleware(true, true, true);

$app->run();
