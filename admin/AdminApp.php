<?php


namespace admin;


use libs\App;
use libs\DbConnection;
use libs\Message;

class AdminApp extends App
{



    protected function getActions(): array
    {
        return [
            'index', 'create', 'login', 'logout'
        ];
    }

    public function beforeAction($action)
    {
        parent::beforeAction($action);
        session_start();
        if(empty($_SESSION['admin_id']) && $action != 'login') {
            return $this->redirect('/admin?action=login');
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        return $this->redirect('/admin');
    }

    public function login()
    {
        $message = '';
        if(!empty($_POST['login']) && !empty($_POST['password'])) {

            $db = DbConnection::getConnection();
            $result = $db->select('SELECT * FROM admins WHERE username = :username', [':username' =>$_POST['login'] ]);
            if($result) {
                $admin = $result[0];
                if(password_verify($_POST['password'], $admin->password_hash)) {
                    $_SESSION['admin_id'] = $admin->id;
                    return $this->redirect('/admin');
                }
            }
            $message = 'invalid login or password';
        }
        $title = 'login';
        return $this->render('login', compact('title', 'message'));
    }

    public function index()
    {
        $messages = Message::findAll();
        $title = 'messages';

        return $this->render('messages', compact('messages', 'title'));
    }


    public function create()
    {
        $data = ['title' => 'Create Message'];

        if($_POST) {
            $message = $_POST['message'] ?? '';
            if(!$message) {
                $data['message'] = 'Message is required';
                return $this->render('create', $data);
            }
            $db = DbConnection::getConnection();
            $data = [
                'message' => $message,
                'created_at' => time()
            ];
            $db->insert('INSERT INTO messages (message, created_at) VALUES(:message, :created_at)', $data);

            $this->redirect('/admin');
        }
        return $this->render('create', $data);
    }



}