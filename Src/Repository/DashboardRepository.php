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
        $arrayForJson['config']['action'] = null;
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
                $tmpArray['lastname'] = $user->getLastname();
                $tmpArray['email'] = $user->getEmail();
                $tmpArray['dateInscription'] = $user->getDateinscription();
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

    public function getAllGroups()
    {
        $Group = new GroupRepository();

    }
}