<?php 

namespace app\database;

use PDO;

class Connect{
    public static function connect(){
        return new PDO('mysql:host=localhost;dbname=logingoogle','root','7654321', [PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ]);
    }
}