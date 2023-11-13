<?php

namespace app\traits;

use Slim\Http\Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * Trait PostTrait
 * 
 * Este trait é responável pelos métodos principais para validação dos posts
 */
trait PostTrait
{

    /**
     * Método private validateCsrfToken
     * 
     * Este método verifica se o CSRF Token existe e é válido
     * 
     * $param Request $request A resposta HTTP
     */
    private function validateCsrfToken($request)
    {
        return isset($_POST['csrf_token']) && $_POST['csrf_token'] == $_SESSION['csrf_token'];
    }

    /**
     * Método private sanitizeData
     * 
     * Este método recebe os dados do form e sanitiza os dados
     * 
     * @param $data Os dados para serem sanitizados
     */
    private function sanitizeData($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = htmlspecialchars($value, ENT_QUOTES);
        }

        return $data;
    }

    /**
     * Método validatePostData
     * 
     * Este método verifica se o titulo e o conteúdo foram inseridos pelo usuário
     * 
     * @param $data Os dados titulo e contéudo
     */
    private function validatePostData($data)
    {
        return $data['postTitle'] && $data['postContent'];
    }

    private function handleFileUpload(Request $request, Response $response)
    {
        // Verifica se algum arquivo foi enviado na requisição
        $postFile = $request->getUploadedFiles()['postFile'];
        $filename = '';
        
        if ($postFile != null && $postFile->getError() == UPLOAD_ERR_OK) {
            
            // Verifica tipo de arquivo (extensão)
            $extension = pathinfo($postFile->getClientFilename(), PATHINFO_EXTENSION);
            $allowedExtension = ['jpg', 'jpeg', 'png'];

            // verifica se a extensão faz parte das permitidas
            if (!in_array($extension, $allowedExtension)) {
                $_SESSION['status'] = 'error';
                $_SESSION['status_message'] = 'Tipo de imagem não permitida!';
                return $response->withRedirect('/dashboard');
            }
            // gera um nome único como base
            $basename = bin2hex(random_bytes(8));
            // Define o path diretório
            $path = dirname(__FILE__, 3) . DIRECTORY_SEPARATOR . 'public/assets/imgs/posts/';

            $filename = sprintf('%s.%0.8s', $basename, $extension);
            // move o arquivo para o path definido
            $postFile->moveTo($path . $filename);
        }

        return $filename;
    }

    /**
     * Método generateCsrfToken
     * 
     * Este método gera um token CSRF e insere na SESSION para ser usado nos forms
     */
    private function generateCsrfToken()
    {
        $newCsrfToken = bin2hex(random_bytes(32)); // 64 caracteres aleatórios
        $_SESSION['csrf_token'] = $newCsrfToken;
    }

    /**
     * Método generatePostHtml
     * 
     * Este método gera o código html com o último post inserido pelo usuário
     * 
     * @param $post Os dados do registro vindo do banco de dados
     * @return string A string que monta a saida html que será recebida pelo Ajax
     */
    private function generatePostHtml($post)
    {   
        $imageHtml = '';
        if ($post->image) {
            $imageHtml = '<img src="assets/imgs/posts/'.$post->image.'" class="card-img-top" alt="Imagem do Post 1">';
        }

        return '<h3 class="text-info text-center">Novo Post</h3>
            <div class="card border border-0 mb-3">
            <div class="card-header bg-dark text-white">
                <img src="https://via.placeholder.com/40" class="rounded-circle" alt="Imagem de Perfil">
                '.$post->user_name.'
                <a href="#!" onclick="togglerFooter('.$post->id.')" title="opções"><i class="fas fa-ellipsis-v float-end" id="toggle-footer_'.$post->id.'" style="cursor: pointer;"></i></a>
            </div>
            <div class="card-body">
                <h5 class="card-title">' . $post->title . '</h5>
                <p class="card-text">' . $post->description . ' </p>
            </div>
            '.$imageHtml.'
            <div class="card-footer" id="card-footer_'.$post->id.'" style="display: none;">
                <button class="btn btn-primary" id="show-comments-button_' . $post->id . '"><i class="fas fa-comments"></i> Comentários</button>
            </div>
            <div class="comments" id="comments_'.$post->id.'" style="display: none;">
                <div class="card border-bottom border-top border-start-0 border-end-0 mt-3">
                    <div class="card-body d-flex align-items-center">
                        <div class="rounded-circle me-3" style="min-width: 50px; height: 50px; background-color: #555;"></div>
                        <div>
                            <h5 class="card-title">Nome do Usuário 1</h5>
                            <p class="card-text">L de comentário 1. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>';
    }
}
