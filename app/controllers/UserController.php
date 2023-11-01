<?php

namespace app\controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class UserController
{

    public function index(Request $request,Response $response)
    {
        view('user_create', ['title' => 'User Create']);
        return $response;
    }

    public function update ()
    {
        var_dump($_POST);
        die();
    }

}
