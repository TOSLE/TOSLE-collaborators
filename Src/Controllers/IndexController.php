<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 06/02/2018
 * Time: 21:41
 */


/**
 * Class IndexController
 * Controller not use
 */
class IndexController
{
    /**
     * @Route("/en/index(/index)")
     * @param array $params
     * Default action of IndexController
     */
    function indexAction($params)
    {
        $View = new View();
    }

    function accessAction($params)
    {
        echo "Vous n'avez apparemment pas les droits d'accès à ce lien";
    }
    function notfoundAction($params)
    {
        new View("default", "accessnotfound");
    }

    function installAction($params)
    {
        $View = new View('installer', 'installer');
        $Installer = new Installer();
        $config = $Installer->configFormInstaller();
        $errorsParameter = $Installer->alertHtaccess();
        $errors = "";
        if(isset($params["POST"]) && !empty($params["POST"])) {
            $errors = Form::checkForm($config, $params["POST"]);
            if(empty($errors)){
                $data = Form::secureData($params["POST"]);
                $status = $Installer->testConnectionBDD($data);
                if(!$status) {
                    $errors['BDD Connexion'] = "Il semble que la connexion à la BDD est échouée.";
                } else {
                    $status = $Installer->setParameterFile($data);
                    if(!$status) {
                        $errors['Parameter'] = "Il semble que la création du fichier a échoué.";
                    } else {
                        $Routes = Access::getSlugsById();
                        header('Location:'.$Routes['index/config']);
                    }
                }
            }
        }
        $View->setData('config', $config);
        $View->setData('errors', $errors);
        $View->setData('errorsParameter', $errorsParameter);
    }

    function configAction($params)
    {
        echo "Deuxième phase";
    }
}