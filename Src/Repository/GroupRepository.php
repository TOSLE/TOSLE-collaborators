<?php

/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 28/06/2018
 * Time: 23:22
 */
class GroupRepository extends Group
{

    /**
     * @return array
     * Retourne le tableau SELECT pour les configForm
     */
    public function configFormGroup()
    {
        $option = [];
        foreach ($this->getGroup() as $group) {
            $option[$group->getId()] = $group->getName();
        }
        return [
            "group_select" => [
                "label" => "Selection des groupes",
                "description" => "Vous avez le droit à plusieurs choix (\"CTRL + Clic\" pour réaliser un choix multiple)",
                "multiple" => true,
                "options" => $option
            ]
        ];
    }

    /**
     * @return array
     * Retourne la liste des groupes
     */
    public function getGroup()
    {
        $target = [
            "id",
            "name",
            "fileid"
        ];
        return $this->getData($target);
    }

    /**
     * @param $_file
     * @param $_post
     * @param null $_idGroup
     * @return array|int
     * Permet de rajouter un groupe avec des utilisateurs, cette fonction est aussi utilisé pour l'edit !
     */
    public function addGroup($_file, $_post, $_idGroup = null)
    {
        $configForm = $this->configFormAdd();
        if(!$this->checkGroupExist($_post['name']) || isset($_idGroup)){
            $errors = Form::checkForm($configForm, $_post);
            $_post = Form::secureData($_post);
            if(empty($errors)){
                $file = null;
                if(isset($_file)){
                    $errors = Form::checkFiles($_file);
                    if(empty($errors) || is_numeric($errors)){
                        if( $errors != 1) {
                            $File = new FileRepository();
                            $arrayFile = $File->addFile($_FILES, $configForm, "Group/Avatar", "File attach to group");
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
                if(isset($_idGroup)) {
                    $this->setId($_idGroup);
                    $this->deleteUserGroup();
                }
                if(!$this->checkGroupExist($_post['name'])){
                    $this->setName($_post['name']);
                }
                $this->setFileid($file);
                $this->save();
                $this->getGroupByName($_post['name']);

                if(isset($_post["select_users"]) && !empty($_post["select_users"]))
                {
                    foreach($_post["select_users"] as $user) {
                        $this->addUserGroup($this->getId(), $user);
                    }
                }
                return 1;
            }
            return $errors;
        } else {
            return ['Group exist' => "Le groupe existe déjà"];
        }
    }

    public function deleteUserGroup($_idUser = null)
    {
        if(isset($_idUser) && is_numeric($_idUser)) {
            $UserGroup = new UserGroup();
            $parameter = [
                'LIKE' => [
                    'groupid' => $this->id,
                    'userid' => $_idUser,
                ]
            ];
            $UserGroup->setWhereParameter($parameter);
            $UserGroup->delete();
        } else {
            $UserGroup = new UserGroup();
            $parameter = [
                'LIKE' => [
                    'groupid' => $this->id
                ]
            ];
            $UserGroup->setWhereParameter($parameter);
            $UserGroup->delete();
        }
    }

    /**
     * @param $_idGroup
     * @return int
     * Compte le nombre d'utilisateur dans un groupe
     */
    public function countUserGroup($_idGroup)
    {
        $UserGroup = new UserGroup();
        $parameter = [
            'LIKE' => [
                'groupid' => $_idGroup
            ]
        ];
        $UserGroup->setWhereParameter($parameter);
        return $UserGroup->countData(['id']);
    }

    /**
     * @param $_name
     * @return bool
     * Vérifie si un groupe existe par son nom
     */
    public function checkGroupExist($_name)
    {
        $parameter = [
            'LIKE' => [
                'name' => $_name
            ]
        ];
        $this->setWhereParameter($parameter);
        if($this->countData() > 0){
            return true;
        }
        return false;
    }

    /***
     * @param $_name
     * Recherche un groupe par son nom, qui est unique
     */
    public function getGroupByName($_name)
    {
        $parameter = [
            'LIKE' => [
                'name' => $_name
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData();
    }
    /**
     * @param $_idUser
     * @param $_idGroup
     * Insert un utilisateur dans un groupe
     */
    public function addUserGroup($_idGroup, $_idUser)
    {
        $UserGroup = new UserGroup();
        $UserGroup->setGroupId($_idGroup);
        $UserGroup->setUserId($_idUser);
        $UserGroup->save();
    }

    /**
     * @param $_id
     * @return array
     * Génère le tableau utiliser par un autre fonction pour affecter le "selected" sur les
     */
    public function getUserForSelect($_id)
    {
        $User = new UserRepository();
        $target = ["id", "firstname" , "lastname"];
        $joinParameter = [
            "usergroup" => [
                "user_id"
            ]
        ];
        $whereParameter = [
            "usergroup" => [
                "group_id" => $_id
            ]
        ];
        $User->setLeftJoin($joinParameter, $whereParameter);
        $array = $User->getData($target);
        $returnArrayId= [];
        foreach($array as $user) {
            $returnArrayId[$user->getId()] = $user->getLastname(). ' ' . $user->getFirstname();
        }
        return $returnArrayId;
    }


    /**
     * @return array
     */
    public function getGroupManage()
    {
        $routes = Access::getSlugsById();
        if(!empty($this->id)){
            $users = $this->getUsersGroup($this->id);
            $Table = new DashboardTable('group-users', 'Liste des utilisateurs du groupe : '.$this->name, 12);
            $Table->setTableHeader("text", "Nom");
            $Table->setTableHeader("text", "Prénom");
            $Table->setTableHeader("text", "Email");
            $Table->setTableHeader("date", "Action");

            if(isset($users) && !empty($users)){
                foreach($users as $user){
                    $Table->setColumnBody('text', $user->getLastname());
                    $Table->setColumnBody('text', $user->getFirstname());
                    $Table->setColumnBody('text', $user->getEmail());

                    $Table->setValueButton('Supprimer du groupe');
                    $Table->setActionButton($routes['group/unset'].'/'.$this->id.'/'.$user->getId());
                    $Table->setColorButton("red");
                    $Table->setConfirmButton('Voulez-vous vraiment supprimer cet utilisateur : '.$user->getLastname().' '.$user->getFirstname().' du groupe ?');
                    $Table->saveButton();
                    $Table->saveTrBody();
                }
            }

            return $Table->getArrayPHP();
        }
        return ['NO_GROUP' => 'Aucun groupe renseigné'];
    }

    /**
     * @param $_id
     * @return array
     * Récupère la liste des utilisateurs en fonction de l'id d'un groupe
     */
    public function getUsersGroup($_id)
    {
        $User = new UserRepository();
        $target = [
            'id',
            'lastname',
            'firstname',
            'email',
        ];
        $joinParameter = [
            'usergroup' => [
                'user_id'
            ]
        ];
        $whereParameter = [
            'usergroup' => [
                'group_id' => $_id
            ]
        ];
        $User->setLeftJoin($joinParameter, $whereParameter);
        return $User->getData($target);
    }

    /**
     * @param $_id
     * @return array
     * Récupère les groupes d'un utilisateurs
     */
    public function getGroupsUser($_id)
    {
        $target = [
            'id',
            'name'
        ];
        $joinParameter = [
            'usergroup' => [
                'group_id'
            ]
        ];
        $whereParameter = [
            'usergroup' => [
                'user_id' => $_id
            ]
        ];
        $this->setLeftJoin($joinParameter, $whereParameter);
        return $this->getData($target);
    }

    /**
     * @param $_idUser
     * @return array
     * Retourne le tableau de mangement d'un utilisateur et ses groupes
     */
    public function getUserManage($_idUser)
    {
        $routes = Access::getSlugsById();
        $User = new UserRepository($_idUser);
        $groups = $this->getGroupsUser($_idUser);
        $Table = new DashboardTable('group-users', 'Liste des groupes de : '.$User->getLastname(). ' ' . $User->getFirstName(), 12);
        $Table->setTableHeader("text", "Nom du groupe");
        $Table->setTableHeader("date", "Action");

        if(isset($groups) && !empty($groups)){
            foreach($groups as $group){
                $Table->setColumnBody('text', $group->getName());
                $Table->setValueButton('Supprimer du groupe');
                $Table->setActionButton($routes['group/gunset'].'/'.$group->getId().'/'.$User->getId());
                $Table->setColorButton("red");
                $Table->setConfirmButton('Voulez-vous vraiment supprimer cet utilisateur : '.$User->getLastname().' '.$User->getFirstname().' du groupe ?');
                $Table->saveButton();
                $Table->saveTrBody();
            }
        }

        return $Table->getArrayPHP();
    }
}