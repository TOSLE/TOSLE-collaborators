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
            return null;
        }
        $User->setToken();
        $User->setDateConnection();
        $User->save();
        $_SESSION["token"]=$User->getToken();
        $_SESSION["email"]=$User->getEmail();
        return true;
    }
    public static function getUser($token, $email)
    {
        $target=[
            'id',
            'status',
            'lastname',
            'firstname',
            'newsletter'
        ];
        $User = new User();
        $User->setWhereParameter(["LIKE" => [
            'token' => $token,
            'email' => $email
        ]]);
        $User->getOneData($target);
        $arrayTmp = [];
        $arrayTmp['id'] = $User->getId();
        $arrayTmp['status'] = $User->getStatus();
        $arrayTmp['lastname'] = $User->getLastName();
        $arrayTmp['firstname'] = $User->getFirstName();
        $arrayTmp['newsletter'] = $User->getNewsletter();
        $stringSession = json_encode($arrayTmp, JSON_FORCE_OBJECT);
        $_SESSION['auth'] = $stringSession;
    }
}