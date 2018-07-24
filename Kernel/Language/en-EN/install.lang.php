<?php
    define('INSTALL_FORM_TITLE', 'Welcome on TOSLE !');
    define('INSTALL_FORM_STEP', 'Installation, step : ');
    define('INSTALL_FORM_WARNING', 'Warning !');
        define('INSTALL_FORM_WARNING_TYPE', 'Type : ');
        define('INSTALL_FORM_WARNING_MESSAGE', 'Message : ');
            define('INSTALL_FORM_WARNING_MESSAGE_DATABASE', 'Database');
                define('INSTALL_FORM_WARNING_MESSAGE_DATABASE_MESSAGE', 'TOSLE can\'t access to the database.');
            define('INSTALL_FORM_WARNING_MESSAGE_PARAMETER', 'Parameter file');
                define('INSTALL_FORM_WARNING_MESSAGE_PARAMETER_MESSAGE', 'TOSLE can\'t create the parameter file');

    define('INSTALL_FORM_INSTALLER_REPERTORYINSTALL', 'Root of TOSLE');
        define('INSTALL_FORM_INSTALLER_REPERTORYINSTALL_MESSAGE', 'TOSLE need to be installed on the root of your server.
        Please. If you want really use it, you need to update the configuration of your .htaccess file. (Just update the
        RewriteBase).');
    define('INSTALL_FORM_INSTALLER_REWRITEBASE', 'Rewrite Base');
        define('INSTALL_FORM_INSTALLER_REWRITEBASE_MESSAGE', 'TOSLE detect '.dirname($_SERVER["SCRIPT_NAME"]).'. 
        RewriteBase of your .htaccess need to be the same.');
    define('INSTALL_FORM_INSTALLER_REPERTORYINSTALL_BIS', 'Folder of TOSLE');
        define('INSTALL_FORM_INSTALLER_REPERTORYINSTALL_BIS_MESSAGE', 'TOSLE need to be in your root of your server ! ');

    define('INSTALL_FORM_FAILED_CONNECT', 'SQL');
        define('INSTALL_FORM_FAILED_CONNECT_MESSAGE', 'Failed to access at the database');

    define('FORM_INSTALL_STEP', 'Next step');

    define('FORM_INSTALL_PLACEHOLDER_DBHOST', 'Example : localhost');
    define('FORM_INSTALL_LABEL_DBHOST', 'Database host*');

    define('FORM_INSTALL_PLACEHOLDER_DBUSER', 'Example : root');
    define('FORM_INSTALL_LABEL_DBUSER', 'Database user*');

    define('FORM_INSTALL_PLACEHOLDER_DBPASSWORD', '');
    define('FORM_INSTALL_LABEL_DBPASSWORD', 'Database password*');

    define('FORM_INSTALL_PLACEHOLDER_DNAME', 'Example : tosle_database');
    define('FORM_INSTALL_LABEL_DBNAME', 'Database name, this is an optional input');

    define('FORM_INSTALL_PLACEHOLDER_PORT', 'Example : 3306');
    define('FORM_INSTALL_LABEL_PORT', 'Database port, this is an optional input');

    define('FORM_INSTALL_PLACEHOLDER_GUSER', 'Example : email@domain.com');
    define('FORM_INSTALL_LABEL_GUSER', 'Server email*');

    define('FORM_INSTALL_PLACEHOLDER_GPWD', '');
    define('FORM_INSTALL_LABEL_GPWD', 'Server email password*');

    define('FORM_INSTALL_STEP_2', 'Validate your installation');

    define('FORM_INSTALL_PLACEHOLDER_WEBSITE', 'Example : CMS TOSLE');
    define('FORM_INSTALL_LABEL_WEBSITE', 'Name of your CMS*');

    define('FORM_INSTALL_PLACEHOLDER_LASTNAME', 'Your lastname');
    define('FORM_INSTALL_LABEL_LASTNAME', 'Your lastname*');

    define('FORM_INSTALL_PLACEHOLDER_FIRSTNAME', 'Your firstname');
    define('FORM_INSTALL_LABEL_FIRSTNAME', 'Your firstname*');

    define('FORM_INSTALL_PLACEHOLDER_PASSWORD', '');
    define('FORM_INSTALL_PLACEHOLDER_PASSWORDCONFIRM', '');
    define('FORM_INSTALL_LABEL_PASSWORD', 'Your password*');
    define('FORM_INSTALL_LABEL_PASSWORDCONFIRM', 'Your password*');

    define('FORM_INSTALL_PLACEHOLDER_EMAIL', 'Your email');
    define('FORM_INSTALL_PLACEHOLDER_EMAILCONFIRM', 'Your email');
    define('FORM_INSTALL_LABEL_EMAIL', 'Your email*');
    define('FORM_INSTALL_LABEL_EMAILCONFIRM', 'Confirm your email*');
