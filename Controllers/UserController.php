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

        $User->setEmail('domangejulien@gmail.com');
        $User->setToken();
        $User->setFirstName('Julien');
        $User->setLastName("DOMANGE");

        $user->save();
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
                    "LIKE" => [
                        "email" => $params["POST"]["email"]
                    ]
                ];
                $User->setWhereParameter($parameter);
                $User->getOneData($target);
                if(password_verify($params["POST"]["pwd"], $User->getPassword())){
                    $target = [
                        "id",
                        "email",
                        "token"
                    ];
                    $parameter = [
                        "LIKE" => [
                            "email" => $params["POST"]["email"],
                            "password" => $User->getPassword()
                        ]
                    ];
                    $User->setWhereParameter($parameter);
                    $User->getOneData($target);
                    if(!(empty($User->getToken()) && empty($User->getEmail()))){
                        $date = new DateTime();
                        $User->setDateconnection($date->getTimestamp());
                        $User->setToken();
                        $User->save();
                        $_SESSION['token'] = $User->getToken();
                        $_SESSION['email'] = $User->getEmail();
                        header("Location:".DIRNAME);
                    }
                }
            }
        }
        $View = new View("user", "User/connect");
        if(isset($params['URI'][0])){ // message de confirmation après l'inscription
            if($params['URI'][0] == 'confirmed'){
                $View->setData('textConfirm', 'Accès confirmé');
            }
        }
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

                Mail::sendMailRegister($email, $firstName, $lastName, $token);
            }

        }
        $View = new View("user", "User/register");
        $View->setData("config", $form);
        $View->setData("errors", $errors);

    }

    public function verifyAction($params)
    {
        $Access = new Access();
        $redirection = $Access->getSlugs();

        if (isset($params["GET"]["email"]) && isset($params["GET"]["token"])) {
            $User = new User();

            $target = [/** Ce que l'on récupère lors de la requête (SELECT) **/
                "id"
            ];
            $parameter = [/** Les parametres pour la condition de la requête **/
                "LIKE" => [
                    "email" => $params["GET"]["email"],
                    "token" => $params["GET"]["token"]
                ]
            ];
            $User->setWhereParameter($parameter, null);
            $User->getOneData($target);
            if (!empty($User->getId())) {
                $User->setToken();
                $User->setStatus(1);
                $User->save();

                //blogcontroller

                $messConfirm = 'Inscription confirmé, vous pouvez vous connectez dès maintenant';
                header('Location:'.$redirection["signin"].'?textConfirm='.$messConfirm);
            } else {
                $messError = 'Inscription echoué, veuillez reesayer de vous inscrire.';
                header('Location:'.$redirection["signup"].'?$infoSignup='.$messError);
            }
        }
    }

    public function disconnectAction($params)
    {
        header("Location:" . DIRNAME);
        $_SESSION["token"] = null;
        $_SESSION["email"] = null;
    }
}