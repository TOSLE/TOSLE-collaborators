<?php 
	session_start();
    require "Core/config.php";

    function autoLoader($parameter)
    {
        $parameter .= ".class.php";
        if(file_exists("Core/Class/".$parameter)){
            include("Core/Class/".$parameter);
        }
        if(file_exists("Models/".$parameter)){
            include("Models/".$parameter);
        }
    }
    spl_autoload_register("autoLoader");

    $tempUri = explode("?", substr(urldecode($_SERVER["REQUEST_URI"]), strlen(DIRNAME)));

    $uriExploded = explode(DS, $tempUri[0]);
    
    $language = (empty($uriExploded[0]))?"en-EN":strtolower($uriExploded[0])."-".strtoupper($uriExploded[0]);
    $controller = (empty($uriExploded[1]))?"IndexController": ucfirst(strtolower($uriExploded[1]))."Controller";
    $action = (empty($uriExploded[2]))?"indexAction": strtolower($uriExploded[2])."Action";

    unset($uriExploded[0]);
    unset($uriExploded[1]);
    unset($uriExploded[2]);

    $parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];
    if(file_exists("Core/Language/".$language."/conf.lang.php")){
        include "Core/Language/".$language."/conf.lang.php";
    } else {
        $language = "en-EN";
        include "Core/Language/en-EN/conf.lang.php";
    }

    if(isset($_SESSION['token']) && isset($_SESSION['email'])){
        if(!Authentification::checkAuthentification($_SESSION['token'], $_SESSION['email'])){
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
