<?php
    namespace app\models;
    use app\database\Connect;
    use PDO;
    use PDOException;

    /**
     * Classe PosModel
     * 
     * Esta classe é responsável por efeutar as operações de banco de dados na tabela 'posts'
     * Está classe herda a coneção com o banco de dados da classe Connect
     */
    class PostModel extends Connect
    {        
        private $table;
        
        /**
         * Contrutor da classe PostModel
         * 
         * Inicializa a classe PostModel, permite criar uma instância do contrutor da classe Connect
         * Define o nome da tabela a qual a classe fará operações
         */
        function __construct ()
        {
            parent::__construct();
            $this->table = 'posts';
        }

        /**
         * Método getAllPosts
         * 
         * Este método traz todos os posts feitos pelos usuários do sistema
         * @return array $resultsPosts 
         */
        function getAllPosts ()
        {
            $sqlPost = $this->connection->query("SELECT pts.id, pts.title, pts.description, pts.image, CONCAT( usr.name, ' ',  usr.lastname) AS user_name 
            FROM $this->table AS pts
            INNER JOIN users AS usr ON pts.user_id = usr.id
            ORDER BY pts.id DESC
            ");
            try {
                $resultPosts = $sqlPost->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultPosts;
        }

        /**
         * Método create
         * 
         * Este método recebe um array de dados e cria novos posts na na tabela 'posts'
         * @param object Os dados do form como objeto
         * @return bool A resposta para o INSERT 
         */
        function create($formData)
        {
            
            $sqlInsert = ("INSERT INTO $this->table 
            (title, description, image, user_id, created_at)
            VALUES (:title, :description, :image, :user_id, NOW())");

            $stmt = $this->connection->prepare($sqlInsert);

            try
            {
                $stmt->execute([
                    ":title"=> $formData->postTitle,
                    ":description"=> $formData->postContent,
                    "image" => $formData->postFile,
                    ":user_id"=> "1"
                ]);
                return true;
            }
            catch (PDOException $e)
            {
                echo "Erro ao criar post, consulte o administrador do sistema.";
                // echo $e->getMessage();
                return false;
            }

        }

        function lastInsertId ($user_id) 
        {
            $sqlLastInsert = "SELECT pts.id, pts.title, pts.description, pts.image, CONCAT( usr.name, ' ',  usr.lastname) AS user_name 
            FROM $this->table AS pts
            INNER JOIN users AS usr ON pts.user_id = usr.id
            WHERE pts.user_id = :user_id
            ORDER BY pts.id DESC LIMIT 1";
            $stmt = $this->connection->prepare($sqlLastInsert);

            $stmt->execute(['user_id' => $user_id]);
            $data = $stmt->fetch();

            return $data;
        }


    }