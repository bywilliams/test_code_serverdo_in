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
            
            $sqlPost = $this->connection->query("SELECT pts.id, pts.title, pts.description, pts.image, CONCAT( usr.name, ' ',  usr.lastname) AS user_name FROM $this->table AS pts
            INNER JOIN users AS usr ON pts.user_id = usr.id
            ");
            try {
                $resultPosts = $sqlPost->fetchAll(PDO::FETCH_OBJ);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            return $resultPosts;
        }

    }