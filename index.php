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
            require "App/config/configuration.php";
            $Generator = new GeneratorXML('sitemap');
            $Generator->setSitemap();
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
            if (isset($uriExploded[0])) {
                $slug = $uriExploded[0];
            }
            $accessParams = $Acces->getRoute(strtolower($slug));

            $language = (isset($_COOKIE['TOSLE_LANG'])) ? strtolower($_COOKIE['TOSLE_LANG']) . "-" . strtoupper($_COOKIE['TOSLE_LANG']) : "no-cookie";
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
                    Authentification::getUser($_SESSION['token'], $_SESSION['email']);
                    if(isset($_SESSION['auth']) && !empty($_SESSION['auth'])){
                        $Auth = json_decode($_SESSION['auth']);
                        $userStatus = $Auth->{'status'};
                    }
                } else {
                    echo "<p>Connection failed</p>";
                }
            }
            if ($userStatus < $accessParams["security"]) {
                $controller = "IndexController";
                $action = "accessAction";
            }


            /**
             * Il est possible que l'URI renseigné soit sous le format domaine/controller/action
             * On va donc tester s'il ne s'agit pas de ce genre d'URI
             */
            if (isset($uriExploded[0]) && isset($uriExploded[1]) && $accessParams["slug"] == $Acces->getSlug("default")["slug"]) {
                $backOfficeRoute = $Acces->getBackOfficeRoute(strtolower($uriExploded[0]) . '/' . strtolower($uriExploded[1]));
                if (!(intval($userStatus) < intval($backOfficeRoute)) && $backOfficeRoute != -1) {
                    $controller = ucfirst(strtolower($uriExploded[0])) . "Controller";
                    $action = strtolower($uriExploded[1]) . "Action";
                    unset($uriExploded[1]);
                } else {
                    if (!($backOfficeRoute == -1)) {
                        $controller = "IndexController";
                        $action = "accessAction";
                        unset($uriExploded[1]);
                    } else {
                        $controller = "IndexController";
                        $action = "notfoundAction";
                        unset($uriExploded[1]);
                    }
                }
            }

            /**
             * Il n'est pas nécessaire d'avoir les statistiques de vue sur les routes avec accès admin
             */
            if($accessParams['security'] < 2 && !isset($backOfficeRoute)) {
                $cookieAnalytics = (isset($_COOKIE['TOSLE_ANALYTICS']))?$_COOKIE['TOSLE_ANALYTICS']:null;
                $Analytics = new Analytics();
                $Analytics->setViewStats($cookieAnalytics);
            }

            /**
             * On créer notre tableau de paramètre qui contiendra nos GET, POST et paramètres en URI
             */
            unset($uriExploded[0]);
            $parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];
            if (file_exists("Kernel/Language/" . $language . "/conf.lang.php")) {
                include "Kernel/Language/" . $language . "/conf.lang.php";
            } else {
                setcookie('TOSLE_LANG', 'en', time()+(3600*24*30*12));
                $language = "en-EN";
                include "Kernel/Language/".$language."/conf.lang.php";
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
            setcookie('TOSLE_LANG', 'en', time()+(3600*24*30*12));
            $language = "en-EN";
            include "Kernel/Language/".$language."/conf.lang.php";
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