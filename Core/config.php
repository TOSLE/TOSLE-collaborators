<?php
    define("DBUSER","root");
    define("DBPWD","root");
    define("DBHOST","mysql"); #le nom du container docker qui gère la bdd
    define("DBNAME","tosle_database");
    define("DBPORT","80");
    define("GUSER", "contact.tosle@gmail.com");
    define("GPWD", "ostosle2018");

    $scriptDS = (DIRECTORY_SEPARATOR == "\\")?"/":DIRECTORY_SEPARATOR;
    define("DS", $scriptDS);

    $scriptName = (dirname($_SERVER["SCRIPT_NAME"]) == "/")?"":dirname($_SERVER["SCRIPT_NAME"]);
    define("DIRNAME", $scriptName.DS);