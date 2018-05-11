<?php
	session_start();
    require "Core/config.php";

    function autoLoader($parameter)
    {
        if(file_exists("Core/Class/".$parameter.".class.php")){
            include("Core/Class/".$parameter.".class.php");
        }
        if(file_exists("Core/Models/".$parameter.".class.php")){
            include("Core/Models/".$parameter.".class.php");
        }
        if(file_exists("Core/ModalsRepository/".$parameter.".php")){
            include("Core/ModalsRepository/".$parameter.".php");
        }
        if(file_exists("Core/".$parameter.".php")){
            include("Core/".$parameter.".php");
        }
        if(file_exists("Core/Repository/".$parameter.".php")){
            include("Core/Repository/".$parameter.".php");
        }
    }
    spl_autoload_register("autoLoader");

    /**
     * @array tempUri
     * Contient un tableau de notre URI. La première cellule vaut l'URI propre et la seconde vaut les variables GET
     */
    $tempUri = explode("?", substr(urldecode($_SERVER["REQUEST_URI"]), strlen(DIRNAME)));

    /**
     * @array uriExploded
     * contient un tableau explode de notre URI
     * Le délimiteur est le DIRECTORY_SEPARATOR
     */
    $uriExploded = explode(DS, $tempUri[0]);

    /**
     * @object Access
     * La class Access contient nos configurations de route et différentes méthodes d'accès
     */
    $Acces = new Access();

    /**
     * @array accessParams
     * Contient les données de la route que l'on a trouvé grâce à l'URI
     */
    $slug = null;
    if(isset($uriExploded[1])){
        $slug = $uriExploded[1];
    }
    $accessParams = $Acces->getRoute(strtolower($slug));

    $language = (empty($uriExploded[0]))?"en-EN":strtolower($uriExploded[0])."-".strtoupper($uriExploded[0]);
    $controller = (empty($accessParams["controller"]))?"ClassController": ucfirst(strtolower($accessParams["controller"]))."Controller";
    $action = (empty($accessParams["action"]))?"indexAction": strtolower($accessParams["action"])."Action";

    /**
     * @params userConnected
     * Récupère le status de l'utilisateur et vérifie si l'authentification est réussie
     */
    $userConnected = false;
    $userStatus = false;
    if(isset($_SESSION['token']) && isset($_SESSION['email'])){
        if(($userConnected = Authentification::checkAuthentification($_SESSION['token'], $_SESSION['email']))){
            $userStatus = Authentification::getUserStatus($_SESSION['token'], $_SESSION['email']);
        } else {
            echo "<p>Connection failed</p>";
        }
    }

    if($userStatus < $Acces->getSecurity($accessParams["slug"])){
        $controller = "IndexController";
        $action = "accessAction";
    }

    /**
     * Il est possible que l'URI renseigné soit sous le format domaine/langue/controller/action
     * On va donc tester s'il ne s'agit pas de ce genre d'URI
     */
    if(isset($uriExploded[1]) && isset($uriExploded[2])){
        $backOfficeRoute = $Acces->getBackOfficeRoute(strtolower($uriExploded[1]).'/'.strtolower($uriExploded[2]));
        if(!(intval($userStatus) < intval($backOfficeRoute)) && $backOfficeRoute != -1){
            $controller = ucfirst(strtolower($uriExploded[1]))."Controller";
            $action = strtolower($uriExploded[2])."Action";
            unset($uriExploded[2]);
        } else {
            if(!($backOfficeRoute == -1)){
                $controller = "IndexController";
                $action = "accessAction";
                unset($uriExploded[2]);
            } else {
                $controller = "IndexController";
                $action = "notfoundAction";
                unset($uriExploded[2]);
            }
        }
    }

        /**
         * On créer notre tableau de paramètre qui contiendra nos GET, POST et paramètres en URI
         */
        unset($uriExploded[0]);
        unset($uriExploded[1]);
    $parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];

    if(file_exists("Core/Language/".$language."/conf.lang.php")){
        include "Core/Language/".$language."/conf.lang.php";
    } else {
        $language = "en-EN";
        include "Core/Language/en-EN/conf.lang.php";
    }

    if(file_exists("Controllers/".$controller.".php")){
        include "Controllers/".$controller.".php";
        if(class_exists($controller)){
            $obj = new $controller();
            if(method_exists($obj,$action)){
                $obj->$action($parameter);
            }
        }
    }
