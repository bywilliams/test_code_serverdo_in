<?php
namespace app\controllers;
session_start();
use app\models\PostModel;

use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;


class PostController
{
    private $model;
    protected $router;

    public function __construct()
    {
        $this->model = new PostModel();
    }

    public function index(Request $request, Response $response)
    {
        // Gera um novo token CSRF
        $newCsrfToken = bin2hex(random_bytes(32)); // 64 caracteres aleatórios

        // Armazena o token na sessão
        $_SESSION['csrf_token'] = $newCsrfToken;

        // variáveis para apresentação de erros de validação
        $status = $_SESSION['status'] ?? '';
        $status_message = $_SESSION['status_message'] ?? '';
        unset($_SESSION['status']);
        unset($_SESSION['status_message']);

        // Traz todos os posts 
        $posts = $this->model->getAllPosts();
        view('dashboard', ['title' => 'Bem vindo a dashboard', 'posts' => $posts, 'status' => $status, 'status_message' => $status_message]);
        return $response;
    }

    public function store(Request $request, Response $response)
    {
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['csrf_token']) {
            $_SESSION['status'] = 'error';
            $_SESSION['status_message'] = 'Ação inválida';
            return $response->withRedirect('/');
        }
        
        // sanitiza os inputs postTitle e postContent
        $data = $request->getParsedBody();
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        if (!$data['postTitle'] && !$data['postContent']) {
            $_SESSION['status'] = 'error';
            $_SESSION['status_message'] = 'Preencha o titulo e conteúdo do post!';
            return $response->withRedirect('/dashboard');
        }

        $postFile = $request->getUploadedFiles()['postFile'];
        if ($postFile->getError() == UPLOAD_ERR_OK) {
            
            // Verifica tipo de arquivo
            $extension = pathinfo($postFile->getClientFilename(), PATHINFO_EXTENSION);
            $allowedExtension = ['jpg', 'jpeg', 'png'];

            // verifica se a extensão não faz parte das permitidas
            if (!in_array($extension, $allowedExtension)) {
                $_SESSION['status'] = 'error';
                $_SESSION['status_message'] = 'Tipo de imagem não permitida!';
                return $response->withRedirect('/dashboard');
            }

            echo "imagem ok"; exit;
            
        }
        
        
        return $response;
    }
}
