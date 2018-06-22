<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 15/05/2018
 * Time: 11:51
 */

class UserRepository extends User
{

    /**
     * @param string $password
     * @param string $email
     * @return integer int
     * verrifyUserLogin va permettre de vérifier l'identification de l'utilisateur grâce au mot de passe et l'email en deux étapes
     */
    function verrifyUserLogin($password, $email)
    {
        $parameter = [
            "LIKE" => [
                "email" => $email
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData(["password"]);
        if(!empty($this->password)){
            if(password_verify($password, $this->password)){
                $target = [
                    "id",
                    "email",
                    "token",
                    "status"
                ];
                $parameter = [
                    "LIKE" => [
                        "email" => $email,
                        "password" => $this->password
                    ]
                ];
                $this->setWhereParameter($parameter);
                $this->getOneData($target);
                if(!empty($this->token) && !empty($this->email)){

                    if(empty($this->status))
                    {
                        return [AUTHENTIFICATION_FAILED_KEY => "Vous n'avez pas valider votre compte"];
                    }
                    else{
                        $dateSetter = new DateTime();
                        $this->setDateconnection($dateSetter->getTimestamp());
                        $this->setToken();
                        $this->save();
                        $_SESSION['token'] = $this->token;
                        $_SESSION['email'] = $this->email;
                        return 1;
                    }
                }
            } else {
                return [AUTHENTIFICATION_FAILED_KEY => AUTHENTIFICATION_FAILED_MESSAGE];
            }
        } else {
           return [AUTHENTIFICATION_FAILED_KEY => AUTHENTIFICATION_FAILED_MESSAGE];
        }
    }
    function verrifyAuthentificationSession()
    {

    }
     function checkEmailExist($email)
    {
        $target = ["email"];
        $parameter = [
            "LIKE" => [
                "email" => $_SESSION["email"]
            ]
        ];    
       $entree=$email;

        $tableau=$this->getData($target);
     //   echo '<pre>',print_r($tableau),'</pre>';

        foreach ($tableau as $cle) {
            $result =  $cle->getEmail();
        //   echo $entree.'<br>';
       //    echo $result.'<br>';
        //    echo $target;
            if($result == $entree)
            {
                //echo "problem";
                return [AUTHENTIFICATION_FAILED_KEY => "Mail déjà utilisé"];
                //return [AUTHENTIFICATION_FAILED_KEY => "Vous n'avez pas valider votre compte"];
            }
            else{
                return 1;
            }
          //  echo $email->getEmail().'<br>';
        }
        /*if(in_array($target,$tableau)){
                 echo "coco";       
        }  */     
        die();

    }
    

    public function getUser()
    {
        $target = ["id"];
        $parameter = [
            "LIKE" => [
                "token" => $_SESSION["token"],
                "email" => $_SESSION["email"]
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }
}