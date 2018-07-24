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
     * @return integer|array
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
                        $this->setToken();
                        $this->setDateconnection();
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

    /**
     * @param $email
     * @return array|int
     */
     function checkEmailExist($email)
    {
        $target = ["email"];
        /**$parameter = [
            "LIKE" => [
                "email" => $email
            ]
        ];**/
        $entree=$email;
        $tableau=$this->getData($target);
        foreach ($tableau as $cle) {
            $result =  $cle->getEmail();
            if($result == $entree)
            {
                return [AUTHENTIFICATION_FAILED_KEY => USER_PROFILE_EMAIL_EXIST];
            }
        }
        return 1;
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

    public function getUserById($_id)
    {
        $target = [
            "id",
            "firstname",
            "lastname",
            "email",
            "status",
            "fileid"
        ];
        $parameter = [
            "LIKE" => [
                "id" => $_id
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData($target);
    }

    public function getUserBySession($token, $email)
    {
        $target = [
            'firstname',
            'lastname',
            'email',
            'newsletter'
        ];
        $this->setWhereParameter(["LIKE" => [
            'token' => $token,
            'email' => $email,
        ]]);
        $this->getOneData($target);
    }

    /**
     * @return array
     * Retourne le tableau pour ajout du SELECT des utilisateurs dans un confirgForm
     */
    public function getSelectUsers()
    {
        $target = [
            'id',
            'firstname',
            'lastname'
        ];
        $parameter = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $this->setWhereParameter($parameter);
        $users = $this->getData($target);

        $option = [];
        foreach ($users as $user) {
            $option[$user->getId()] = $user->getLastname().' '.$user->getFirstname();
        }
        return [
            "select_users" => [
                "label" => "Add user",
                "description" => "You have the right to several choices (\"CTRL + Clic\" pour réaliser un choix multiple)",
                "multiple" => true,
                "options" => $option
            ]
        ];
    }

    public function addUser($_post, $_idUser = null, $_file = null)
    {
        if(isset($_file)){
            $configForm = $this->configFormEdit();
        } else {
            $configForm = $this->configFormAdd();
        }
        $errors = Form::checkForm($configForm, $_post);
        $_post = Form::secureData($_post);

        if (empty($errors)) {
            $tmpPostArray = $_post;
            if (isset($_idUser)) {
                $this->setId($_idUser);
            }
            $file = null;
            if(isset($_file)){
                $errors = Form::checkFiles($_file);
                if(empty($errors) || is_numeric($errors)){
                    if( $errors != 1) {
                        $File = new FileRepository();
                        $arrayFile = $File->addFile($_file, $configForm, "Profile/Avatar", "Avatar");
                        if(!is_numeric($arrayFile)){
                            if(array_key_exists('CODE_ERROR', $arrayFile)){
                                return $arrayFile;
                            }
                            foreach ($arrayFile as $fileId) {
                                $file = $fileId;
                            }
                        }

                    }
                } else {
                    if(!array_key_exists('EXCEPT_ERROR', $errors)){
                        return $errors;
                    }
                }
            }
            if(isset($file)){
                $this->setFileid($file);
            }
            $this->setFirstName($tmpPostArray['firstname']);
            $this->setLastName($tmpPostArray['lastname']);
            $this->setEmail($tmpPostArray['email']);
            $this->setEmail($tmpPostArray['emailConfirm']);
            $this->setPassword($tmpPostArray['pwd']);
            $this->setPassword($tmpPostArray['pwdConfirm']);
            $this->setToken();
            $this->save();

            $_SESSION['token'] = $this->getToken();
            $_SESSION['email'] = $this->getEmail();
            return 1;
        } else {
            return $errors;
        }
    }

    public function getStatUser($sort)
    {
        switch ($sort) {

            case 'year':
                $target = [
                    "dateinscription"
                ];
                $resultStatUserYear = $this->getData($target);

                $countYearUser = 0;
                if (isset($resultStatUserYear)) {
                    $currentYear = date('Y');
                    foreach ($resultStatUserYear as $row) {
                        $resultRowYear = date('Y', strtotime($row->getDateInscription()));
                        if ($resultRowYear == $currentYear)
                            $countYearUser += 1;
                    }
                }
                return $countYearUser;
                break;

            case 'month':
                $target = [
                    "dateinscription"
                ];
                $resultStatUserMonth = $this->getData($target);

                $arrayStatUserRegisteredMonth = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                if (isset($resultStatUserMonth)) {
                    $currentYear = date('Y');
                    foreach ($resultStatUserMonth as $row) {
                        if (date('Y', strtotime($row->getDateInscription())) == $currentYear) {
                            for ($i = 1; $i < 13; $i += 1) {
                                if ($i == date('m', strtotime($row->getDateInscription()))) {
                                    $arrayStatUserRegisteredMonth[$i] += 1;
                                }
                            }
                        }
                    }
                }
                return $arrayStatUserRegisteredMonth;
                break;

            case 'day':
                $target = [
                    "dateinscription"
                ];
                $resultStatUserMonth = $this->getData($target);

                $countDayUser = 0;
                if (isset($resultStatUserMonth)) {
                    $currentYear = date('Y');
                    $currentMonth = date('m');
                    foreach ($resultStatUserMonth as $row) {
                        if (date('Y', strtotime($row->getDateInscription())) == $currentYear && date('m', strtotime($row->getDateInscription())) == $currentMonth) {
                            $countDayUser +=1;
                        }
                    }
                }
                return $countDayUser;
                break;
        }
    }

    /**
     * @return array
     * Retourne le tableau pour ajout du SELECT des utilisateurs dans un confirgForm
     */
    public function getSelectSimpleUser($Auth = null)
    {
        $target = [
            'id',
            'firstname',
            'lastname'
        ];
        $parameter = [
            'LIKE' => [
                'status' => ($Auth->getStatus() > 1)?1:2
            ]
        ];
        $this->setWhereParameter($parameter);
        $users = $this->getData($target);

        $option = [];
        foreach ($users as $user) {
            if($Auth->getId() != $user->getId()){
                $option[$user->getId()] = $user->getLastname().' '.$user->getFirstname();
            }
        }
        $return['select_user'] = [
            'label' => 'Choisir un destinataire',
            'required' => false,
            'options' => $option
        ];
        return $return;
    }

    public function getAllUser() {
        $target = [
            "id"
        ];
        $parameter = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $this->setWhereParameter($parameter);
        $arrayUser = $this->getData($target);

        return count($arrayUser);
    }

    /**
     * @return int
     */
    public static function countUser()
    {
        $User = new User();
        $paramater = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $User->setWhereParameter($paramater);
        return $User->countData(['id']);
    }

    public function getAdminInfos()
    {
        $target = [
            'firstname',
            'lastname',
            'email'
        ];
        $paramater = [
            'LIKE' => [
                'status' => 2
            ]
        ];
        $this->setWhereParameter($paramater);
        $this->getOneData($target);
        return $this;
    }
}