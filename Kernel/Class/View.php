<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 06/02/2018
 * Time: 21:54
 */

class View
{
    private $tpl;
    private $view;
    private $data = [];
    private $themeTpl = "Default";
    private $themeView = "Default";
    private $slugs;

    function __construct($tpl="default", $view = "default", $themeTpl = "Default", $themeView = "Default")
    {
        $this->themeTpl = $themeTpl;
        $this->themeView = $themeView;
        $this->tpl = "Ressources/Templates/".$this->themeTpl."/".$tpl.".tpl.php";
        $this->view = "Ressources/Views/".$this->themeView."/".$view.".view.php";

        if(!file_exists($this->view)){
            echo ERROR_02_VIEW_CALL;
        }
        if(!file_exists($this->tpl)){
            echo ERROR_01_VIEW_CALL;
        }

        $this->slugs = Access::getSlugsById();
    }

    public function addModal($modal, $config, $errors = false)
    {
        global $slugs;
        include "Ressources/Modals/".$modal.".md.php";
    }

    function setData($key, $value)
    {
        $this->data[$key] = $value;
    }

    function __destruct()
    {
        global $controller, $action, $language, $userConnected;

        extract($this->data);
        include $this->tpl;
    }
}