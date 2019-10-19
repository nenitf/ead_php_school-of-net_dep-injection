<?php

class Database
{
    /* Sem injeção */
    // function __construct()
    // {
    //     $this->driver = new \PDO('dsn', 'user', '123');
    // }

    /* Com injeção */
    function __construct(\PDO $pdo)
    {
        // PDO vem configurado, desacoplando \PDO do código
        $this->driver = $pdo;
    }
}

$pdo = new \PDO('dsn', 'user', '123');
$db = new Database($pdo);
