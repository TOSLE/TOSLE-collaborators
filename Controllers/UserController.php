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
        $user = new User();

        //$user->setId();
        $user->setEmail('domangejulien@gmail.com');
        $user->setToken();
        $user->setFirstName('Julien');
        $user->setLastName("DOMANGE");
        $user->setPassword("Testmdp01");

        $user->save();
    }

    public function connectAction($params)
    {
        $user = new User();
        $form = $user->configFormConnect();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $user->setPassword($params["POST"]["pwd"]);
                $target = [
                    "password"
                ];
                $parameter = [
                    "email" => $params["POST"]["email"]
                ];
                $user->selectSimpleResponse($target, $parameter);
                if(password_verify($params["POST"]["pwd"], $user->getPassword())){
                    $target = [
                        "email",
                        "token"
                    ];
                    $parameter = [
                        "email" => $params["POST"]["email"],
                        "password" => $user->getPassword()
                    ];
                    $user->selectSimpleResponse($target, $parameter);
                    if(!(empty($user->getToken()) && empty($user->getEmail()))){
                        $_SESSION['token'] = $user->getToken();
                        $_SESSION['email'] = $user->getEmail();
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
        echo "Register action";

        $user = new User();
        $form = $user->configFormAdd();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Validate::checkForm($form, $params["POST"]);
            if (empty($errors)) {
                $user->setFirstName($params["POST"]["firstname"]);
                $user->setLastName($params["POST"]["lastname"]);
                $user->setEmail($params["POST"]["email"]); // voir pour le selectMultipleResponse + confirmEmail
                $user->setEmail($params["POST"]["emailConfirm"]);
                $user->setPassword($params["POST"]["pwd"]);
                $user->setPassword($params["POST"]["pwdConfirm"]);
                $user->setToken();
                $user->save();

                $email = $params["POST"]["email"];
                $firstName = $params["POST"]["firstname"];
                $lastName = $params["POST"]["lastname"];
                $token = $user->getToken();

                Mail::sendMailRegister($email, $firstName, $lastName,$token);
            }

        }
        $View = new View("user", "User/register");
        $View->setData("config", $form);
        $View->setData("errors", $errors);

    }

    public function verifyAction($params) {
        if(isset($params["GET"]["email"]) && isset($params["GET"]["token"])){
            $User = new User();

            $target = [ /** Ce que l'on récupère lors de la requête (SELECT) **/
                "id"
            ];
            $parameter = [ /** Les parametres pour la condition de la requête **/
                "email" => $params["GET"]["email"],
                "token" => $params["GET"]["token"]
            ];
            $User->selectSimpleResponse($target, $parameter);
            if($User->getId()){
                $User->setToken();
                $User->save();
                //redirection success
            } else {
                //redirection false
            }
        }
    }

    public function disconnectAction($params)
    {
        header("Location:".DIRNAME);
        $_SESSION["token"]=null;
        $_SESSION["email"]=null;
    }
}