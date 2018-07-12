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
        $arrayForJson = [];
        $arrayForJson['config']['col'] = 12;
        $arrayForJson['config']['idBloc'] = "bloc-users";
        $arrayForJson['config']['title'] = "Liste des utilisateurs";
        $arrayForJson['config']['action']['add'] = null;
        $arrayForJson['table']['header'] = [
            [
                "text" => "Nom",
            ],
            [
                "text" => "Prénom",
            ],
            [
                "text" => "Email",
            ],
            [
                "date" => "Inscription",
            ],
            [
                "action" => "Action",
            ],
        ];
        if(isset($users) && !empty($users)){
            foreach($users as $user){
                $arrayForJson['table']['body'][] = [
                    [
                        "text" => $user->getLastname()
                    ],
                    [
                        "text" => $user->getFirstname()
                    ],
                    [
                        "text" => $user->getEmail()
                    ],
                    [
                        "date" => $user->getDateinscription()
                    ],
                    [
                        "button" => [
                            [
                                "value" => "Supprimer",
                                "action" => $this->routes['user/delete'].'/'.$user->getId(),
                                "color" => "red",
                                "confirm" => true
                            ],
                            [
                                "value" => "Groupes",
                                "action" => $this->routes['user/group'].'/'.$user->getId(),
                                "color" => "tosle"
                            ],
                        ]
                    ],
                ];
            }
        }

        return $arrayForJson;
    }

    /**
     * @return array
     * Récupère la liste des groupes et permet la création d'un tableau pour l'affichage
     */
    public function getAllGroups()
    {
        $Group = new GroupRepository();
        $groups = $Group->getGroup();
        $arrayForJson = [];
        $arrayForJson['config']['col'] = 12;
        $arrayForJson['config']['idBloc'] = "bloc-users";
        $arrayForJson['config']['title'] = "Liste des groupes";
        $arrayForJson['config']['action']['add'] = "addGroupModal";
        $arrayForJson['table']['header'] = [
            [
                "text" => "Avatar",
            ],
            [
                "text" => "Nom",
            ],
            [
                "number" => "Nombre d'utilisateur",
            ],
            [
                "action" => "Action",
            ],
        ];
        if(isset($groups) && !empty($groups)){
            foreach($groups as $group){
                $filePath = "";
                if(!empty($group->getFileid())){
                    $filePath = $group->getFileid()->getPath().'/'.$group->getFileid()->getName();
                }
                $arrayForJson['table']['body'][] = [
                    [
                        "avatar" => $filePath
                    ],
                    [
                        "text" => $group->getName()
                    ],
                    [
                        "number" => $Group->countUserGroup($group->getId())
                    ],
                    [
                        "button" => [
                            [
                                "value" => "Supprimer",
                                "action" => $this->routes['group/delete'].'/'.$group->getId(),
                                "color" => "red",
                                "confirm" => true
                            ],
                            [
                                "value" => "Modifier",
                                "action" => $this->routes['group/edit'].'/'.$group->getId(),
                                "color" => "orange"
                            ],
                            [
                                "value" => "Utilisateurs",
                                "action" => $this->routes['group/manage'].'/'.$group->getId(),
                                "color" => "tosle"
                            ],
                        ]
                    ],
                ];
            }
        }

        return $arrayForJson;
    }
}