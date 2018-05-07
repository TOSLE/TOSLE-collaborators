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

        $User->getOneData($target, $parameterLike);
        if(empty($User->getToken())){
            session_destroy();
            return null;
        }
        $date = new DateTime();

        $User->setToken();
        $User->setDateConnection($date->getTimestamp());
        $User->save();

        $_SESSION["token"]=$User->getToken();
        $_SESSION["email"]=$User->getEmail();
        return true;
    }

    public static function getUserStatus($token, $email)
    {
        $target=[
            'status'
        ];
        $parameterLike=[
            'token' => $token,
            'email' => $email
        ];
        $User = new User();
        $User->getOneData($target, $parameterLike);
        return intval($User->getStatus());
    }
}