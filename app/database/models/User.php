<?php

namespace app\database\models;

use app\database\Connect;

class User extends Model
{
    protected string $table = 'users';

    public function insert(array $data)
    {
        try {
            $connect = Connect::connect();
            $prepare = $connect->prepare("insert into $this->table(firstName,lastName,email) values(:firstName,:lastName,:email)");

            return $prepare->execute($data);
        } catch (\PDOException $th) {
            var_dump($th->getMessage());
        }
    }
}