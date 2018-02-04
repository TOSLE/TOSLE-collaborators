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

    function explodeUri(){
        $tempUri = explode("?", $this->uri);

        $uriExploded = explode(DS, $tempUri[0]);

        print_r($uriExploded);

        $this->language = (empty($uriExploded[0]))?"en": $uriExploded[0];
        $this->controller = (empty($uriExploded[1]))?"IndexController": ucfirst(strtolower($uriExploded[1]))."Controller";
        $this->action = (empty($uriExploded[2]))?"IndexAction": strtolower($uriExploded[2])."Action";

        echo "<br>".$this->language;
        echo "<br>".$this->controller;
        echo "<br>".$this->action;

        unset($uriExploded[0]);
        unset($uriExploded[1]);
        unset($uriExploded[2]);

        $this->parameter = ["POST" => $_POST, "GET" => $_GET, "URI" => array_values($uriExploded)];

        echo "<pre>";
        print_r($this->parameter);
        echo "</pre>";


    }
}