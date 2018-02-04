<?php 
	session_start();
    require("Core/config.php");

    function autoLoader($parameter)
    {
        $parameter .= ".class.php";
        if(file_exists("Core/Class/".$parameter)){
            include("Core/Class/".$parameter);
        }
    }
    spl_autoload_register("autoLoader");

    $Router = new Router();
    $Router->explodeUri();