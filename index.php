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

    $tempUri = explode("?", substr(urldecode($_SERVER["REQUEST_URI"]), strlen(DIRNAME)));

    $uriExploded = explode(DS, $tempUri[0]);

    $Acces = new Access();
    $AccessParams = $Acces->getRoute(strtolower($uriExploded[1]));
    
    $language = (empty($uriExploded[0]))?"en-EN":strtolower($uriExploded[0])."-".strtoupper($uriExploded[0]);
    $controller = (empty($AccessParams["controller"]))?"IndexController": ucfirst(strtolower($AccessParams["controller"]))."Controller";
    $action = (empty($AccessParams["action"]))?"indexAction": strtolower($AccessParams["action"])."Action";

    unset($uriExploded[0]);
    unset($uriExploded[1]);

    $parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];
    if(file_exists("Core/Language/".$language."/conf.lang.php")){
        include "Core/Language/".$language."/conf.lang.php";
    } else {
        $language = "en-EN";
        include "Core/Language/en-EN/conf.lang.php";
    }

    /**
     * @params userConnected
     * Récupère le status de l'utilisateur et vérifie si l'authentification est réussie
     */
    $userConnected = false;
    if(isset($_SESSION['token']) && isset($_SESSION['email'])){
        if(!($userConnected = Authentification::checkAuthentification($_SESSION['token'], $_SESSION['email']))){
            echo "<p>Connection failed</p>";
        }
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
