<?php


namespace libs;


abstract class App
{
    protected $connection;

    public function __construct()
    {
        $this->connection = DbConnection::getConnection();
    }

    public function run()
    {
        $action = $this->getAction();
        $this->beforeAction($action);
        return $this->$action();
    }

    protected function getAction()
    {
        $action = $_GET['action'] ?? 'index';
        $actions = $this->getActions();
        if (!in_array($action, $actions)) {
            $this->show404();
        }
        return $action;
    }

    abstract protected function getActions(): array;

    protected function show404()
    {
        header('HTTP/1.0 404 Not Found');
        die('<h1>404 Not Found</h1>');
    }

    protected function render(string $view, array $data = [])
    {
        if ($data) {
            extract($data);
        }
        require APP_DIR . '/views/' . $view . '.php';
        return true;
    }

    protected function redirect($url)
    {
        header("Location: $url");
        exit;
    }

    protected function beforeAction($action)
    {

    }

}