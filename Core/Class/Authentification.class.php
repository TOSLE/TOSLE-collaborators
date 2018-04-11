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
        $target=['id', 'pseudo', 'firstname', 'lastname', 'email', 'age'];
        $parameterLike=['token' => $token, 'email' => $email];
        return $User->selectAnd($target, $parameterLike);
    }
}