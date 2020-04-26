<?php
namespace libs;

use PDO;

/* @property PDO $_pdo */
class DbConnection
{

    protected $_pdo;

    protected static $instance;

    protected function __construct()
    {
        $configs = $this->getDbConfigs();
        try {
            $this->_pdo = new PDO("mysql:host={$configs['host']};dbname={$configs['dbname']}", $configs['username'], $configs['password']);
        } catch (\PDOException $exception) {
            throw new \Exception('Db Connection fail');
        }
        // set the PDO error mode to exception
        $this->_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    protected function getDbConfigs(): array
    {
        $configs = require BASE_DIR.'/configs/db.php';
        if(!$configs) {
            throw new \Exception('db configs are missing');
        }
        return $configs;
    }

    public static function getConnection(): self
    {
        if(!static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;
    }

    protected function prepare(string $sql, array $params = []): \PDOStatement
    {
        $conn = $this->_pdo;

        $stmt = $conn->prepare($sql);
        if($params) {
            foreach ($params as $param => $value) {
                $stmt->bindParam($param, $params[$param]);
            }
        }
        return $stmt;
    }

    public function select(string $sql, array $params = [])
    {
        $stmt = $this->prepare($sql, $params);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        return $stmt->fetchAll();
    }

    public function insert(string $sql, array $params = [])
    {
        $stmt = $this->prepare($sql, $params);
        $stmt->execute();
    }




}