<?php
/**
 * Created by PhpStorm.
 * User: Mehdi
 * Date: 06/04/2018
 * Time: 00:07
 */

class Conversation extends CoreSql {

    protected $id;
    protected $iddest;
    protected $type;
    protected $dateCreate;
    protected $status;

    public function __construct()
    {
        //parent::__construct();
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
    public function getiddest()
    {
        return $this->iddest;
    }

    /**
     * @param mixed $iddest
     */
    public function setiddest($iddest)
    {
        $this->iddest = $iddest;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * @param mixed $datecreate
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }


    public function configFormAdd()
    {
    }


}