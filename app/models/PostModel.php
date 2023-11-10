<?php
    namespace app\models;
    use app\database\Connect;
    use PDO;
    use PDOException;

    class PostModel extends Connect
    {        
        private $table;
        
        function __construct ()
        {
            parent::__construct();
            $this->table = 'posts';
        }

        function getAllPosts ()
        {
            $sqlPost = $this->connection->query("SELECT pts.id, pts.title, pts.description, pts.image, CONCAT( usr.name, ' ',  usr.lastname) AS user_name 
            FROM $this->table AS pts
            INNER JOIN users AS usr ON pts.user_id = usr.id
            ");
            try {
                $resultPosts = $sqlPost->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultPosts;
        }

        function create($formData)
        {
            
            $sqlInsert = ("INSERT INTO $this->table 
            (title, description, user_id, created_at)
            VALUES (:title, :description, :user_id, NOW())");

            $stmt = $this->connection->prepare($sqlInsert);

            try
            {
                $stmt->execute([
                    ":title"=> $formData->postTitle,
                    ":description"=> $formData->postContent,
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

    }