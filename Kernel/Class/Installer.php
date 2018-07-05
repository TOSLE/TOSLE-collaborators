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

    /**
     * @param array $arrayData
     * @return int
     * Installation du CMS
     */
    public function testConnectionBDD($arrayData)
    {
        try {
            $testConnexion = new PDO('mysql:host='.$arrayData['dbhost'].';charset=UTF8',$arrayData['dbuser'],$arrayData['dbpwd']);
        } catch(PDOException $e) {
            return 0;
        }
        return 1;
    }

    /**
     * @param array $arrayData
     * @return int
     */
    public function setParameterFile($arrayData)
    {
        CoreFile::testAppDirectory('config');
        if(empty($arrayData['dbport'])){
            $arrayData['dbport'] = 3306;
        }
        if(empty($arrayData['dbname'])){
            $arrayData['dbname'] = "tosle_database";
        }
        if($file = fopen("App/config/parameter.php", 'w')){
            fputs($file, '<?php'.PHP_EOL);
            fputs($file, '	define(\'DBUSER\', \''.$arrayData['dbuser'].'\');'.PHP_EOL);
            fputs($file, '	define(\'DBPWD\', \''.$arrayData['dbpwd'].'\');'.PHP_EOL);
            fputs($file, '	define(\'DBHOST\', \''.$arrayData['dbhost'].'\');'.PHP_EOL);
            fputs($file, '	define(\'DBNAME\', \''.$arrayData['dbname'].'\');'.PHP_EOL);
            fputs($file, '	define(\'DBPORT\', \''.$arrayData['dbport'].'\');'.PHP_EOL);
            fputs($file, '	define(\'GUSER\', \''.$arrayData['guser'].'\');'.PHP_EOL);
            fputs($file, '	define(\'GPWD\', \''.$arrayData['gpwd'].'\');'.PHP_EOL);
            fclose($file);
            return 1;
        }
        return 0;
    }

    /**
     * @return array
     * Formulaire d'installation du CMS
     */
    public function configFormInstaller()
    {
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"",
                "submit"=>"Tester ma configuration",
                "secure" => [
                    "status" => true,
                    "duration" => 5
                ],
            ],
            "input"=> [
                "dbuser"=>[
                    "type"=>"text",
                    "placeholder"=>"Database username*",
                    "required"=>true,
                    "maxString"=>30,
                    "description"=>"We do not collect this information",
                    "label" => "Nom d'utilisateur de la base de données"
                ],
                "dbpwd"=>[
                    "type"=>"password_install",
                    "placeholder"=>"Database password*",
                    "required"=>true,
                    "maxString"=>255,
                    "description"=>"We do not collect this information",
                    "label" => "Mot de passe de l'utilisateur"
                ],
                "dbname"=>[
                    "type"=>"text",
                    "placeholder"=>"Optional, database name",
                    "required"=>false,
                    "maxString"=>100,
                    "description"=>"Laissez vide si vous n'avez touché aucun fichier '.sql'",
                    "label" => "Nom de la table à utiliser"
                ],
                "dbhost"=>[
                    "type"=>"text",
                    "placeholder"=>"Database host*",
                    "required"=>true,
                    "maxString"=>100,
                    "description"=>"Laissez vide pour laisser la valeur par défaut",
                    "label" => "Adresse de la base de données"
                ],
                "dbport"=>[
                    "type"=>"number",
                    "placeholder"=>"Optional, database port",
                    "required"=>false,
                    "description"=>"Laissez vide pour laisser la valeur par défaut",
                    "label" => "Port de la base de données"
                ],
                "guser"=>[
                    "type"=>"text",
                    "placeholder"=>"Email, necessary for our mailing system",
                    "required"=>true,
                    "maxString"=>255,
                    "description"=>"Il s'agit de l'email que le serveur va utiliser pour communiquer",
                    "label" => "Email du système de messagerie"
                ],
                "gpwd"=>[
                    "type"=>"password_install",
                    "placeholder"=>"Email password*",
                    "required"=>true,
                    "maxString"=>255,
                    "description"=>"Nous ne collectons pas ces données, soyez-en sûr",
                    "label" => "Mot de passe de l'email"
                ],
            ],
        ];
    }

    /**
     * @return array
     * Formulaire de configuration du compte
     */
    public function configFormConfiguration()
    {
        return [
            "config"=> [
                "method"=>"post",
                "action"=>"",
                "submit"=>"Valider la configuration",
                "secure" => [
                    "status" => true,
                    "duration" => 5
                ],
            ],
            "input"=> [
                "titre"=>[
                    "type"=>"text",
                    "placeholder"=>"Name of your Website*",
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>"Maxlength 15",
                    "label" => "Nom de votre site internet"
                ],
            ],
        ];
    }
}