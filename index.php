<?php
	session_start();
    date_default_timezone_set('Europe/Paris');
    
	require "Kernel/globalconfig.php";
    function autoLoader($parameter)
    {
        if (file_exists("Kernel/Class/" . $parameter . ".php")) {
            include("Kernel/Class/" . $parameter . ".php");
        }
        if (file_exists("Src/Models/" . $parameter . ".class.php")) {
            include("Src/Models/" . $parameter . ".class.php");
        }
        if (file_exists("Src/ModalsRepository/" . $parameter . ".php")) {
            include("Src/ModalsRepository/" . $parameter . ".php");
        }
        if (file_exists("Kernel/" . $parameter . ".php")) {
            include("Kernel/" . $parameter . ".php");
        }
        if (file_exists("Src/Repository/" . $parameter . ".php")) {
            include("Src/Repository/" . $parameter . ".php");
        }
    }

    spl_autoload_register("autoLoader");

	if(file_exists("App/config/parameter.php")) {
        require "App/config/parameter.php";
	    if(Installer::checkDatabaseConnexion()){
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
            if (isset($uriExploded[1])) {
                $slug = $uriExploded[1];
            }
            $accessParams = $Acces->getRoute(strtolower($slug));

            $language = (empty($uriExploded[0])) ? "en-EN" : strtolower($uriExploded[0]) . "-" . strtoupper($uriExploded[0]);
            $controller = (empty($accessParams["controller"])) ? "ClassController" : ucfirst(strtolower($accessParams["controller"])) . "Controller";
            $action = (empty($accessParams["action"])) ? "indexAction" : strtolower($accessParams["action"]) . "Action";

            /**
             * @params userConnected
             * Récupère le status de l'utilisateur et vérifie si l'authentification est réussie
             */
            $userConnected = false;
            $userStatus = 1;
            $Auth = null;
            if (isset($_SESSION['token']) && isset($_SESSION['email'])) {
                if (($userConnected = Authentification::checkAuthentification($_SESSION['token'], $_SESSION['email']))) {
                    $Auth = Authentification::getUser($_SESSION['token'], $_SESSION['email']);
                    $userStatus = $Auth->getStatus();
                } else {
                    echo "<p>Connection failed</p>";
                }
            }

            if ($userStatus < $accessParams["security"]) {
                $controller = "IndexController";
                $action = "accessAction";
            }

            /**
             * Il est possible que l'URI renseigné soit sous le format domaine/langue/controller/action
             * On va donc tester s'il ne s'agit pas de ce genre d'URI
             */
            if (isset($uriExploded[1]) && isset($uriExploded[2]) && $accessParams["slug"] == $Acces->getSlug("default")["slug"]) {
                $backOfficeRoute = $Acces->getBackOfficeRoute(strtolower($uriExploded[1]) . '/' . strtolower($uriExploded[2]));
                if (!(intval($userStatus) < intval($backOfficeRoute)) && $backOfficeRoute != -1) {
                    $controller = ucfirst(strtolower($uriExploded[1])) . "Controller";
                    $action = strtolower($uriExploded[2]) . "Action";
                    unset($uriExploded[2]);
                } else {
                    if (!($backOfficeRoute == -1)) {
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

            if (file_exists("Kernel/Language/" . $language . "/conf.lang.php")) {
                include "Kernel/Language/" . $language . "/conf.lang.php";
            } else {
                $language = "en-EN";
                include "Kernel/Language/en-EN/conf.lang.php";
            }

            if (file_exists("Src/Controllers/" . $controller . ".php")) {
                include "Src/Controllers/" . $controller . ".php";
                if (class_exists($controller)) {
                    $obj = new $controller();
                    if (method_exists($obj, $action)) {
                        $obj->$action($parameter);
                    }
                }
            }
	    } else {
            $controller = "IndexController";
            $action = "configAction";
            $tempUri = explode("?", substr(urldecode($_SERVER["REQUEST_URI"]), strlen(DIRNAME)));
            $uriExploded = explode(DS, $tempUri[0]);
            $parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];
            if (file_exists("Src/Controllers/" . $controller . ".php")) {
                include "Src/Controllers/" . $controller . ".php";
                if (class_exists($controller)) {
                    $obj = new $controller();
                    if (method_exists($obj, $action)) {
                        $obj->$action($parameter);
                    }
                }
            }
        }
    } else {
	    $controller = "IndexController";
	    $action = "installAction";
        $tempUri = explode("?", substr(urldecode($_SERVER["REQUEST_URI"]), strlen(DIRNAME)));
        $uriExploded = explode(DS, $tempUri[0]);
        $parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];
        if (file_exists("Src/Controllers/" . $controller . ".php")) {
            include "Src/Controllers/" . $controller . ".php";
            if (class_exists($controller)) {
                $obj = new $controller();
                if (method_exists($obj, $action)) {
                    $obj->$action($parameter);
                }
            }
        }
    }