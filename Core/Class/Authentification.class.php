<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 11/04/2018
 * Time: 11:35
 */

class Authentification
{
    public static function checkAuthentification($token, $email)
    {
        $User = new User();
        $target=['id', 'pseudo', 'firstname', 'lastname', 'email'];
        $parameterLike=['token' => $token, 'email' => $email];

        if(!$arrayUser = $User->selectAnd($target, $parameterLike)){
            session_destroy();
            return false;
        }
        $date = new DateTime();

        $User->setId($arrayUser['user_id']);
        $User->setToken();
        $User->setDateConnection($date->getTimestamp());
        $User->save();

        $_SESSION["token"]=$User->getToken();
        $_SESSION["email"]=$arrayUser['user_email'];
        return true;
    }
}