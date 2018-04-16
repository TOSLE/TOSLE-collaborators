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
        $target=['id', 'token', 'email'];
        $parameterLike=['token' => $token, 'email' => $email];

        $User->selectAnd($target, $parameterLike);
        if(empty($User->getToken())){
            session_destroy();
            return false;
        }
        $date = new DateTime();

        $User->setToken();
        $User->setDateConnection($date->getTimestamp());
        $User->save();

        $_SESSION["token"]=$User->getToken();
        $_SESSION["email"]=$User->getEmail();
        return true;
    }
}