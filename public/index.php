<?php 

use Slim\Factory\AppFactory;
use Slim\Middleware\StaticFiles;

require '../vendor/autoload.php';

$app = AppFactory::create();

$routes = require'../app/routes/routes.php';

$routes($app);

$app->run();
