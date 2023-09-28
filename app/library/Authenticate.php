<?php
namespace app\library;

use app\database\models\User;

class Authenticate{

    public function authGoogle($data){
        $user = new User;
        $userFound = $user->findBy('email', $data->email);
        if(!$userFound){
            $user->insert([
                'firstName' => $data->givenName,
                'lastName' => $data->familyName,
                'email' => $data->email,
            ]);
        }

        $_SESSION['user'] = $userFound;
        $_SESSION['auth'] = true;
        header('Location:/');

    }

    public function auth(){}



}