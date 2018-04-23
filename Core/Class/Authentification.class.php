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
        $target=['id', 'token', 'email', 'status'];
        $parameterLike=['token' => $token, 'email' => $email];

        $User->selectSimpleResponse($target, $parameterLike);
        if(empty($User->getToken()) or $User->getStatus()== 0){
            session_destroy();
            return false;
        }
        $date = new DateTime();

        $User->setToken();
        $User->setDateConnection($date->getTimestamp());
        $User->save();

        $_SESSION["token"]=$User->getToken();
        $_SESSION["email"]=$User->getEmail();
        return $User->getStatus();
    }
}