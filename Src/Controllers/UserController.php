<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 11/04/2018
 * Time: 23:32
 */

class UserController extends CoreController
{
    public function indexAction($params)
    {
        echo "nothing";
    }

    public function connectAction($params)
    {
        $User = new UserRepository();
        $form = $User->configFormConnect();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Form::checkForm($form, $params["POST"]);
            if(empty($errors)){
                if(isset($params["POST"]["email"]) && isset($params["POST"]["pwd"])){
                    $returnValue=$User->verrifyUserLogin($params["POST"]["pwd"], $params["POST"]["email"]);
                    if(is_numeric($returnValue)){                                             
                            header("Location:" . DIRNAME);                        
                    } else {
                        $errors=$returnValue;                                                
                    }
                }
            }
        }
        $View = new View("user", "User/connect");
        $registerMessage = "";
        if(isset($params['URI'][0])){ // message de confirmation après l'inscription
            if($params['URI'][0] == 'confirmed'){
                $registerMessage = 'Accès confirmé';
            }
        }
        if(isset($params['URI'][0])){ // message de confirmation après l'inscription
            if($params['URI'][0] == 'registered'){
                $registerMessage = 'Inscription réussie, à présent, veuillez confirmer votre inscription pour valider votre adresse email.';
            }
             if($params['URI'][0] == 'passchanged'){
                $registerMessage = 'Mot de passe modifié avec succès';
            }
        }
     //   $errors["error status"]=" status invalide";
        $View->setData('textConfirm', $registerMessage);
        $View->setData("config", $form);
        $View->setData("errors", $errors);
    }

    public function registerAction($params) {
        $user = new UserRepository();

        $form = $user->configFormAdd();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Form::checkForm($form, $params["POST"]);
            $retourValue=$user->checkEmailExist($params["POST"]["email"]);

               if(is_numeric($retourValue)){     
                     $user->setEmail($params["POST"]["email"]);                             
                    } 
                else {
                        $errors=$retourValue;                                                
                    }

            if (empty($errors)) {
                $user->setFirstName($params["POST"]["firstname"]);
                $user->setLastName($params["POST"]["lastname"]);
                $user->checkEmailExist($params["POST"]["email"]);
               //print_r($retourValue);
                //die();
             
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
                header('Location:'.Access::getSlugsById()['signin'].'/registered');
            } else {
                $form["data_content"] = [
                    "email" => $params["POST"]["email"],
                    "firstname" => $params["POST"]["firstname"],
                    "lastname" => $params["POST"]["lastname"],
                ];
            }
        }
        $View = new View("user", "User/register");
        $registerMessage = "";
        if(isset($params['URI'][0])){ // message de confirmation après l'inscription
            if($params['URI'][0] == 'error'){
                $registerMessage = REGISTER_FAILED_MESSAGE;
            }
        }
        $View->setData('infoSignup', $registerMessage);
        $View->setData("config", $form);
        $View->setData("errors", $errors);

    }

    /**
     * @param $params
     * Verification
     */
    public function verifyAction($params)
    {
        $routes = Access::getSlugsById();

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
                header('Location:'.$routes["signin"].'/confirmed');
            } else {
                $messError = 'Inscription echoué, veuillez reesayer de vous inscrire.';
               
                header('Location:'.$routes["signup"].'/error');
            }
        }
    }

    public function getpasswordAction($params)
    {        
        $View = new View("default", "User/newpassword");
        $user = new UserRepository();
        $form = $user->passwordFormAdd();
        $errors = [];
        if(!empty($params["POST"])) {
            $errors = Form::checkForm($form, $params["POST"]);
            if (empty($errors)) {
              /*  $user->checkEmailExist($params["POST"]["email"]);
                $retourValue=$user->checkEmailExist($params["POST"]["email"]);
                if(is_numeric($retourValue)){     
                    echo "testt";*/

                     $target = [/** Ce que l'on récupère lors de la requête (SELECT) **/
                        "id",
                        "token"
                    ];
                    $parameter = [/** Les parametres pour la condition de la requête **/
                        "LIKE" => [
                            "email" => $params["POST"]["email"],
                        ]
                    ];
                    $user->setWhereParameter($parameter, null);
                    $user->getOneData($target);

                    $user->setEmail($params["POST"]["email"]); // voir pour le selectMultipleResponse + confirmEmail               
                    $user->setToken(); 

                    $user->save();



                  /*  } else {
                        $errors=$retourValue;                                                
                    }*/
                    $email = $params["POST"]["email"];
                    $token = $user->getToken();
              }



            Mail::sendMailPassword($email,$token); 
        }
            $View->setData("configFormEmail", $form);
            $View->setData("errors", $errors);    
    }   


    public function setnewpasswordAction($params)
    {                             
        $User = new User();
        $View = new View("default", "User/setnewpassword");
        $form = $User->setnewpasswordFormAdd();
        $errors = [];

           /* if token et mail + ajouter nom
                $param 3 tableau sl
                set password */

        if (isset($params["POST"]) & !empty($params["POST"])) {
            if (isset($params["GET"]["email"]) & isset($params["GET"]["token"])) {
                $errors = Form::checkForm($form, $params["POST"]);
                if (empty($errors)) {
                    $target = [/** Ce que l'on récupère lors de la requête (SELECT) **/
                        "id",
                        "password"
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
                        $password = $params["POST"]["pwd"];
                        $User->setPassword($password);
                        $User->save();
                        header('Location:' . Access::getSlugsById()['signin'] . '/passchanged');
                    }
                }
            } else {
                $errors["AUTHENTIFICATION FAILED"] = "Erreur d'authentification";
            }
        }
        $View->setData("configSetPassword", $form);
        $View->setData("errors", $errors);

    }
    /**
     * @param $params
     * Permet de détruire la Session d'un utilisateur
     */
    public function disconnectAction($params)
    {
        header("Location:" . DIRNAME);
        $_SESSION["token"] = null;
        $_SESSION["email"] = null;
        $_SESSION["auth"] = null;
        session_destroy();
    }

    /**
     * @param $params
     * Cette fonction permet de supprimer un utilsiateur et tout ce qui le concerne
     * La sécurité de l'action est géré par la class Access, qui attribue une sécurité de "2" pour accéder à la
     * page
     */
    public function deleteAction($params)
    {
        if(isset($params['URI'][0]) && !empty($params['URI'][0]) && is_numeric($params['URI'][0])){
            $User = new UserRepository($params['URI'][0]);
            $BlogComment = new BlogComment();
            $ChapterComment = new ChapterComment();
            $parameterTableJoin = [
                'LIKE' => [
                    'userid' => $User->getId()
                ]
            ];
            $parameter = [
                'LIKE' => [
                    'id' => $User->getId()
                ]
            ];
            $BlogComment->setWhereParameter($parameterTableJoin);
            $ChapterComment->setWhereParameter($parameterTableJoin);
            $blogcomments = $BlogComment->getData();
            $chaptercomments = $ChapterComment->getData();
            $BlogComment->setWhereParameter($parameterTableJoin);
            $ChapterComment->setWhereParameter($parameterTableJoin);
            $BlogComment->delete();
            $ChapterComment->delete();
            if(isset($blogcomments) && !empty($blogcomments)){
                foreach($blogcomments as $comment){
                    $Comment = new Comment($comment->getCommentid());
                    $parameterCommentTable = [
                        'LIKE' => [
                            'id' => $Comment->getId()
                        ]
                    ];
                    $Comment->setWhereParameter($parameterCommentTable);
                    $Comment->delete();
                }
            }
            if(isset($chaptercomments) && !empty($chaptercomments)){
                foreach($chaptercomments as $comment){
                    $Comment = new Comment($comment->getCommentid());
                    $parameterCommentTable = [
                        'LIKE' => [
                            'id' => $Comment->getId()
                        ]
                    ];
                    $Comment->setWhereParameter($parameterCommentTable);
                    $Comment->delete();
                }
            }

            // Une fois que tout est supprimé
            $User->setWhereParameter($parameter);
            $User->delete();
        }
        header('Location:'.$this->Routes['dashboard_student']);
    }
}