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
        $User->setPassword("Testmdp01");

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
                $User->setPassword($params["POST"]["pwd"]);
                $target = [
                    "password"
                ];
                $parameter = [
                    "email" => $params["POST"]["email"]
                ];
                $User->selectSimpleResponse($target, $parameter);
                if(password_verify($params["POST"]["pwd"], $User->getPassword())){
                    $target = [
                        "email",
                        "token"
                    ];
                    $parameter = [
                        "email" => $params["POST"]["email"],
                        "password" => $User->getPassword()
                    ];
                    $User->selectSimpleResponse($target, $parameter);
                    if(!(empty($User->getToken()) && empty($User->getEmail()))){
                        $_SESSION['token'] = $User->getToken();
                        $_SESSION['email'] = $User->getEmail();
                        header("Location:".DIRNAME);
                    }

                }
            }
        }
        $View = new View("user", "User/connect");
        $View->setData("config", $form);
        $View->setData("errors", $errors);
    }

    public function registerAction($params) {

        $User = new User();
        $form = $User->configFormAdd();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $User->setFirstName($params["POST"]["firstname"]);
                $User->setLastName($params["POST"]["lastname"]);
                $User->setEmail($params["POST"]["email"]); // voir pour le selectMultipleResponse + confirmEmail
                $User->setEmail($params["POST"]["emailConfirm"]);
                $User->setPassword($params["POST"]["pwd"]);
                $User->setPassword($params["POST"]["pwdConfirm"]);
                $User->setBirthDay($params["POST"]["birthday"]);
                $target = [
                    "firstname",
                    "lastname",
                    "email",
                    "emailConfirm",
                    "pwd",
                    "pwdConfirm",
                    "birthday"
                ];
                if(!empty($User->getToken())){
                    $_SESSION['token'] = $User->getToken();
                }
            }
        }
        $View = new View("user", "User/register");
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