<?php
namespace app\controllers;
session_start();
use app\models\PostModel;
use app\traits\PostTrait;
use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Classe PostController
 * 
 * Esta classe é responsável por gerenciar as operações relacionadas aos posts.
 */
class PostController
{
    use PostTrait;

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
        // Gera CSRF Token
        $this->generateCsrfToken();

        // apresentação de erros de validação
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
        // Pega o corpo da requisição com Slim
        $data = $request->getParsedBody();
        
        // verifica se o form possui CSRF Token e se não está vazio
        if (!$this->validateCsrfToken($data)) {
            $_SESSION['status'] = 'error';
            $_SESSION['status_message'] = 'Ação inválida';
            return $response->withRedirect('/');
        }
        
        // sanitiza os inputs titulo e conteúdo
        $data = $this->sanitizeData($data);
        
        // Verifica se algum arquivo foi enviado, salva na pasta e retorna o nome para a variável
        $filename = $this->handleFileUpload($request, $response);
        
        // Adiciona o nome da imagem ao objeto de dados
        $data['postFile'] = $filename ??  null; 
        
        // converte em um Json
        $json = json_encode($data);

        // decodifica o Json para usar como objeto
        $formDataObjt = json_decode($json);

        // Insere o post no BD
        $this->model->create($formDataObjt);

        // traz o registro do post inserido
        $lastPost = $this->model->lastInsertId('1');
        
        // Gera o html do post
        $postHtml = $this->generatePostHtml($lastPost);

        // retorna como um JSON para a rquisição Ajax
        return $response->withJson(['post' => $postHtml]);
    }
}
