<?php

namespace Core\Services;

use Core\Controller\ViewRender;
use Core\Database\ConnectionInterface;
use PDO;

class Installer
{
    const VIEWS_PATH = 'installer.view_path';
    /**
     * @var \PDO
     */
    private $connection;


    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection::getInstance();
    }

    public function execute()
    {
        $entities = $this->getEntities();

        $this->getHomeTemplate(['entities' => $entities], self::VIEWS_PATH);

    }

    private function getEntities()
    {
        $stmt = $this->connection->prepare("SHOW tables");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    private function getHomeTemplate($params, $viewSpath)
    {
        $html = ViewRender::render('home.index', $params, $viewSpath);

        echo $html;
    }
}