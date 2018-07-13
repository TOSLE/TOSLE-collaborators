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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token = null)
    {
        if(isset($token)){
            $this->token = $token;
        } else {
            $this->token = uniqid(time().'_token_', true);
        }
    }

    /**
     * @return int
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * @param int $day
     */
    public function setDay($day)
    {
        $this->day = intval($day);
    }

    /**
     * @return int
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * @param int $month
     */
    public function setMonth($month)
    {
        $this->month = intval($month);
    }

    /**
     * @return int
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param int $year
     */
    public function setYear($year)
    {
        $this->year = intval($year);
    }

    /**
     * @return string
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * @param string $target
     */
    public function setTarget($target)
    {
        $this->target = $target;
    }

    /**
     * @return string
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @param string $source
     */
    public function setSource($source)
    {
        $this->source = $source;
    }

    public function getStatsView($_token, $_target)
    {
        $parameter = [
            'LIKE' => [
                'token' => $_token,
                'target' => $_target
            ]
        ];
        $this->setWhereParameter($parameter);
        $this->getOneData();
    }

}