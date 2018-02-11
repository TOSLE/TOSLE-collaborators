<?php

class Router {
    /**
     * @var string
     */
    public $language;
    /**
     * @var string
     */
    public $controller;
    /**
     * @var string
     */
    public $action;

    /**
     * @var string
     */
    public $uri;

    /**
     * @var array string
     */
    public $parameter;

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
    function includeLanguageFile()
    {
        if(file_exists("Core/Language/".$this->language."/conf.lang.php")){
            include "Core/Language/".$this->language."/conf.lang.php";
        }
    }

    function callAction()
    {
        if(file_exists("Controllers/".$this->controller.".php")){
            include "Controllers/".$this->controller.".php";
            $controller = $this->controller;
            $action = $this->action;
            $language = $this->language;
            if(class_exists($this->controller)){
                $obj = new $this->controller();
                if(method_exists($obj,$this->action)){
                    $action = $this->action;
                    $obj->$action($this->parameter);
                }
            }
        }
    }
}