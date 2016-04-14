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

    private $codeGenerator;


    public function __construct(ConnectionInterface $connection, CodeGenerator $codeGenerator)
    {
        $this->connection = $connection::getInstance();
        $this->codeGenerator = $codeGenerator;
    }

    public function index()
    {
        $entities = $this->getEntities();

        $this->getHomeTemplate(['entities' => $entities], self::VIEWS_PATH);

    }

    public function execute($input)
    {
        $parsedInputs = $input;

        foreach ($parsedInputs as $entity){
            $this->codeGenerator->generateEntity($entity['name'], $entity['namespace'], $entity['location']);
        }

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