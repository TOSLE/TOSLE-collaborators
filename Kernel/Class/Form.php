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
                    } else if($attributs["type"]=="number" && !self::checkNumber($data[$name]) && (isset($attributs['required']) && $attributs['required'])){
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
        if(isset($config["select"])){
            foreach($config["select"] as $name => $attributs) {
                if(isset($attributs['options']) && !empty($attributs['options'])){
                    if($data[$name] === "_forbidden"){
                        $errorsMsg[$attributs['label']] = "Il est nécessaire de sélectionner une autre valeur que celle par défaut";
                    }
                }
            }
        }
        if(isset($config["captcha"])){
            if(isset($_SESSION["captcha"]) && isset($data['captcha'])) {
                if($_SESSION["captcha"] != $data['captcha']){
                    $errorsMsg["captcha"] = "Le captcha saisi n'est pas valide";
                }
            }
        }
        if(isset($config['config']['secure']) && $config['config']['secure']) {
            if(isset($_SESSION['secure_form']) && isset($data['_token'])){
                $returnSecure = self::checkSecureForm($_SESSION['secure_form'], $data['_token'], $config['config']['secure']);
                if($returnSecure === 1){
                    $errorsMsg["Timeout"] = "délait d'authentification dépassé pour le formulaire. Merci de réessayer l'envoie";
                }
                if($returnSecure === 2){
                    $errorsMsg["Authentification failed"] = "Authentification échoué pour le formulaire. Veuillez réessayer.";
                }
            } else {
                $errorsMsg["Authentification failed"] = "Authentification échoué pour le formulaire. Veuillez réessayer.";
            }
        }
        return $errorsMsg;
    }


    /**
     * @param $arrayData
     * @return mixed
     * Permet de sécuriser tous les champs envoyés
     */
    public static function secureData($arrayData)
    {
        $dataReturn = [];
        foreach($arrayData as $name => $content){
            if(!stristr($name, "ckeditor") && !stristr($name, "select")){
                $dataReturn[$name] = htmlspecialchars($content);
            } else {
                $dataReturn[$name] = $content;
            }
        }
        return $dataReturn;
    }

    /**
     * @return string
     * Fonction retournant un token pour sécurisation des formulaires par CSRF
     */
    public static function secureCSRF()
    {
        $timestamp = time();
        $token = uniqid($timestamp.'_token_', true);
        $_SESSION['secure_form'] = $token;
        return $token;
    }

    /**
     * @param string $_token
     * @param string $_formToken
     * @param array $_configSecure
     * @return bool
     * Sécurisation CSRF des formulaires
     * Règle à respecter :
     *      - token en $_SESSION et dans le formulaire identique
     *      - token généré il y a moins de 30 minutes
     * Autre option, le formulaire possède une configuration qui lui est propre (config['secure'] sous forme de tableau :
     *      - on compare par rapport au champ duration
     */
    public static function checkSecureForm($_token, $_formToken, $_configSecure)
    {
        if(!is_array($_configSecure)){
            if($_token === $_formToken){
                $timestamp = time();
                $tokenExploded = explode('_', $_token);
                if($timestamp - $tokenExploded[0] < 1800){
                    return 0;
                }
                return 1;
            }
            return 2;
        } else {
            if($_configSecure['status']){
                if($_token === $_formToken){
                    $timestamp = time();
                    $tokenExploded = explode('_', $_token);
                    if($timestamp - $tokenExploded[0] < ($_configSecure['duration']*60)){
                        return 0;
                    }
                    return 1;
                }
                return 2;
            }
            return 0;
        }
    }

    /**
     * @param $string
     * @param $length
     * @return int
     * Determine si la chaîne de caractère est bien supérieur à la taille demandée
     */
    public static function minString($string, $length)
    {
        return strlen(trim($string)>=$length);
    }

    /**
     * @param $string
     * @param $length
     * @return int
     * Determine si la chaîne de caractère est bien inférieur à la taille demandée
     */
    public static function maxString($string, $length)
    {
        return strlen(trim($string)<=$length);
    }

    /**
     * @param $number
     * @param $length
     * @return int
     * Détermine si le nom est bien supérieur à celui requis
     */
    public static function minNum($number, $length)
    {
        return strlen(trim($number)>=$length);
    }

    /**
     * @param $number
     * @param $length
     * @return int
     * Détermine si le nombre est bien inférieur à celui requis
     */
    public static function maxNum($number, $length)
    {
        return strlen(trim($number)<=$length);
    }

    /**
     * @param $email
     * @return bool
     * Vérifie si l'email est bien un email
     */
    public static function checkEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * @param $pwd
     * @return bool
     * Vérifie si le password correspond bien à la taille et aux critères requis
     */
    public static function checkPwd($pwd)
    {
        return strlen($pwd)>=6 && preg_match("/[a-z]/", $pwd) && preg_match("/[A-Z]/", $pwd) && preg_match("/[0-9]/", $pwd);
    }

    /**
     * @param $number
     * @return bool
     * Vérifie si la chaîne est bien un nombre
     */
    public static function checkNumber($number)
    {
        return is_numeric(trim($number));
    }

    /**
     * @param $_files
     * @return array|int
     * Vérification pour savoir si le/les fichiers envoyés ne comportent pas d'erreur
     * Vérification sur le numéro d'erreur
     * Vérification sur la taille du fichier (si différente de 0)
     */
    public static function checkFiles($_files)
    {
        $errorsMsg = [];
        foreach ($_files as $files){
            foreach($files as $type => $arrayValues){
                if($type == "error")
                    foreach ($arrayValues as $key => $value){
                        if($value > 0 && $value == UPLOAD_ERR_OK){
                            $errorsMsg[$files['name'][$key]] = "Failed to upload image";
                        }
                        if ($value == UPLOAD_ERR_NO_FILE && !empty($files['name'][$key])){
                            $errorsMsg[$files['name'][$key]] = "File not found";
                        } else {
                            if($value == UPLOAD_ERR_NO_FILE && empty($files['name'][$key])) {
                                $errorsMsg['EXCEPT_ERROR'] = "No file founded";
                            }
                        }
                        if ($value == UPLOAD_ERR_INI_SIZE){
                            $errorsMsg[$files['name'][$key]] = "Limit upload file size exceeded";
                        }
                        if ($value == UPLOAD_ERR_FORM_SIZE){
                            $errorsMsg[$files['name'][$key]] = "Limit size upload fixed by form is exceeded";
                        }
                        if ($value == UPLOAD_ERR_PARTIAL){
                            $errorsMsg[$files['name'][$key]] = "partial file upload detected";
                        }
                        if ($value == UPLOAD_ERR_NO_TMP_DIR){
                            $errorsMsg[$files['name'][$key]] = "tmp file not found";
                        }
                        if ($value == UPLOAD_ERR_CANT_WRITE){
                            $errorsMsg[$files['name'][$key]] = "echec to save the file on disk";
                        }
                        if ($value == UPLOAD_ERR_EXTENSION){
                            $errorsMsg[$files['name'][$key]] = "extension faild, please contact support.";
                        }
                    }
                if($type == "size")
                    foreach ($arrayValues as $key => $value){
                        if($value == 0 && $files['error'][$key] == UPLOAD_ERR_OK)
                            $errorsMsg["image_size"] = "Failed to upload image";
                    }
            }
        }
        if(!empty($errorsMsg)){
            return $errorsMsg;
        }
        return 0;
    }
}