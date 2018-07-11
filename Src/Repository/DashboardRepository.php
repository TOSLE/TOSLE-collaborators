<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 11/07/2018
 * Time: 19:04
 */

class DashboardRepository
{
    public function getAllUsers()
    {
        $User = new UserRepository();
        $parameter = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $User->setWhereParameter($parameter);
        $users = $User->getData();
        $arrayForJson = [];
        $tmpArray = [];
        foreach($users as $user){
            $tmpArray['firstname'] = $user->getFirstname();
            $tmpArray['lastname'] = $user->getLastname();
            $tmpArray['email'] = $user->getEmail();
            $tmpArray['dateInscription'] = $user->getDateinscription();
            $arrayForJson[] = $tmpArray;
        }
        echo '<pre>';
        print_r($arrayForJson);
        echo '</pre>';
    }
}