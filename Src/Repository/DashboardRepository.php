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
        $Users = $User->getData();
        /*echo '<pre>';
        print_r($Users);
        print_r($User->getRequestsend());
        echo '</pre>';*/
    }
}