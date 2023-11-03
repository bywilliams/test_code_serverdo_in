<?php

namespace app\controllers;
use app\models\PostModel;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class PostController
{   
    private $model;
    
    public function __construct ()
    {
        $this->model = new PostModel();
        //echo "aqui"; exit;
    }
    
    public function index(Request $request, Response $response)
    {   
        //phpinfo();
        $posts = $this->model->getAllPosts();
        //var_dump($posts);
        view('dashboard', ['title' => 'Bem vindo a dashboard', 'posts' => $posts]);
        return $response;
    }


}
