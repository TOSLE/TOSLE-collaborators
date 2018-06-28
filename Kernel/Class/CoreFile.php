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
}