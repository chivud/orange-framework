<?php


namespace Core\Database;

interface ConnectionInterface
{
    public function create();

    public static function getInstance();

    public static function closeConnection();
}
