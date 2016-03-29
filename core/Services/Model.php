<?php

namespace Core\Services;

use Core\Database\ConnectionInterface;
use PDO;

class Model
{
    protected $db;
    protected $table;

    public function __construct(ConnectionInterface $connection)
    {
        $this->db = $connection::getInstance();
    }

    protected function find($id, $columns = []){
        $select = '*';
        if(!empty($columns)){
            $select = implode(',', $columns);
        }
        $stmt = $this->db->prepare("SELECT $select FROM {$this->table} WHERE id= :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}