<?php

    use app\database\Connect;

    class UserModel extends Connect
    {
        private $table;

        function __construct ()
        {
            parent::__construct();
            $this->table = 'users';
        }

    }