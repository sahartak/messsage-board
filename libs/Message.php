<?php


namespace libs;


class Message
{
    public static function findAll(): array
    {
        $db = DbConnection::getConnection();
        $messages = $db->select('SELECT * FROM messages ORDER BY id DESC');
        return  $messages;
    }

}