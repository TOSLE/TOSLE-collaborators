<?php
    $scriptDS = (DIRECTORY_SEPARATOR == "\\")?"/":DIRECTORY_SEPARATOR;
    define("DS", $scriptDS);

    $scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
    define("DIRNAME", $scriptName.DS);