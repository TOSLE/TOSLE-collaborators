<?php
/**
 * Created by PhpStorm.
 * User: Mehdi ABKHOUKH
 * Date: 03/07/2018
 * Time: 18:11
 */

class ProfileRepository extends User
{
    /**
     * @param $token token de la session en cours
     * @param $email email de la session en cours
     * @return array des informations utilisateurs
     */
    public function getInfoUser($token, $email) {
        $User = new UserRepository();
        $User->getUserBySession($token, $email);
        return [
            "firstname" => $User->getFirstName(),
            "lastname" => $User->getLastName(),
            "email" => $User->getEmail(),
            "newsletter" => $User->getNewsletter(),
        ];
    }

    public function getCommentUser($_idUser) {
        $User = new UserRepository();
        $Comment = new CommentRepository();







    }
}