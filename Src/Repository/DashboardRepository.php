<?php
/**
 * Created by PhpStorm.
 * User: backin
 * Date: 11/07/2018
 * Time: 19:04
 */

class DashboardRepository
{
    public function getAllUsers()
    {
        $Routes = Access::getSlugsById();
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
                                "action" => $Routes['user/delete'].'/'.$user->getId(),
                                "color" => "red",
                                "confirm" => true
                            ],
                            [
                                "value" => "Groupes",
                                "action" => $Routes['user/group'].'/'.$user->getId(),
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
/*
array : {
    'config' : {
        'col' : '6',
		'title' : 'titre'
	},
	'table' : {
        'header' : {
            0 : {
                'class' : 'nom'
			},
			1 : {
                'class' : 'nom'
			},
			2 : {
                'class' : 'nom'
			},
			3 : {
                'class' : 'nom'
			}
		},
		'body' : {
            0 : {
                'text' : 'content'
			},
			1 : {
                'button' : {
                    0 : {
                        'acton' : 'content'
					}
				}
			}
		}
	}
}*/