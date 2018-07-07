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
        $message = null;
        if(dirname($_SERVER["SCRIPT_NAME"]) != '/'){
            if(DEV_MODE){
                $message['Repertoire d\'installation'] = 'Vous êtes sur le point d\'utiliser le CMS TOSLE en mode développeur. Si ce n\'est
                pas déjà fait, faites attention à bien générer le fichier .htaccess avec le bon RewriteBase.';
                $message['Rewrite Base'] = 'TOSLE a détecté : "'.dirname($_SERVER["SCRIPT_NAME"]).'". Le RewriteBase de 
                votre ".htaccess" doit posséder cette valeur pour que tout fonctionne correctement.';
            } else {
                $message['Repertoire d\'installation'] = 'Attention, le CMS TOSLE n\'est pas adapté à une utilisation sur un environnement
                 autre que LINUX. L\'Installeur a détecté un élément qui pourrait entraver le fonctionnement de votre site.';
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

    public static function checkDatabaseConnexion()
    {
        try {
            $database = new PDO("mysql:host=".DBHOST.";dbname=".DBNAME.";charset=UTF8",DBUSER,DBPWD);
            return 1;
        } catch(Exception $e){
            return 0;
        }
    }

    /**
     * @param $arrayData
     * @return array|string
     */
    public function setConfiguration($arrayData)
    {
        $sqlFilePath = CoreFile::getSqlFile();
        if(!file_exists($sqlFilePath)){
            return ['SQL' => 'File : '.$sqlFilePath.' not found'];
        }

        try {
            $bdd = new PDO('mysql:host='.DBHOST.';charset=UTF8',DBUSER,DBPWD);
        } catch(PDOException $e) {
            return ['SQL' => 'Failed to access at the database'];;
        }

        $bdd->query(file_get_contents($sqlFilePath));

        $Config = new Config();
        $Config->setName('website_tile');
        $Config->setValue($arrayData['website_name']);
        $Config->save();


        $user = new UserRepository();
        $user->setFirstName($arrayData["firstname"]);
        $user->setLastName($arrayData["lastname"]);
        $user->setEmail($arrayData["email"]);
        $user->setPassword($arrayData["pwd"]);
        $user->setStatus(2);
        $user->setToken();
        $user->save();
        return "";
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
                "submit"=>"Next step",
                "secure" => [
                    "status" => false,
                    "duration" => 8
                ],
            ],
            "input"=> [
                "dbhost"=>[
                    "type"=>"text",
                    "placeholder"=>"Example : localhost",
                    "required"=>true,
                    "maxString"=>100,
                    "description"=>"Laissez vide pour laisser la valeur par défaut",
                    "label" => "Adresse de la base de données*"
                ],
                "dbuser"=>[
                    "type"=>"text",
                    "placeholder"=>"Example : root",
                    "required"=>true,
                    "maxString"=>30,
                    "description"=>"We do not collect this information",
                    "label" => "Nom d'utilisateur de la base de données"
                ],
                "dbpwd"=>[
                    "type"=>"password_install",
                    "placeholder"=>"Example : password",
                    "required"=>false,
                    "maxString"=>255,
                    "description"=>"We do not collect this information",
                    "label" => "Mot de passe de l'utilisateur"
                ],
                "dbname"=>[
                    "type"=>"text",
                    "placeholder"=>"Example : my_db - This is an optional input",
                    "required"=>false,
                    "maxString"=>100,
                    "description"=>"Laissez vide si vous n'avez touché aucun fichier '.sql'",
                    "label" => "Nom de la table à utiliser"
                ],
                "dbport"=>[
                    "type"=>"number",
                    "placeholder"=>"Example : 3306 - This is an optional input",
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
                    "status" => false,
                    "duration" => 8
                ],
            ],
            "input"=> [
                "website_name"=>[
                    "type"=>"text",
                    "placeholder"=>"Example : CMS TOSLE",
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>"Maximum de 15 caractères",
                    "label" => "Nom de votre site internet*"
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>"Your lastname",
                    "required"=>true,
                    "maxString"=>15,
                    "label" => "Votre nom*"
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>"Your firstname",
                    "required"=>true,
                    "maxString"=>15,
                    "label" => "Votre prénom*"
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>"Your email : contact@domain.com",
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>"Nous ne stockons pas vos données",
                    "label" => "Votre email*"
                ],
                "emailConfirm"=>[
                    "type"=>"email",
                    "placeholder"=>"Confirm email",
                    "required"=>true,
                    "confirm"=>"email",
                    "label" => "Confirmez votre email*"
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>"Your password",
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>"Mot de passe incorrect (doit contenir : Maj, Min, Chiffre, au minimum 6 caractères)",
                    "label" => "Mot de passe*"
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>"Confirm password",
                    "required"=>true,
                    "confirm"=>"pwd",
                    "label" => "Confirmez votre mot de passe*",
                    "description"=>"Rappel : Maj, Min, Chiffre, au minimum 6 caractères",
                ],
            ],
        ];
    }
}