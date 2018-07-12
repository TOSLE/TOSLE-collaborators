<?php
/**
 * Created by PhpStorm.
 * User: julien
 * Date: 04/07/2018
 * Time: 21:30
 */

class Newsletter
{
    /**
     * 1 -> Blog
     * 2 -> Lesson
     * 3 -> Blog / Lesson
     * 4 -> Nouveau message
     * 5 -> Nouveau message / Blog
     * 6 -> Nouveau message / Lesson
     * 7 -> Nouveau message / Blog / Lesson
     */
    private $Auth = null;
    private $binaryCode;

    public function __construct()
    {
        if(isset($_SESSION['auth'])){
            $tmpAuth = json_decode($_SESSION['auth']);
            $this->Auth = new UserRepository($tmpAuth->{'id'});
        }
        if(isset($this->Auth) && !empty($this->Auth->getNewsletter())){
            $this->binaryCode = decbin($this->Auth->getNewsletter());
        } else {
            $this->binaryCode = gmp_init("0000", 2);
        }
    }

    /**
     * @param string $_binaryCode
     * La chaine de caractere doit être de type (binaire). setNewBinary va affecter une nouvelle valeur à l'attribut
     */
    public function setNewBinary($_binaryCode){
        $this->binaryCode = decbin(bindec($this->binaryCode) ^ bindec($_binaryCode));
        $this->Auth->setNewsletter(bindec($this->binaryCode));
        $this->Auth->save();
    }

    /**
     * @return bool
     * Fonction permet de rajouter ou supprimer la newsletter des lessons
     */
    public function changeLessonNewsletter()
    {
        $this->setNewBinary("0010");
    }

    /**
     * @return bool
     * Vérifie si le bit des qui concerne les lessons
     */
    public function getStatusLesson()
    {
        if(strlen($this->binaryCode) > 1){
            if(substr($this->binaryCode, -2, 1)== "1"){
                return true;
            }
        }
        return false;
    }
}