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
        $target=['id', 'token', 'email', 'dateconnection'];
        $User->setWhereParameter(["LIKE" => [
            'token' => $token,
            'email' => $email
        ]]);
        $User->getOneData($target);
        if(empty($User->getToken())){
            session_destroy();
            return null;
        }
        $date = new DateTime();
        $dateCompare = new DateTime($User->getDateconnection());
        $interval = $date->diff($dateCompare);
        if($interval->i > 30){
            session_destroy();
            return -1;
        }
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
        $User = new User();
        $User->setWhereParameter(["LIKE" => [
            'token' => $token,
            'email' => $email
        ]]);
        $User->getOneData($target);
        return intval($User->getStatus());
    }
}