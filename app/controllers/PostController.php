<?php
namespace app\controllers;
session_start();
use app\models\PostModel;

use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Classe PostController
 * 
 * Esta classe é responsável por gerenciar as operações relacionadas aos posts.
 */
class PostController
{
    private $model;
    protected $router;

    /**
     * Constructor da classe PostController
     * 
     * Inicializa a classe PostController e cria uma nova instância do modelo PostModel
     */
    public function __construct()
    {
        $this->model = new PostModel();
    }

    /**
     * Método index
     * 
     * Este método gera um novo token CSRF, recupera todos os posts e apresenta a página de dashboard
     * 
     * @param Request $request A requisição HTTP
     * @param Response $response A resposta HTTP
     * @return Response A resposta HTTP
     */
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

    /**
     * Método store
     * 
     * Este método verifica o token CSRF, sanitiza os dados postados e verifica se um arquivo foi enviado
     * 
     * @param Request $request A requisição HTTP
     * @param Response $response A resposta HTTP
     * @return Response A resposta HTTP
     */
    public function store(Request $request, Response $response)
    {
        // verifica se o form possui CSRF Token e se não está vazio
        if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] != $_SESSION['csrf_token']) {
            $_SESSION['status'] = 'error';
            $_SESSION['status_message'] = 'Ação inválida';
            return $response->withRedirect('/');
        }
        
        // Pega o corpo da requisição com Slim
        $data = $request->getParsedBody();
        
        // verifica se titulo e conteúdo foram preenchidos
        if (empty($data['postTitle']) && empty($data['postContent'])) {
            $_SESSION['status'] = 'error';
            $_SESSION['status_message'] = 'Preencha o titulo e conteúdo do post!';
            return $response->withRedirect('/dashboard');
        }
        
        // sanitiza os inputs titulo e conteúdo
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        $json = json_encode($data);

        $formDataObjt = json_decode($json);

        $postInsert = $this->model->create($formDataObjt);

        // Verifica se algum arquivo foi enviado na requisição
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
