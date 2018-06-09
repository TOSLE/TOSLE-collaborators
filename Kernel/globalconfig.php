<?php
/**
 * ENV VAR
 */
    $modeDev = true;

    if($modeDev)
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN')
            define("SYSTEM", "WINDOWS");
        else
            define("SYSTEM", "LINUX");

    $scriptDS = (DIRECTORY_SEPARATOR == "\\")?"\\":DIRECTORY_SEPARATOR;
    define("DS", $scriptDS);

    $scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
    define("DIRNAME", $scriptName.DS);