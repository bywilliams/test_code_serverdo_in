<?php
namespace app\controllers;
session_start();
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HomeController
{

    public function index(Request $request, Response $response)
    {

        // variáveis para apresentação de erros de validação
        $status = $_SESSION['status'] ?? '';
        $status_message = $_SESSION['status_message'] ?? '';
        unset($_SESSION['status']);
        unset($_SESSION['status_message']);

        view('home', ['name' => 'William', 'title' => 'Site com Slim e plates engine', 'status' => $status, 'status_message' => $status_message]);
        return $response;
    }

    // public function dashboard(Request $request, Response $response)
    // {
    //     view('dashboard', ['title' => 'Bem vindo a dashboard']);
    //     return $response;
    // }
}
