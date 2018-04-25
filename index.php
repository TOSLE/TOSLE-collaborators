<?php 
	session_start();
    require "Core/config.php";

    function autoLoader($parameter)
    {
        if(file_exists("Core/Class/".$parameter.".class.php")){
            include("Core/Class/".$parameter.".class.php");
        }
        if(file_exists("Models/".$parameter.".class.php")){
            include("Models/".$parameter.".class.php");
        }
        if(file_exists("Core/".$parameter.".php")){
            include("Core/".$parameter.".php");
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
    $accessParams = $Acces->getRoute(strtolower($uriExploded[1]));

    
    $language = (empty($uriExploded[0]))?"en-EN":strtolower($uriExploded[0])."-".strtoupper($uriExploded[0]);
    $controller = (empty($accessParams["controller"]))?"ClassController": ucfirst(strtolower($accessParams["controller"]))."Controller";
    $action = (empty($accessParams["action"]))?"indexAction": strtolower($accessParams["action"])."Action";

    unset($uriExploded[0]);
    unset($uriExploded[1]);


    /**
     * @params userConnected
     * Récupère le status de l'utilisateur et vérifie si l'authentification est réussie
     */
    $userStatus = false;
    if(isset($_SESSION['token']) && isset($_SESSION['email'])){
        if(!($userStatus = Authentification::checkAuthentification($_SESSION['token'], $_SESSION['email']))){
            if($userStatus === false) {
                echo "<p>Connection failed</p>";
            }
            if($userStatus === 0){
                echo "<p>Please confirm email</p>";
            }
            if($userStatus < $Acces->getSecurity($accessParams["slug"])){
                $controller = "IndexController";
                $action = "rightAction";
            }
        }
    }

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
