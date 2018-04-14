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

    public function connectAction($params)
    {
        if(!Authentification::checkAuthentification($params['GET']['token'], $params['GET']['email'])){
            echo "<p>Connection failed on connect Action</p>";

        } else {
            header("location:".DIRNAME);
        }
    }

    public function disconnectAction($params)
    {
        header("Location:".DIRNAME);
        $_SESSION["token"]=null;
        $_SESSION["email"]=null;
    }
}