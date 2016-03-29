<?php

namespace App\Models;


use Core\Services\Model;

class Example extends Model
{
    protected $table = 'users';

    public  function getUser($id, $columns = []){
        return $this->find($id, $columns);
    }

}