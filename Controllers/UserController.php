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

        $User->setEmail('domangejulien@gmail.com');
        $User->setToken();
        $User->setFirstName('Julien');
        $User->setLastName("DOMANGE");

        $User->save();
    }

    public function connectAction($params)
    {
        $User = new User();
        $form = $User->configFormConnect();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $target = [
                    "password"
                ];
                $parameter = [
                    "email" => $params["POST"]["email"]
                ];
                $User->getOneData($target, $parameter);
                if(password_verify($params["POST"]["pwd"], $User->getPassword())){
                    $target = [
                        "email",
                        "token"
                    ];
                    $parameter = [
                        "email" => $params["POST"]["email"],
                        "password" => $User->getPassword()
                    ];
                    $User->getOneData($target, $parameter);
                    if(!(empty($User->getToken()) && empty($User->getEmail()))){
                        $_SESSION['token'] = $User->getToken();
                        $_SESSION['email'] = $User->getEmail();
                        header("Location:".DIRNAME);
                    }

                }
            }
        }
        $View = new View("user", "UserTPL/connect");
        $View->setData("config", $form);
        $View->setData("errors", $errors);
    }

    public function disconnectAction($params)
    {
        header("Location:".DIRNAME);
        $_SESSION["token"]=null;
        $_SESSION["email"]=null;
    }
}