<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 05/07/2018
 * Time: 15:19
 * Cette class permet la création des fichiers nécessaires à l'installation de TOSLE
 */


class Installer
{
    private $pwd;
    public function __construct()
    {
        $this->pwd = getcwd().'/';
    }

    /**
     * @return array|string
     * Avertit l'utilisateur si son htaccess peut potentiellement être défaillant
     */
    public function alertHtaccess()
    {
        $message[] = "";
        if(!DIRNAME == '/'){
            if(DEV_MODE){
                $message['Repertoire d\'installation'] = 'Vous êtes sur le point d\'utiliser le CMS TOSLE en mode développeur. Si ce n\'est
                pas déjà fait, faites attention à bien générer le fichier .htaccess avec le bon RewriteBase.';
            } else {
                $message['Repertoire d\'installation'] = 'Attention, le CMS TOSLE n\'est pas adapté à une utilisation sur un environnement
                 autre que LINUX. L\'Installer a détecté un problème au niveau de votre fichier \'.htaccess\'.
                  N\'hésitez pas à contacter le support si besoin.';
            }
        }
        return $message;
    }

    public function configFormInstaller()
    {
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"",
                "submit"=>"Tester ma configuration",
                "secure" => [
                    "status" => true,
                    "duration" => 1
                ],
            ],
            "input"=> [
                "dbuser"=>[
                    "type"=>"text",
                    "placeholder"=>"Database username*",
                    "required"=>true,
                    "maxString"=>30,
                    "label"=>"We do not collect this information"
                ],
                "dppwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Database password*",
                    "required"=>true,
                    "maxString"=>255,
                    "label"=>"We do not collect this information"
                ],
                "dbhost"=>[
                    "type"=>"text",
                    "placeholder"=>"Database host*",
                    "required"=>true,
                    "maxString"=>100,
                    "label"=>"We do not collect this information"
                ],
                "dbport"=>[
                    "type"=>"number",
                    "placeholder"=>"Database port",
                    "required"=>false,
                    "label"=>"We do not collect this information"
                ],
                "guser"=>[
                    "type"=>"text",
                    "placeholder"=>"Email, necessary for our mailing system",
                    "required"=>true,
                    "maxString"=>255,
                    "label"=>"We do not collect this information"
                ],
                "gpwd"=>[
                    "type"=>"text",
                    "placeholder"=>"Email password*",
                    "required"=>true,
                    "maxString"=>255,
                    "label"=>"We do not collect this information"
                ],
            ],
        ];
    }
}