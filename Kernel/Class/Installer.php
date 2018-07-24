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
                $message[INSTALL_FORM_INSTALLER_REPERTORYINSTALL] = INSTALL_FORM_INSTALLER_REPERTORYINSTALL_MESSAGE;
                $message[INSTALL_FORM_INSTALLER_REWRITEBASE] = INSTALL_FORM_INSTALLER_REWRITEBASE_MESSAGE;
            } else {
                $message[INSTALL_FORM_INSTALLER_REPERTORYINSTALL_BIS] = INSTALL_FORM_INSTALLER_REPERTORYINSTALL_BIS_MESSAGE;
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

        $robotFile = CoreFile::getRobotFile();
        if(!file_exists($robotFile)){
            if(!($file = fopen($robotFile, 'w+'))){
                return 0;
            }
        }
        $file = fopen($robotFile, 'w');
        $line = 'Sitemap: <lien url="'.self::url().'/Tosle/Static/xml/sitemap.xml">'.self::url().'/Tosle/Static/xml/sitemap.xml</lien>';
        fputs($file, $line);
        fclose($file);

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
     * @return int
     * Retourne l'état de la connexion avec le DBNAME
     * Contexte, on peut partir du principe que l'utilisateur à valider le premier formulaire de l'installeur, mais
     * pas le second. Du coup, la logique a été d'insérer la table TOSLE à la fin du SECOND formulaire et que celui-ci
     * soit réussie. Du coup, tant que le second formulaire n'est pas passé, il n'y a pas de table en base et on
     * peut redirriger l'utilisateur vers la seconde partie de l'installation
     */
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
            return [INSTALL_FORM_FAILED_CONNECT => INSTALL_FORM_FAILED_CONNECT_MESSAGE];;
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
                "submit"=>FORM_INSTALL_STEP,
                "secure" => [
                    "status" => false,
                    "duration" => 8
                ],
            ],
            "input"=> [
                "dbhost"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_DBHOST,
                    "required"=>true,
                    "maxString"=>100,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_DBHOST
                ],
                "dbuser"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_DBUSER,
                    "required"=>true,
                    "maxString"=>30,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_DBUSER
                ],
                "dbpwd"=>[
                    "type"=>"password_install",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_DBPASSWORD,
                    "required"=>false,
                    "maxString"=>255,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_DBPASSWORD
                ],
                "dbname"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_DNAME,
                    "required"=>false,
                    "maxString"=>100,
                    "description"=>FORM_DESCRIPTION_NOTREQUIRED,
                    "label" => FORM_INSTALL_LABEL_DBNAME
                ],
                "dbport"=>[
                    "type"=>"number",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_PORT,
                    "required"=>false,
                    "description"=>FORM_DESCRIPTION_NOTREQUIRED,
                    "label" => FORM_INSTALL_LABEL_PORT
                ],
                "guser"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_GUSER,
                    "required"=>true,
                    "maxString"=>255,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_GUSER
                ],
                "gpwd"=>[
                    "type"=>"password_install",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_GPWD,
                    "required"=>true,
                    "maxString"=>255,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_GPWD
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
                "submit"=>FORM_INSTALL_STEP_2,
                "secure" => [
                    "status" => false,
                    "duration" => 8
                ],
            ],
            "input"=> [
                "website_name"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_WEBSITE,
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_WEBSITE
                ],
                "lastname"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_LASTNAME,
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_LASTNAME
                ],
                "firstname"=>[
                    "type"=>"text",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_FIRSTNAME,
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_FIRSTNAME
                ],
                "email"=>[
                    "type"=>"email",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_EMAIL,
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_EMAIL
                ],
                "emailConfirm"=>[
                    "type"=>"email",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_EMAILCONFIRM,
                    "required"=>true,
                    "confirm"=>"email",
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_EMAILCONFIRM
                ],
                "pwd"=>[
                    "type"=>"password",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_PASSWORD,
                    "required"=>true,
                    "maxString"=>15,
                    "description"=>FORM_DESCRIPTION_REQUIRED,
                    "label" => FORM_INSTALL_LABEL_PASSWORD
                ],
                "pwdConfirm"=>[
                    "type"=>"password",
                    "placeholder"=>FORM_INSTALL_PLACEHOLDER_PASSWORDCONFIRM,
                    "required"=>true,
                    "confirm"=>"pwd",
                    "label" => FORM_INSTALL_LABEL_PASSWORDCONFIRM,
                    "description"=>FORM_DESCRIPTION_REQUIRED
                ],
            ],
        ];
    }

    /**
     * @return string
     */
    public static function url(){
        return sprintf(
            "%s://%s",
            isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
            $_SERVER['SERVER_NAME']
        );
    }
}