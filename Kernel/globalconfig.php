<?php
/**
 * ENV VAR
 */
    define("DEV_MODE", true);

    $scriptDS = (DIRECTORY_SEPARATOR == "\\")?"/":DIRECTORY_SEPARATOR;
    define("DS", $scriptDS);

    $scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
    define("DIRNAME", $scriptName.DS);

    if(DEV_MODE){
        define('SYSTEM', (strpos(PHP_OS, 'WIN') === 0)?"WIN":"LINUX");
        ini_set('display_errors', 1);
        ini_set('log_errors', 1);
        ini_set('error_log', DIRNAME. 'Kernel/Logs/log_error_php.txt');
        error_reporting(E_ALL);
    }