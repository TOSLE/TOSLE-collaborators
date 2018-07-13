<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 05/04/2018
 * Time: 23:52
 */

/**
 * Class Statsview
 * id => id unique de la table
 * type => type de données
 * token => token identique au cookie
 * day => jour
 * month => mois
 * year => année
 * target => cible
 * source => source
 * Le type, le target et la source sont un ensemble. On pourrait imaginer :
 *      - vue : target(view), source(referer), cible(page)
 *      - upload : target(upload), source(utilisateur), cible(type fichier)
 *          * source, id de l'utilisateur
 *          * target, on peut imaginer avatar/devoirs/etc.
 *      - etc
 */
class Stats extends CoreSql {

    protected $id;
    protected $type;
    protected $token;
    protected $day;
    protected $month;
    protected $year;
    protected $target;
    protected $source;

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    public function configFormAdd()
    {
    }

}