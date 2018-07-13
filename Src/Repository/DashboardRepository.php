<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 11/07/2018
 * Time: 19:04
 */

class DashboardRepository
{
    private $routes = null;

    /**
     * DashboardRepository constructor.
     * Initialise les variables du Repository
     */
    public function __construct()
    {
        $this->routes = Access::getSlugsById();
    }

    /**
     * @return array
     * Cette fonction retourne un tableau permettant la création du Dashboard bloc des utilisateurs
     */
    public function getAllUsers()
    {
        $User = new UserRepository();
        $parameter = [
            'LIKE' => [
                'status' => 1
            ]
        ];
        $User->setWhereParameter($parameter);
        $User->setOrderByParameter(['lastname' => 'ASC']);
        $users = $User->getData();
        $Table = new DashboardTable('bloc-users', 'Liste des utilisateurs', 12);
        $Table->setTableHeader("text", "Nom");
        $Table->setTableHeader("text", "Prénom");
        $Table->setTableHeader("text", "Email");
        $Table->setTableHeader("date", "Inscription");
        $Table->setTableHeader("date", "Action");

        if(isset($users) && !empty($users)){
            foreach($users as $user){
                $Table->setColumnBody('text', $user->getLastname());
                $Table->setColumnBody('text', $user->getFirstname());
                $Table->setColumnBody('text', $user->getEmail());
                $Table->setColumnBody('date', $user->getDateinscription());

                $Table->setValueButton('Supprimer');
                $Table->setActionButton($this->routes['user/delete'].'/'.$user->getId());
                $Table->setColorButton("red");
                $Table->setConfirmButton('Voulez-vous vraiment supprimer ce groupe : '.$user->getLastname().' '.$user->getFirstname().' ?');
                $Table->saveButton();

                $Table->setValueButton('Groupes');
                $Table->setActionButton($this->routes['user/group'].'/'.$user->getId());
                $Table->setColorButton("tosle");
                $Table->saveButton();
                $Table->saveTrBody();
            }
        }

        return $Table->getArrayPHP();;
    }

    /**
     * @return array
     * Récupère la liste des groupes et permet la création d'un tableau pour l'affichage
     */
    public function getAllGroups()
    {
        $Group = new GroupRepository();
        $groups = $Group->getGroup();
        $Table = new DashboardTable('bloc-groups', 'Liste des groupes', 12);
        $Table->setAction('add', 'addGroupModal');
        $Table->setTableHeader("text", "Avatar");
        $Table->setTableHeader("text", "Nom");
        $Table->setTableHeader("text", "Nombre d'utilisateur");
        $Table->setTableHeader("date", "Action");

        if(isset($groups) && !empty($groups)){
            foreach($groups as $group){
                $filePath = "";
                if(!empty($group->getFileid())){
                    $filePath = $group->getFileid()->getPath().'/'.$group->getFileid()->getName();
                }
                $Table->setColumnBody('avatar', $filePath);
                $Table->setColumnBody('text', $group->getName());
                $Table->setColumnBody('number', $Group->countUserGroup($group->getId()));

                $Table->setValueButton('Supprimer');
                $Table->setActionButton($this->routes['group/delete'].'/'.$group->getId());
                $Table->setColorButton("red");
                $Table->setConfirmButton('Voulez-vous vraiment supprimer ce groupe : '.$group->getName().' ?');
                $Table->saveButton();

                $Table->setValueButton('Modifier');
                $Table->setActionButton($this->routes['group/edit'].'/'.$group->getId());
                $Table->setColorButton("orange");
                $Table->saveButton();

                $Table->setValueButton('Utilisateurs');
                $Table->setActionButton($this->routes['group/manage'].'/'.$group->getId());
                $Table->setColorButton("tosle");
                $Table->saveButton();
                $Table->saveTrBody();
            }
        }

        return $Table->getArrayPHP();
    }
}