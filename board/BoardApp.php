<?php


namespace board;


use libs\App;
use libs\DbConnection;
use libs\Message;

class BoardApp extends App
{


    protected function getActions(): array
    {
        return [
            'index', 'messages'
        ];
    }


    public function index()
    {

        $title = 'messages';

        return $this->render('messages', compact( 'title'));
    }

    public function messages()
    {
        $messages = Message::findAll();
        echo json_encode($messages);
    }





}