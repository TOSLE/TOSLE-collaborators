<?php

class Router {
    /**
     * @var string
     */
    private $language;
    /**
     * @var string
     */
    private $controller;
    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array string
     */
    private $parameter;

    /**
     * Router constructor.
     */
    function __construct()
    {
        $this->uri = substr(urldecode($_SERVER["REQUEST_URI"]), strlen(dirname($_SERVER["SCRIPT_NAME"])));
    }

    /**
     *  Explode URI's browser
     */
    function explodeUri(){
        $tempUri = explode("?", $this->uri);

        $uriExploded = explode(DS, $tempUri[0]);

        $this->language = (empty($uriExploded[0]))?"en-EN":$uriExploded[0]."-".strtoupper($uriExploded[0]);
        $this->controller = (empty($uriExploded[1]))?"IndexController": ucfirst(strtolower($uriExploded[1]))."Controller";
        $this->action = (empty($uriExploded[2]))?"IndexAction": strtolower($uriExploded[2])."Action";

        unset($uriExploded[0]);
        unset($uriExploded[1]);
        unset($uriExploded[2]);

        $this->parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];
    }

    /**
     *  Get language package to generete error
     */
    function includeLanguageFile(){
        if(file_exists("Core/Language/".$this->language."/conf.lang.php")){
            include "Core/Language/".$this->language."/conf.lang.php";
        }
    }
}