<?php
/**
 * Created by PhpStorm.
 * User: jdomange
 * Date: 11/04/2018
 * Time: 11:17
 */

class Form
{
    public static function checkForm($config, $data)
    {
        $errorsMsg = [];
        if(isset($config['input'])){
            foreach ($config["input"] as $name => $attributs) {
                if(isset($attributs["confirm"]) && $data[$name] != $data[$attributs["confirm"]]){
                    $errorsMsg["confirmation"]= $name . 'ne correspond pas à '.$attributs["confirm"];
                } else if (!isset($attributs["confirm"])){
                    if($attributs["type"]=="email" && !self::checkEmail($data[$name])){
                        $errorsMsg["email"]= "Format de l'email incorrect";
                    } else if($attributs["type"]=="password" && !self::checkPwd($data[$name])){
                        $errorsMsg["password"]= "Mot de passe incorrect(Maj, Min, Chiffre, au minimum 6 caractères)";
                    } else if($attributs["type"]=="number" && !self::checkNumber($data[$name])){
                        $errorsMsg["number"]= $name. " n'est pas correct";
                    }
                }

                if(isset($attributs["maxString"]) && !self::maxString($data[$name], $attributs["maxString"])){
                    $errorsMsg["longueur"]= $name. " doit faire moins de ".$attributs["maxString"];
                }
                if(isset($attributs["minString"]) && !self::minString($data[$name], $attributs["minString"])){
                    $errorsMsg["longueur"]= $name. " doit faire plus de ".$attributs["minString"];
                }
                if(isset($attributs["maxNum"]) && !self::maxNum($data[$name], $attributs["maxNum"])){
                    $errorsMsg["longueur"]= $name. " doit faire moins de ".$attributs["maxNum"];
                }
                if(isset($attributs["minNum"]) && !self::minString($data[$name], $attributs["minNum"])){
                    $errorsMsg["longueur"]= $name. " doit faire plus de ".$attributs["minNum"];
                }
            }
        }
        echo $data[$name];
        if(isset($config["select"])){
            foreach($config["select"] as $name => $attributs) {
                if(isset($attributs['options']) && !empty($attributs['options'])){
                    if($data[$name] === "_forbidden"){
                        $errorsMsg[$attributs['label']] = "Il est nécessaire de sélectionner une autre valeur que celle par défaut";
                    }
                }
            }
        }

        return $errorsMsg;
    }
    public static function minString($string, $length)
    {
        return strlen(trim($string)>=$length);
    }
    public static function maxString($string, $length)
    {
        return strlen(trim($string)<=$length);
    }
    public static function minNum($number, $length)
    {
        return strlen(trim($number)>=$length);
    }
    public static function maxNum($number, $length)
    {
        return strlen(trim($number)<=$length);
    }
    public static function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    public static function checkPwd($pwd)
    {
        return strlen($pwd)>=6 && preg_match("/[a-z]/", $pwd) && preg_match("/[A-Z]/", $pwd) && preg_match("/[0-9]/", $pwd);
    }

    public static function checkNumber($number)
    {
        return is_numeric(trim($number));
    }

    public static function checkFiles($_files)
    {
        $errorsMsg = [];
        $fileNotFound = 0;
        foreach ($_files as $files){
            foreach($files as $type => $arrayValues){
                if($type == "error")
                    foreach ($arrayValues as $key => $value){
                        if($value > 0 && $value == UPLOAD_ERR_OK)
                            $errorsMsg["image_error"] = "Failed to upload image";
                        if ($value == 4) $fileNotFound = 1;
                    }
                if($type == "size")
                    foreach ($arrayValues as $key => $value){
                        if($value == 0 && $files['error'][$key] == UPLOAD_ERR_OK)
                            $errorsMsg["image_size"] = "Failed to upload image";
                    }
            }
        }
        if(!empty($errorsMsg))
            return $errorsMsg;
        else
            if($fileNotFound)return 1;
            else return 0;
    }
}