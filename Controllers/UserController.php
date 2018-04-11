<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 11/04/2018
 * Time: 23:32
 */

class UserController
{
    public function indexAction($params)
    {
        echo "nothing";
    }

    public function addAction($params)
    {
        $User = new User();

        $User->setId(1);
        $User->setEmail('domangejulien@gmail.com');
        $User->setToken();
        $User->setFirstName('Julien');
        $User->setLastName("DOMANGE");

        $User->save();
    }
}