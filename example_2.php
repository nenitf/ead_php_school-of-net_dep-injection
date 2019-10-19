<?php
// semelhante ao adapter

interface DatabaseDriver
{
    public function configure(array $config);
    public function connect();
}

class PDODriver implements DatabaseDriver
{
    private $config;
    public function configure(array $config)
    {
        $this->config = $config;
    }
    public function connect()
    {
        $pdo = new \PDO($this->config['dsn'], $this->config['user'], $this->config['passwd']);
    }
}

class MongoDriver implements DatabaseDriver
{
    private $config;
    public function configure(array $config)
    {
        $this->config = $config;
    }
    public function connect()
    {
        $mongo = new \MongoCient($this->config['server']);
    }
}

class Database
{
    function __construct(\DatabaseDriver $driver)
    {
        $this->driver = $driver;
    }
}

$ioc = [];
$ioc['db'] = function(){
    $pdo_driver = new PDODriver();
    $pdo_driver->configure(['dsn' => 'dsn', 'user' => 'user', 'passwd' => '123']);
    return new Database($pdo_driver);
};
$ioc['db_mongo'] = function(){
    $pdo_driver = new MongoDriver();
    $pdo_driver->configure(['dsn', 'user', '123']);
    return new Database($pdo_driver);
};

$ioc['db']();

