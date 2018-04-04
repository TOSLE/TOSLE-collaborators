<?php

class Validate
{
    public static function checkForm($config, $data)
    {
        $errorsMsg = [];
        foreach ($config["input"] as $name => $attributs) {
            if(isset($attributs["confirm"]) && $data[$name] != $data[$attributs["confirm"]]){
                $errorsMsg[]= $name . 'ne correspond pas à '.$attributs["confirm"];
            } else if (!isset($attributs["confirm"])){
                if($attributs["type"]=="email" && !self::checkEmail($data[$name])){
                    $errorsMsg[]= "Format de l'email incorrect";
                } else if($attributs["type"]=="password" && !self::checkPwd($data[$name])){
                    $errorsMsg[]= "Mot de passe incorrect(Maj, Min, Chiffre, au minimum 6 caractères";
                } else if($attributs["type"]=="number" && !self::checkNumber($data[$name])){
                    $errorsMsg[]= $name. " n'est pas correct";
                }
            }

            if(isset($attributs["maxString"]) && !self::maxString($data[$name], $attributs["maxString"])){
                $errorsMsg[]= $name. " doit faire moins de ".$attributs["maxString"];
            }
            if(isset($attributs["minString"]) && !self::minString($data[$name], $attributs["minString"])){
                $errorsMsg[]= $name. " doit faire plus de ".$attributs["minString"];
            }
            if(isset($attributs["maxNum"]) && !self::maxNum($data[$name], $attributs["maxNum"])){
                $errorsMsg[]= $name. " doit faire moins de ".$attributs["maxNum"];
            }
            if(isset($attributs["minNum"]) && !self::minString($data[$name], $attributs["minNum"])){
                $errorsMsg[]= $name. " doit faire plus de ".$attributs["minNum"];
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
        return strlen($pwd>=6) && preg_match("/[a-z]/", $pwd) && preg_match("/[A-Z]/", $pwd) && preg_match("/[0-9]/", $pwd);
    }

    public static function checkNumber($number)
    {
        return is_numeric(trim($number));
    }
}