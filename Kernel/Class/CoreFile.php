<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 26/06/2018
 * Time: 19:58
 */

class CoreFile
{
    /**
     * @param $relativePath
     * @return array
     * Pour le dossier Tosle/Static
     * La fonction permet de tester l'existance d'un fichier, elle va ensuite, s'il n'est pas trouvé
     * le créer et enfin, retourner un tableau utilisable peu importe le système d'exploitation
     */
    static public function testStaticDirectory($relativePath)
    {
        if(SYSTEM == "LINUX") {
            $directoryPath = getcwd() . DIRNAME . 'Tosle/Static/' . $relativePath;
        } else {
            $directoryPath = '../..' . DIRNAME . 'Tosle/Static/' . $relativePath;
        }
        if(!file_exists($directoryPath)){
            mkdir($directoryPath, 0755, true);

        }

        return [
            'SERVER_PATH' => $directoryPath.'/',
            'SQL_PATH' => DIRNAME . 'Tosle/Static/' . $relativePath.'/',
        ];
    }

    /**
     * @param $relativePath
     * @return array
     * Pour le dossier App
     * La fonction permet de tester l'existance d'un fichier, elle va ensuite, s'il n'est pas trouvé
     * le créer et enfin, retourner un tableau utilisable peu importe le système d'exploitation
     */
    static public function testAppDirectory($relativePath)
    {
        if(SYSTEM == "LINUX") {
            $directoryPath = getcwd() . DIRNAME . 'App/' . $relativePath;
        } else {
            $directoryPath = '../..' . DIRNAME . 'App/' . $relativePath;
        }
        if(!file_exists($directoryPath)){
            mkdir($directoryPath, 0755, true);

        }

        return [
            'SERVER_PATH' => $directoryPath.'/',
            'SQL_PATH' => DIRNAME . 'Tosle/Static/' . $relativePath.'/',
        ];
    }

    /**
     * @return string
     * Permet d'obtenir l'url du fichier sql peu importe l'OS
     */
    static public function getSqlFile()
    {
        if(SYSTEM == "LINUX") {
            $directoryPath = getcwd() . DIRNAME . 'Sql/tosle.sql';
        } else {
            $directoryPath = 'Sql/tosle.sql';
        }
        return $directoryPath;
    }

    static public function testFeedFile($relativePath)
    {
        if(SYSTEM == "LINUX") {
            $directoryPath = getcwd() . DIRNAME . 'Tosle/Static/xml/' . $relativePath;
        } else {
            $directoryPath = '../..' . DIRNAME . 'Tosle/Static/xml/' . $relativePath;
        }
        if(!file_exists($directoryPath)){
            return null;
        }
        return DIRNAME . 'Tosle/Static/xml/' . $relativePath;
    }
}